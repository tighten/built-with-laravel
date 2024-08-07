<?php

namespace App\Filament\Resources\SuggestedOrganizationResource\Pages;

use App\Filament\Resources\SuggestedOrganizationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSuggestedOrganizations extends ListRecords
{
    protected static string $resource = SuggestedOrganizationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
