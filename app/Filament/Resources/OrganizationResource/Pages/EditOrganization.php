<?php

namespace App\Filament\Resources\OrganizationResource\Pages;

use App\Filament\Resources\OrganizationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class EditOrganization extends EditRecord
{
    protected static string $resource = OrganizationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // Delete old images if they're changed
        if ($record->image !== $data['image']) {
            Storage::delete($record->image);
        }

        if ($record->favicon !== $data['favicon']) {
            Storage::delete($record->favicon);
        }

        $record->update($data);

        return $record;
    }
}
