<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuggestedOrganizationResource\Pages;
use App\Filament\Resources\SuggestedOrganizationResource\RelationManagers;
use App\Models\SuggestedOrganization;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SuggestedOrganizationResource extends Resource
{
    protected static ?string $model = SuggestedOrganization::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('url')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('public_source'),
                Forms\Components\TextInput::make('private_source'),
                Forms\Components\TextInput::make('sites'), // @todo encode to and from json
                Forms\Components\TextInput::make('technologies'), // @todo encode to and from json
                Forms\Components\TextInput::make('suggester_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('suggester_email')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('suggester_name'),
                Tables\Columns\TextColumn::make('suggester_email'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSuggestedOrganizations::route('/'),
            'create' => Pages\CreateSuggestedOrganization::route('/create'),
            'edit' => Pages\EditSuggestedOrganization::route('/{record}/edit'),
        ];
    }
}
