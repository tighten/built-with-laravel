<?php

use App\Models\Organization;
use App\Models\Technology;

it('lists organizations', function () {
    $org = Organization::factory()->create();

    $response = $this->get(route('home'));

    $response->assertOk();
    $response->assertSee($org->name);
});

it('filters organizations', function () {
    $org = Organization::factory()->create();
    $org->technologies()->attach($tech = Technology::factory()->create());

    $otherOrg = Organization::factory()->create();

    $response = $this->get(route('home', [
        'technology' => $tech,
    ]));

    $response->assertOk();
    $response->assertSee($org->name);
    $response->assertDontSee($otherOrg->name);
});
