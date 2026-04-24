<?php

namespace App\Console\Commands;

use App\Actions\ApproveSuggestedOrganization;
use App\Actions\RejectSuggestedOrganization;
use App\Jobs\EvaluateSuggestedOrganization;
use App\Models\SuggestedOrganization;
use Illuminate\Console\Command;

use function Laravel\Prompts\select;

class ReviewSuggestions extends Command
{
    protected $signature = 'suggestions:review';

    protected $description = 'Review unreviewed suggested organizations one by one with AI evaluation';

    public function handle(): int
    {
        $remaining = SuggestedOrganization::unreviewed()->count();

        if ($remaining === 0) {
            $this->info('No unreviewed suggestions. You\'re all caught up!');

            return self::SUCCESS;
        }

        $this->info("Found {$remaining} unreviewed suggestions.");

        while ($suggestion = SuggestedOrganization::unreviewed()->inRandomOrder()->first()) {
            $this->newLine();
            $this->line(str_repeat('─', 60));
            $this->newLine();

            $this->displaySuggestion($suggestion);

            // Run AI evaluation if missing
            if (! $suggestion->ai_evaluation) {
                $this->info('Running AI evaluation...');

                try {
                    (new EvaluateSuggestedOrganization($suggestion))->handle();
                    $suggestion->refresh();
                } catch (\Exception $e) {
                    $this->error('AI evaluation failed: ' . $e->getMessage());
                }
            }

            if ($suggestion->ai_evaluation) {
                $this->displayEvaluation($suggestion->ai_evaluation);
            }

            $action = select('What would you like to do?', [
                'approve' => 'Approve',
                'reject' => 'Reject',
                'skip' => 'Skip',
                'quit' => 'Quit',
            ]);

            match ($action) {
                'approve' => $this->approve($suggestion),
                'reject' => $this->reject($suggestion),
                'skip' => $this->info('Skipped.'),
                'quit' => null,
            };

            if ($action === 'quit') {
                break;
            }

            $remaining = SuggestedOrganization::unreviewed()->count();
            $this->info("{$remaining} suggestions remaining.");
        }

        $this->newLine();
        $this->info('Done!');

        return self::SUCCESS;
    }

    private function displaySuggestion(SuggestedOrganization $suggestion): void
    {
        $this->line("<fg=white;options=bold>{$suggestion->name}</>");
        $this->line("<href={$suggestion->url}>{$suggestion->url}</>");

        if ($suggestion->public_source) {
            $this->line("Source: {$suggestion->public_source}");
        }

        if ($suggestion->sites) {
            $this->line('Sites: ' . implode(', ', $suggestion->sites));
        }

        if ($suggestion->technologies) {
            $this->line('Tech: ' . implode(', ', $suggestion->technologies));
        }

        $this->line("Suggested by: {$suggestion->suggester_name} ({$suggestion->suggester_email})");
    }

    private function displayEvaluation(array $eval): void
    {
        $this->newLine();

        $score = $eval['score'] ?? '?';
        $scoreColor = match (true) {
            $score >= 7 => 'green',
            $score >= 5 => 'yellow',
            default => 'red',
        };

        $this->line("<fg={$scoreColor};options=bold>Score: {$score}/10</>");
        $this->line("Classification: " . ($eval['classification'] ?? '—'));
        $this->line("What it does: " . ($eval['what_it_does'] ?? '—'));
        $this->line("Target audience: " . ($eval['target_audience'] ?? '—'));
        $this->line("Scale signals: " . ($eval['scale_signals'] ?? '—'));
        $this->line("Rationale: " . ($eval['rationale'] ?? '—'));

        if (! empty($eval['flags'])) {
            $this->line("<fg=yellow>Flags: " . implode(', ', $eval['flags']) . '</>');
        }

        $this->newLine();
    }

    private function approve(SuggestedOrganization $suggestion): void
    {
        (new ApproveSuggestedOrganization)($suggestion);
        $this->info("Approved: {$suggestion->name}");
    }

    private function reject(SuggestedOrganization $suggestion): void
    {
        (new RejectSuggestedOrganization)($suggestion);
        $this->info("Rejected: {$suggestion->name}");
    }
}
