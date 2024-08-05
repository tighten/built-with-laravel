<?php

use App\Actions\RejectSuggestedOrganization;
use App\Models\Organization;
use App\Models\SuggestedOrganization;

it('rejects a suggested organization', function () {
    $org = SuggestedOrganization::factory()->create();

    (new RejectSuggestedOrganization)($org);

    expect(Organization::count())->toBe(0);
    expect($org->refresh()->rejected_at)->not->toBeNull();
    expect($org->refresh()->approved_at)->toBeNull();
});
