<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OriginSubmission extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'about',
        'origin_story',
        'origin_id',
        'user_id'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function origins(): BelongsTo
    {
        return $this->belongsTo(OriginMeme::class, 'origin_id');
    }
    public function example_sub(): HasMany
    {
        return $this->hasMany(OriginSubExample::class, 'origin_submission_id');
    }
}
