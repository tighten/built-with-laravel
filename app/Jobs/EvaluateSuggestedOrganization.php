<?php

namespace App\Jobs;

use App\Models\SuggestedOrganization;
use App\Notifications\OrganizationSuggested;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use RuntimeException;

class EvaluateSuggestedOrganization implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 2;

    public int $backoff = 30;

    public function __construct(public SuggestedOrganization $suggested) {}

    public function handle(): void
    {
        $metadata = $this->fetchPageMetadata($this->suggested->url);

        try {
            $evaluation = $this->callAnthropicApi($metadata);
            $this->suggested->update(['ai_evaluation' => $evaluation]);
        } catch (Exception $e) {
            Log::warning('AI evaluation failed for suggestion #' . $this->suggested->id . ': ' . $e->getMessage());
        }

        $this->suggested->refresh();

        if (app()->environment('production', 'testing')) {
            Notification::route('slack', config('services.slack.notifications.channel'))
                ->notify(new OrganizationSuggested($this->suggested));
        }
    }

    private function fetchPageMetadata(string $url): array
    {
        try {
            $response = Http::timeout(10)
                ->withUserAgent('Mozilla/5.0 (compatible; BuiltWithLaravel/1.0)')
                ->get($url);

            if ($response->failed()) {
                return ['fetch_error' => 'HTTP ' . $response->status()];
            }

            $html = $response->body();
        } catch (Exception $e) {
            return ['fetch_error' => $e->getMessage()];
        }

        $title = null;
        if (preg_match('/<title[^>]*>(.*?)<\/title>/si', $html, $m)) {
            $title = trim(html_entity_decode($m[1], ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        }

        $metaDescription = null;
        if (preg_match('/<meta[^>]+name=["\']description["\'][^>]+content=["\'](.*?)["\']/si', $html, $m)) {
            $metaDescription = trim(html_entity_decode($m[1], ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        } elseif (preg_match('/<meta[^>]+content=["\'](.*?)["\'][^>]+name=["\']description["\']/si', $html, $m)) {
            $metaDescription = trim(html_entity_decode($m[1], ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        }

        $headline = null;
        if (preg_match('/<h1[^>]*>(.*?)<\/h1>/si', $html, $m)) {
            $headline = trim(strip_tags($m[1]));
        } elseif (preg_match('/<h2[^>]*>(.*?)<\/h2>/si', $html, $m)) {
            $headline = trim(strip_tags($m[1]));
        }

        return [
            'title' => $title,
            'meta_description' => $metaDescription,
            'headline' => $headline,
            'fetch_error' => null,
        ];
    }

    private function callAnthropicApi(array $metadata): array
    {
        $systemPrompt = <<<'SYSTEM'
You are a site evaluator for builtwithlaravel.com, a showcase of impressive sites and products built with the Laravel PHP framework.

## Editorial Guidelines

The goal of the showcase is to impress a non-developer audience: CEOs, CTOs, board members, Silicon Valley types. Visitors should think "wow, that runs on Laravel?"

**Ideal submissions:**
- Recognizable consumer apps with significant user bases
- Funded startups with clear market traction
- Large-scale B2B SaaS products
- Well-known products that would surprise people to learn they run on Laravel

**Reject or score low:**
- Agency sites, portfolios, or consulting firms
- Small developer utilities or dev tools
- Personal projects or hobby apps
- Niche tools with limited audiences
- Exception: tools so widely known that non-developers have heard of them (like Trello, Sentry, or Basecamp)

## Scoring Guide

- 9–10: Widely recognized, significant consumer or enterprise reach, boardroom-impressive
- 7–8: Real funded or high-traffic product with clear market presence
- 5–6: Legitimate but small, niche, or unclear scale — borderline
- 3–4: Developer tool, small SaaS, or agency — probably not
- 1–2: Agency site, personal project, tiny tool — clear no

## Response Format

Respond with ONLY a JSON object (no markdown, no code fences, no explanation) in this exact shape:

{
  "score": <1-10>,
  "classification": "<B2C app / B2B SaaS / marketplace / media / developer tool / agency / other>",
  "what_it_does": "<one sentence>",
  "target_audience": "<who uses this>",
  "scale_signals": "<what you can infer about traffic, funding, or user base>",
  "rationale": "<2-3 sentences explaining the score>",
  "flags": ["<any concerns>"]
}
SYSTEM;

        $technologies = is_array($this->suggested->technologies)
            ? implode(', ', $this->suggested->technologies)
            : ($this->suggested->technologies ?? '');

        $userMessage = "Evaluate this site submission for builtwithlaravel.com:\n\n";
        $userMessage .= "Name: {$this->suggested->name}\n";
        $userMessage .= "URL: {$this->suggested->url}\n";

        if ($this->suggested->public_source) {
            $userMessage .= "Public Source/Evidence: {$this->suggested->public_source}\n";
        }

        if ($technologies) {
            $userMessage .= "Technologies: {$technologies}\n";
        }

        if (empty($metadata['fetch_error'])) {
            $userMessage .= "\n--- Page Metadata (fetched from the URL) ---\n";
            if ($metadata['title']) {
                $userMessage .= "Page Title: {$metadata['title']}\n";
            }
            if ($metadata['meta_description']) {
                $userMessage .= "Meta Description: {$metadata['meta_description']}\n";
            }
            if ($metadata['headline']) {
                $userMessage .= "Headline/Tagline: {$metadata['headline']}\n";
            }
        }

        $response = Http::withHeaders([
            'x-api-key' => config('services.anthropic.api_key'),
            'anthropic-version' => '2023-06-01',
        ])->timeout(30)->post('https://api.anthropic.com/v1/messages', [
            'model' => 'claude-sonnet-4-20250514',
            'max_tokens' => 1024,
            'system' => $systemPrompt,
            'messages' => [
                ['role' => 'user', 'content' => $userMessage],
            ],
        ]);

        $response->throw();

        $text = $response->json('content.0.text');

        $evaluation = json_decode($text, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new RuntimeException('Failed to parse AI evaluation response as JSON: ' . $text);
        }

        return $evaluation;
    }
}
