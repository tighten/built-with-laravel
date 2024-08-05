<?php

namespace App\Filament\Resources\SuggestedOrganizationResource\Pages;

use App\Filament\Resources\SuggestedOrganizationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSuggestedOrganization extends EditRecord
{
    protected static string $resource = SuggestedOrganizationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
