<?php

namespace App\Filament\Resources;

use App\Actions\ApproveSuggestedOrganization;
use App\Actions\RejectSuggestedOrganization;
use App\Filament\Resources\SuggestedOrganizationResource\Pages\CreateSuggestedOrganization;
use App\Filament\Resources\SuggestedOrganizationResource\Pages\EditSuggestedOrganization;
use App\Filament\Resources\SuggestedOrganizationResource\Pages\ListSuggestedOrganizations;
use App\Models\SuggestedOrganization;
use App\Models\Technology;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SuggestedOrganizationResource extends Resource
{
    protected static ?string $model = SuggestedOrganization::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('url')
                    ->required()
                    ->url()
                    ->maxLength(255),
                Textarea::make('public_source'),
                TextArea::make('private_source'),
                TextArea::make('sites')
                    ->afterStateHydrated(function (TextArea $component, string|array|null $state) {
                        if (is_array($state)) {
                            $state = implode("\n", $state);
                        }
                        $component->state($state);
                    })->dehydrateStateUsing(function (string $state) {
                        return explode("\n", $state);
                    }),
                Select::make('technologies')
                    ->multiple()
                    ->options(
                        Technology::all()->pluck('name', 'slug')
                    ),
                TextInput::make('suggester_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('suggester_email')
                    ->required()
                    ->email()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('url')
                    ->searchable(),
                TextColumn::make('suggester_name'),
                TextColumn::make('suggester_email'),
            ])
            ->filters([
                Filter::make('exclude_rejected')
                    ->query(fn (Builder $query): Builder => $query->whereNull('rejected_at'))
                    ->toggle()
                    ->default(),
                Filter::make('exclude_approved')
                    ->query(fn (Builder $query): Builder => $query->whereNull('approved_at'))
                    ->toggle()
                    ->default(),
            ])
            ->actions([
                EditAction::make(),
                Action::make('approve')
                    ->requiresConfirmation()
                    ->icon('heroicon-m-check-badge')
                    ->action(function (SuggestedOrganization $record) {
                        (new ApproveSuggestedOrganization)($record);
                    }),
                Action::make('reject')
                    ->requiresConfirmation()
                    ->icon('heroicon-m-hand-thumb-down')
                    ->action(function (SuggestedOrganization $record) {
                        (new RejectSuggestedOrganization)($record);
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => ListSuggestedOrganizations::route('/'),
            'create' => CreateSuggestedOrganization::route('/create'),
            'edit' => EditSuggestedOrganization::route('/{record}/edit'),
        ];
    }
}
