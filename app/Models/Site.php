<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Guarded(['id'])]
class Site extends Model
{
    use HasFactory, Sluggable;

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function submitter(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'organization_id' => 'integer',
        ];
    }
}
