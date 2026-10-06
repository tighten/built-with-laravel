<?php

use App\Jobs\EvaluateSuggestedOrganization;
use App\Models\SuggestedOrganization;
use App\Notifications\OrganizationSuggested;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;

function fakeAnthropic(array $evaluation): void
{
    Http::fake([
        'api.anthropic.com/*' => Http::response([
            'content' => [
                ['type' => 'text', 'text' => json_encode($evaluation)],
            ],
        ]),
        '*' => Http::response('<html><head><title>A site</title></head><body></body></html>'),
    ]);
}

function baseEvaluation(array $overrides = []): array
{
    return array_merge([
        'score' => 1,
        'classification' => 'other',
        'what_it_does' => 'Cannot be determined.',
        'target_audience' => 'unknown',
        'scale_signals' => 'none',
        'rationale' => 'Gibberish submission.',
        'flags' => ['Likely spam or bot submission'],
        'spam' => false,
        'spam_reason' => '',
    ], $overrides);
}

it('auto-rejects a suggestion the AI flags as spam and does not notify Slack', function () {
    Notification::fake();
    fakeAnthropic(baseEvaluation(['spam' => true, 'spam_reason' => 'Random gibberish name and URL.']));

    $suggested = SuggestedOrganization::factory()->create(['ai_evaluation' => null]);

    (new EvaluateSuggestedOrganization($suggested))->handle();

    expect($suggested->refresh()->rejected_at)->not->toBeNull();
    expect($suggested->approved_at)->toBeNull();

    Notification::assertNothingSent();
});

it('notifies Slack and does not reject when the AI does not flag spam', function () {
    Notification::fake();
    fakeAnthropic(baseEvaluation(['score' => 4, 'spam' => false]));

    $suggested = SuggestedOrganization::factory()->create(['ai_evaluation' => null]);

    (new EvaluateSuggestedOrganization($suggested))->handle();

    expect($suggested->refresh()->rejected_at)->toBeNull();

    Notification::assertSentOnDemand(OrganizationSuggested::class);
});

it('does not re-reject an already-actioned suggestion even if flagged spam', function () {
    Notification::fake();

    $suggested = SuggestedOrganization::factory()->create([
        'ai_evaluation' => baseEvaluation(['spam' => true]),
        'approved_at' => now(),
    ]);

    (new EvaluateSuggestedOrganization($suggested))->handle();

    expect($suggested->refresh()->rejected_at)->toBeNull();
    expect($suggested->approved_at)->not->toBeNull();
});
