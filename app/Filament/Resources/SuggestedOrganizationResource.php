<?php

namespace App\Filament\Resources;

use App\Actions\ApproveSuggestedOrganization;
use App\Actions\RejectSuggestedOrganization;
use App\Enums\SuggestionStatus;
use App\Filament\Resources\SuggestedOrganizationResource\Pages\CreateSuggestedOrganization;
use App\Filament\Resources\SuggestedOrganizationResource\Pages\EditSuggestedOrganization;
use App\Filament\Resources\SuggestedOrganizationResource\Pages\ListSuggestedOrganizations;
use App\Jobs\EvaluateSuggestedOrganization;
use App\Models\SuggestedOrganization;
use App\Models\Technology;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
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
                Section::make('AI Evaluation')
                    ->schema(function () {
                        return [
                            Placeholder::make('ai_score_display')
                                ->label('Score')
                                ->content(fn (SuggestedOrganization $record) => $record->ai_evaluation['score'] ?? '—')
                                ->extraAttributes(fn (SuggestedOrganization $record) => [
                                    'class' => match (true) {
                                        ($record->ai_evaluation['score'] ?? 0) >= 7 => 'text-success-600',
                                        ($record->ai_evaluation['score'] ?? 0) >= 5 => 'text-warning-600',
                                        default => 'text-danger-600',
                                    },
                                ]),
                            Placeholder::make('ai_classification')
                                ->label('Classification')
                                ->content(fn (SuggestedOrganization $record) => $record->ai_evaluation['classification'] ?? '—'),
                            Placeholder::make('ai_what_it_does')
                                ->label('What it does')
                                ->content(fn (SuggestedOrganization $record) => $record->ai_evaluation['what_it_does'] ?? '—'),
                            Placeholder::make('ai_target_audience')
                                ->label('Target audience')
                                ->content(fn (SuggestedOrganization $record) => $record->ai_evaluation['target_audience'] ?? '—'),
                            Placeholder::make('ai_scale_signals')
                                ->label('Scale signals')
                                ->content(fn (SuggestedOrganization $record) => $record->ai_evaluation['scale_signals'] ?? '—'),
                            Placeholder::make('ai_rationale')
                                ->label('Rationale')
                                ->content(fn (SuggestedOrganization $record) => $record->ai_evaluation['rationale'] ?? '—'),
                            Placeholder::make('ai_flags')
                                ->label('Flags')
                                ->content(fn (SuggestedOrganization $record) => ! empty($record->ai_evaluation['flags'])
                                    ? implode(', ', $record->ai_evaluation['flags'])
                                    : 'None'),
                        ];
                    })
                    ->visible(fn (?SuggestedOrganization $record) => $record?->ai_evaluation !== null)
                    ->collapsed(),
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
                TextColumn::make('ai_evaluation.score')
                    ->label('AI Score')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? "{$state}/10" : '—')
                    ->color(fn ($state) => match (true) {
                        ! $state => 'gray',
                        $state >= 7 => 'success',
                        $state >= 5 => 'warning',
                        default => 'danger',
                    }),
                TextColumn::make('status')
                    ->badge()
                    ->getStateUsing(fn (SuggestedOrganization $record) => $record->status)
                    ->formatStateUsing(fn (SuggestionStatus $state) => $state->label())
                    ->color(fn (SuggestionStatus $state) => $state->color()),
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

                        return to_route('filament.bts.resources.organizations.edit', ['record' => str($record->name)->slug()]);
                    }),
                Action::make('reject')
                    ->requiresConfirmation()
                    ->icon('heroicon-m-hand-thumb-down')
                    ->action(function (SuggestedOrganization $record) {
                        (new RejectSuggestedOrganization)($record);
                    }),
                Action::make('evaluate')
                    ->label('Re-evaluate')
                    ->icon('heroicon-m-sparkles')
                    ->requiresConfirmation()
                    ->action(function (SuggestedOrganization $record) {
                        EvaluateSuggestedOrganization::dispatch($record);

                        Notification::make()
                            ->title('AI evaluation queued')
                            ->success()
                            ->send();
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
