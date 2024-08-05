<?php

namespace App\Actions;

use App\Models\SuggestedOrganization;
use Illuminate\Support\Facades\Log;

class RejectSuggestedOrganization
{
    public function __invoke(SuggestedOrganization $suggested)
    {
        Log::info('Rejected suggested organization ' . $suggested->id);

        $suggested->update(['rejected_at' => now()]);
    }
}
