<?php

namespace App\Filament\Resources\OrganizationResource\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class SitesRelationManager extends RelationManager
{
    protected static string $relationship = 'sites';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('slug')
                    ->required()
                    ->maxLength(255),

                TextInput::make('url')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('image')
                    ->required()
                    ->directory('images/sites')
                    ->image()
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('150:111')
                    ->imageResizeTargetWidth(1200)
                    ->imageResizeTargetHeight(888),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('url'),
                ImageColumn::make('image'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make()
                    ->using(function (Model $record, array $data) {
                        if ($record->image !== $data['image'] && (bool) $record->image) {
                            Storage::delete($record->image);
                        }

                        $record->update($data);
                    }),
                DeleteAction::make()
                    ->before(function (Model $record) {
                        Storage::delete($record->image);
                    }),

            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->before(function (Collection $selectedRecords) {
                            $selectedRecords->each(function ($site) {
                                Storage::delete($site->image);
                            });
                        }),
                ]),
            ]);
    }
}
