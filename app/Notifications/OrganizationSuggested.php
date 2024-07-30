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

    public function __construct(public SuggestedOrganization $suggested)
    {
    }

    public function via(object $notifiable): array
    {
        return ['slack'];
    }

    public function toSlack(): SlackMessage
    {
        $sites = implode(', ', $this->suggested->sites);
        $technologies = implode(', ', $this->suggested->technologies);

        return (new SlackMessage)
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
        // comment in once viewing suggested organization has been implemented
        //     ->dividerBlock()
        //     ->actionsBlock(function (ActionsBlock $block) {
        //        $block->button('Acknowledge Invoice')->primary()->url('https://builtwithlaravel.com/admin/suggested-organization/');
        //    });
    }
}
