<?php

use App\Actions\ApproveSuggestedOrganization;
use App\Models\Organization;
use App\Models\SuggestedOrganization;
use App\Models\Technology;
use App\Models\User;

it('approves a suggested organization', function () {
    User::factory()->create();
    Technology::create(['name' => 'React']);
    Technology::create(['name' => 'Inertia']);
    $org = SuggestedOrganization::factory()->create([
        'sites' => ['https:///siteone.com/', 'https://sitetwo.com'],
        'technologies' => ['react', 'inertia'],
    ]);

    (new ApproveSuggestedOrganization)($org);

    expect(Organization::count())->toBe(1);
    expect($org->refresh()->rejected_at)->toBeNull();
    expect($org->refresh()->approved_at)->not->toBeNull();

    $imported = Organization::first();

    expect(count($imported->sites))->toBe(2);
    expect(count($imported->technologies))->toBe(2);

    expect($org->name)->toBe($imported->name);
    expect($org->url)->toBe($imported->url);
    expect($org->public_source)->toBe($imported->public_source);
    expect($org->private_source)->toBe($imported->private_source);
    expect($org->published_at)->toBeNull();
});
