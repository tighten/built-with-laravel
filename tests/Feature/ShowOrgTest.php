<?php

use App\Models\Organization;
use App\Models\Site;
use App\Models\Technology;

it('shows org details', function () {
    $org = Organization::factory()->create();

    $response = $this->get(route('organizations.show', $org));

    $response->assertStatus(200);
    $response->assertSee($org->name);
    $response->assertSee($org->description);
    $response->assertSee($org->public_source);
    $response->assertDontSee($org->private_source);
});

it('shows org sites', function () {
    $org = Organization::factory()->create();
    $org->sites()->save($site = Site::factory()->create());
    $otherSite = Site::factory()->create();

    $response = $this->get(route('organizations.show', $org));

    $response->assertStatus(200);
    $response->assertSee($site->name);
    $response->assertDontSee($otherSite->name);
});

it('shows org technologies', function () {
    $org = Organization::factory()->create();
    $org->technologies()->attach($hasTech = Technology::factory()->create(['name' => 'Alpine']));
    $hasntTech = Technology::factory()->create(['name' => 'CakePHP']);

    $response = $this->get(route('organizations.show', $org));

    $response->assertStatus(200);
    $response->assertSee($hasTech->name);
    $response->assertDontSee($hasntTech->name);
});
