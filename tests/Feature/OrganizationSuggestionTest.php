<?php

use App\Models\SuggestedOrganization;
use App\Notifications\OrganizationSuggested;
use Illuminate\Support\Facades\Notification;

it('saves a suggested organization', function () {
    $input = [
        'name' => 'My Best Organization',
        'url' => 'https://mybest.com',
        'public_source' => 'They told everyone',
        'private_source' => 'They whispered it to me',
        'sites' => "http://one.com/\nhttp://two.com/",
        'technologies' => ['react', 'vue'],
        'suggester_name' => 'Phil',
        'suggester_email' => 'phil@ideas.com',
    ];

    $response = $this->post(route('suggestions.store'), $input);

    expect(SuggestedOrganization::count())->toBe(1);

    $so = SuggestedOrganization::first();

    foreach ($input as $name => $value) {
        if ($name === 'sites') {
            $value = ['http://one.com/', 'http://two.com/'];
        }

        expect($so->$name)->toBe($value);
    }

    // @todo assert more
});

it('sends a notification to Slack', function () {
    $this->withoutExceptionHandling();
    Notification::fake();

    $input = [
        'name' => 'My Best Organization',
        'url' => 'https://mybest.com',
        'public_source' => 'They told everyone',
        'private_source' => 'They whispered it to me',
        'sites' => "http://one.com/\nhttp://two.com/",
        'technologies' => ['react', 'vue'],
        'suggester_name' => 'Phil',
        'suggester_email' => 'phil@ideas.com',
    ];

    $this->post(route('suggestions.store'), $input);

    Notification::assertSentOnDemand(OrganizationSuggested::class);
});
