<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrganizationResource\Pages;
use App\Filament\Resources\OrganizationResource\RelationManagers;
use App\Filament\Resources\OrganizationResource\RelationManagers\SitesRelationManager;
use App\Models\Organization;
use App\Models\Technology;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrganizationResource extends Resource
{
    protected static ?string $model = Organization::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                TextInput::make('url')
                    ->required()
                    ->url()
                    ->maxLength(255),
                Textarea::make('description'),
                Textarea::make('public_source'),
                TextArea::make('private_source'),

                DateTimePicker::make('published_at'),

                Select::make('technologies')
                    ->multiple()
                    ->relationship(titleAttribute: 'name'),

                // @todo: Handle deleting the old image if a new one is uploaded
                //        because Filament doesn't handle that

                FileUpload::make('image')
                    ->disk('do')
                    ->directory('images/organizations/images')
                    ->image()
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('150:111')
                    ->imageResizeTargetWidth(1200)
                    ->imageResizeTargetHeight(888),

                FileUpload::make('favicon')
                    ->disk('do')
                    ->directory('images/organizations/favicons')
                    ->image()
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('1:1')
                    ->imageResizeTargetWidth(64)
                    ->imageResizeTargetHeight(64),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('favicon')->disk('do'),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('url')
                    ->searchable(),
                IconColumn::make('published_at')
                    ->label('Published?')
                    ->icon('heroicon-o-check-badge'),
            ])
            ->filters([
                Filter::make('unpublished')
                    ->query(fn (Builder $query): Builder => $query->whereNull('published_at'))
                    ->toggle()
                    ->default(),
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
            SitesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrganizations::route('/'),
            'create' => Pages\CreateOrganization::route('/create'),
            'edit' => Pages\EditOrganization::route('/{record}/edit'),
        ];
    }
}
