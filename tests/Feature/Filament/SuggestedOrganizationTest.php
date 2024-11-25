<?php

use App\Filament\Resources\SuggestedOrganizationResource\Pages\EditSuggestedOrganization;
use App\Filament\Resources\SuggestedOrganizationResource\Pages\ListSuggestedOrganizations;
use App\Models\SuggestedOrganization;
use Livewire\Livewire;

it('can approve suggestion from table', function () {
    $suggested = SuggestedOrganization::factory()->create(['name' => 'Shiz University']);

    Livewire::test(ListSuggestedOrganizations::class, ['record' => $suggested->id])
        ->callTableAction('approve', $suggested->id)
        ->assertRedirect(route('filament.bts.resources.organizations.edit', ['record' => 'shiz-university']));

    expect($suggested->fresh()->approved_at)->not->toBeNull();
});

it('can approve suggestion from edit page', function () {
    $suggested = SuggestedOrganization::factory()->create(['name' => 'Shiz']);

    Livewire::test(EditSuggestedOrganization::class, ['record' => $suggested->id])
        ->callAction('approve')
        ->assertRedirect(route('filament.bts.resources.organizations.edit', ['record' => 'shiz']));

    expect($suggested->fresh()->approved_at)->not->toBeNull();
});

it('can hide approval button if already approved', function () {
    $suggested = SuggestedOrganization::factory()->create(['approved_at' => now()]);

    Livewire::test(EditSuggestedOrganization::class, ['record' => $suggested->id])
        ->assertActionHidden('approve');
});
