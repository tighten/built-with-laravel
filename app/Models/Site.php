<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'image',
        'published_at',
        'submitter_id',
        'organization_id',
    ];

    protected $casts = [
        'id' => 'integer',
        'published_at' => 'timestamp',
        'submitter_id' => 'integer',
        'organization_id' => 'integer',
    ];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function submitter(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function technologies(): HasMany
    {
        return $this->hasMany(Technology::class);
    }
}
