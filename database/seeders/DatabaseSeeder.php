<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\SuggestedOrganization;
use App\Models\Technology;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Matt Stauffer',
            'email' => 'matt@tighten.co',
            'password' => bcrypt('password'),
        ]);

        $react = Technology::create(['name' => 'React']);
        Technology::create(['name' => 'Alpine.js']);
        Technology::create(['name' => 'Filament']);

        Organization::create([
            'name' => 'Curology',
            'url' => 'https://curology.com/',
            'image' => 'images/organizations/images/curology.png',
            'favicon' => 'images/organizations/favicons/curology.png',
            'description' => 'A personalized skincare brand.',
            'public_source' => "They've posted jobs for Laravel.",
            'published_at' => now(),
        ]);

        $gene = Organization::create([
            'name' => 'Genentech',
            'url' => 'https://gene.com/',
            'favicon' => 'images/organizations/favicons/genentech.png',
            'description' => 'A research company.',
            'public_source' => 'Tighten built their site(s).',
            'published_at' => now(),
        ]);

        $gene->sites()->create([
            'name' => 'Genentech.com',
            'url' => 'https://www.gene.com/',
            'image' => 'images/organizations/images/genentech.jpg',
        ]);

        $gene->technologies()->attach($react);

        Organization::create([
            'name' => 'Apple',
            'url' => 'https://apple.com/',
            'image' => 'images/organizations/images/apple.png',
            'favicon' => 'images/organizations/favicons/apple.png',
            'description' => 'A personal electronics technology company.',
            'public_source' => "They've posted jobs for Laravel.",
            'published_at' => now(),
        ]);

        $zillow = Organization::create([
            'name' => 'Zillow',
            'url' => 'https://zillow.com/',
            'favicon' => 'images/organizations/favicons/zillow.png',
            'description' => 'An online real-estate marketplace.',
            'public_source' => 'They acquired Aryeo, which uses Laravel.',
            'published_at' => now(),
        ]);

        $zillow->sites()->create([
            'name' => 'Aryeo',
            'url' => 'https://www.aryeo.com/',
            'image' => 'images/sites/aryeo.jpg',
        ]);

        $zillow->technologies()->attach(Technology::create(['name' => 'Inertia']));
        $zillow->technologies()->attach(Technology::create(['name' => 'Vue.js']));

        SuggestedOrganization::create([
            'name' => 'OpenAI',
            'url' => 'https://openai.com/',
            'public_source' => 'Displayed on the Twill "Made with Twill" page.',
            'private_source' => 'They emailed us and said they love Taylor.',
            'sites' => ['https://openai.com/', 'https://old.openai.com/'],
            'technologies' => ['twill', 'react'],
            'suggester_name' => 'Matt Stauffer',
            'suggester_email' => 'matt@tighten.co',
            'ip_address' => '192.168.1.1',
        ]);

        $this->copyTempImages();
    }

    public function copyTempImages()
    {
        // Truncate
        $files = Storage::allFiles('images');
        Storage::delete($files);

        // Copy over
        foreach (Storage::disk('local')->allFiles('/seed-images') as $file) {
            Storage::disk('local')->copy($file, str_replace('seed-images', 'public/images', $file));
        }
    }
}
