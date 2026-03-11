<?php

namespace App\Models;

use App\Enums\SuggestionStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuggestedOrganization extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'sites' => 'array',
            'technologies' => 'array',
            'approved_at' => 'datetime',
            'rejected_at' => 'datetime',
        ];
    }

    public function getStatusAttribute(): SuggestionStatus
    {
        if ($this->approved_at) {
            return SuggestionStatus::Approved;
        }

        if ($this->rejected_at) {
            return SuggestionStatus::Rejected;
        }

        return SuggestionStatus::Unreviewed;
    }

    public function scopeUnreviewed(Builder $query): Builder
    {
        return $query->whereNull('approved_at')->whereNull('rejected_at');
    }

    public function scopeApproved(Builder $query): Builder
    {
        return $query->whereNotNull('approved_at');
    }

    public function scopeRejected(Builder $query): Builder
    {
        return $query->whereNotNull('rejected_at');
    }
}
