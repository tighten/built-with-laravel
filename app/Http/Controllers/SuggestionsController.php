<?php

namespace App\Http\Controllers;

use App\Jobs\EvaluateSuggestedOrganization;
use App\Models\SuggestedOrganization;
use App\Models\Technology;

class SuggestionsController extends Controller
{
    public function create()
    {
        return view('suggestions.create', [
            'technologies' => Technology::orderBy('name')->get(),
        ]);
    }

    public function store()
    {
        $input = request()->validate([
            'name' => 'required',
            'url' => 'required|url',
            'public_source' => '',
            'private_source' => '',
            'sites' => '',
            'technologies' => 'array',
            'suggester_name' => 'required',
            'suggester_email' => 'required|email',
        ]);

        $suggested = SuggestedOrganization::create([
            'name' => $input['name'],
            'url' => $input['url'],
            'public_source' => $input['public_source'],
            'private_source' => $input['private_source'],
            'suggester_name' => $input['suggester_name'],
            'suggester_email' => $input['suggester_email'],
            'sites' => array_filter(explode("\n", $input['sites'])),
            'technologies' => $input['technologies'] ?? [],
            'ip_address' => request()->ip(),
        ]);

        EvaluateSuggestedOrganization::dispatch($suggested);

        return redirect()->back()->with('flash', 'Thanks for your suggestion!');
    }
}
