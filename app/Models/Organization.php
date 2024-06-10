<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'submitter_id',
    ];

    protected $casts = [
        'id' => 'integer',
        'submitter_id' => 'integer',
    ];

    public function submitter(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
