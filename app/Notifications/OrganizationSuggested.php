<?php

namespace App\Notifications;

use App\Models\SuggestedOrganization;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Slack\BlockKit\Blocks\ActionsBlock;
use Illuminate\Notifications\Slack\BlockKit\Blocks\SectionBlock;
use Illuminate\Notifications\Slack\SlackMessage;

class OrganizationSuggested extends Notification
{
    use Queueable;

    public function __construct(public SuggestedOrganization $suggested) {}

    public function via(object $notifiable): array
    {
        return ['slack'];
    }

    public function toSlack(): SlackMessage
    {
        $sites = implode(', ', $this->suggested->sites);
        $technologies = implode(', ', $this->suggested->technologies);

        $message = (new SlackMessage)
            ->headerBlock('Organization Suggestion')
            ->sectionBlock(function (SectionBlock $block) use ($sites, $technologies) {
                $block->text('An Organization has been suggested');
                $block->field("*Name:*\n{$this->suggested->name}")->markdown();
                $block->field("*URL:*\n{$this->suggested->url}")->markdown();
                $block->field("*Public Source:*\n{$this->suggested->public_source}")->markdown();
                $block->field("*Private Source:*\n{$this->suggested->private_source}")->markdown();
                $block->field("*Suggester Name:*\n{$this->suggested->suggester_name}")->markdown();
                $block->field("*Suggester Email:*\n{$this->suggested->suggester_email}")->markdown();
                $block->field("*Sites:*\n{$sites}")->markdown();
                $block->field("*Technologies:*\n{$technologies}")->markdown();
            });

        $evaluation = $this->suggested->ai_evaluation;

        if ($evaluation && isset($evaluation['score'])) {
            $score = $evaluation['score'];
            $emoji = match (true) {
                $score >= 9 => ':star-struck:',
                $score >= 7 => ':white_check_mark:',
                $score >= 5 => ':thinking_face:',
                default => ':x:',
            };

            $flags = ! empty($evaluation['flags'])
                ? implode(', ', $evaluation['flags'])
                : 'None';

            $message->dividerBlock()
                ->sectionBlock(function (SectionBlock $block) use ($evaluation, $score, $emoji, $flags) {
                    $block->text("{$emoji} *AI Evaluation: {$score}/10* — {$evaluation['classification']}")->markdown();
                    $block->field("*What it does:*\n{$evaluation['what_it_does']}")->markdown();
                    $block->field("*Rationale:*\n{$evaluation['rationale']}")->markdown();
                    $block->field("*Flags:*\n{$flags}")->markdown();
                });
        }

        $message->dividerBlock()
            ->actionsBlock(function (ActionsBlock $block) {
                $block->button('Approve')
                    ->primary()
                    ->id('approve_suggestion')
                    ->value("approve:{$this->suggested->id}");
                $block->button('Reject')
                    ->danger()
                    ->id('reject_suggestion')
                    ->value("reject:{$this->suggested->id}");
            });

        return $message;
    }
}
