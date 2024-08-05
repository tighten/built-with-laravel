<?php

namespace App\Actions;

use App\Models\SuggestedOrganization;
use Illuminate\Support\Facades\Log;

class RejectSuggestedOrganization
{
    public function __invoke(SuggestedOrganization $org)
    {
        Log::info('Rejected suggested organization ' . $suggested->id);

        $org->update(['rejected_at' => now()]);
    }
}
