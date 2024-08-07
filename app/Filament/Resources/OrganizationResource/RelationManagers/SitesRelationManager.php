<?php

namespace App\Filament\Resources\OrganizationResource\RelationManagers;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class SitesRelationManager extends RelationManager
{
    protected static string $relationship = 'sites';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('url')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('image')
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
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->using(function (Model $record, array $data) {
                        if ($record->image !== $data['image'] && !! $record->image) {
                            Storage::delete($record->image);
                        }

                        $record->update($data);
                    }),
                Tables\Actions\DeleteAction::make()
                    ->before(function (Model $record) {
                        Storage::delete($record->image);
                    }),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function (Collection $selectedRecords) {
                            $selectedRecords->each(function ($site) {
                                Storage::delete($site->image);
                            });
                        }),
                ]),
            ]);
    }
}
