<?php

namespace App\Filament\Resources\SuggestedOrganizationResource\Pages;

use App\Actions\ApproveSuggestedOrganization;
use App\Filament\Resources\SuggestedOrganizationResource;
use App\Models\SuggestedOrganization;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSuggestedOrganization extends EditRecord
{
    protected static string $resource = SuggestedOrganizationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('approve')
                ->visible($this->record->approved_at === null)
                ->requiresConfirmation()
                ->icon('heroicon-m-check-badge')
                ->action(function (SuggestedOrganization $record) {
                    (new ApproveSuggestedOrganization)($record);

                    return to_route('filament.bts.resources.organizations.edit', ['record' => str($record->name)->slug()]);
                }),
            DeleteAction::make(),
        ];
    }
}
