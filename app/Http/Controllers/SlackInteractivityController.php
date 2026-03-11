<?php

namespace App\Http\Controllers;

use App\Actions\ApproveSuggestedOrganization;
use App\Actions\RejectSuggestedOrganization;
use App\Models\SuggestedOrganization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SlackInteractivityController extends Controller
{
    public function __invoke(Request $request)
    {
        $payload = json_decode($request->input('payload'), true);

        if (! $payload || empty($payload['actions'])) {
            return response()->json(['error' => 'Invalid payload'], 400);
        }

        $action = $payload['actions'][0];
        $responseUrl = $payload['response_url'] ?? null;

        [$actionType, $suggestionId] = explode(':', $action['value'], 2);

        $suggestion = SuggestedOrganization::find($suggestionId);

        if (! $suggestion) {
            return response()->json(['error' => 'Suggestion not found'], 404);
        }

        // Don't re-process already-actioned suggestions
        if ($suggestion->approved_at || $suggestion->rejected_at) {
            return response()->json(['ok' => true]);
        }

        if ($actionType === 'approve') {
            (new ApproveSuggestedOrganization)($suggestion);
            $statusLabel = 'APPROVED';
            $statusEmoji = "\u{2705}"; // ✅ white heavy check mark
        } elseif ($actionType === 'reject') {
            (new RejectSuggestedOrganization)($suggestion);
            $statusLabel = 'REJECTED';
            $statusEmoji = "\u{274C}"; // ❌ cross mark
        } else {
            return response()->json(['error' => 'Unknown action'], 400);
        }

        Log::info("Slack interactivity: {$actionType} suggestion #{$suggestionId}");

        // Update the original Slack message via response_url
        if ($responseUrl) {
            $this->updateSlackMessage($responseUrl, $suggestion, $statusLabel, $statusEmoji);
        }

        return response()->json(['ok' => true]);
    }

    private function updateSlackMessage(
        string $responseUrl,
        SuggestedOrganization $suggestion,
        string $statusLabel,
        string $statusEmoji,
    ): void {
        $sites = implode(', ', $suggestion->sites ?? []);
        $technologies = implode(', ', $suggestion->technologies ?? []);

        $blocks = [
            [
                'type' => 'header',
                'text' => [
                    'type' => 'plain_text',
                    'text' => "{$statusEmoji} Organization Suggestion — {$statusLabel}",
                ],
            ],
            [
                'type' => 'section',
                'fields' => [
                    ['type' => 'mrkdwn', 'text' => "*Name:*\n~{$suggestion->name}~"],
                    ['type' => 'mrkdwn', 'text' => "*URL:*\n~{$suggestion->url}~"],
                    ['type' => 'mrkdwn', 'text' => "*Public Source:*\n~{$suggestion->public_source}~"],
                    ['type' => 'mrkdwn', 'text' => "*Private Source:*\n~{$suggestion->private_source}~"],
                    ['type' => 'mrkdwn', 'text' => "*Suggester Name:*\n{$suggestion->suggester_name}"],
                    ['type' => 'mrkdwn', 'text' => "*Suggester Email:*\n{$suggestion->suggester_email}"],
                    ['type' => 'mrkdwn', 'text' => "*Sites:*\n{$sites}"],
                    ['type' => 'mrkdwn', 'text' => "*Technologies:*\n{$technologies}"],
                ],
            ],
            [
                'type' => 'context',
                'elements' => [
                    [
                        'type' => 'mrkdwn',
                        'text' => "{$statusEmoji} *{$statusLabel}* on " . now()->format('M j, Y \a\t g:i A'),
                    ],
                ],
            ],
        ];

        Http::post($responseUrl, [
            'replace_original' => true,
            'blocks' => $blocks,
        ]);
    }
}
