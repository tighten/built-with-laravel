<?php

namespace App\Http\Controllers;

use App\Models\Organization;

class OrganizationsController extends Controller
{
    public function show(Organization $organization)
    {
        return view('organizations.show', [
            'organization' => $organization,
        ]);
    }
}
