<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meme extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'pics',
        'user_id',
        'likes',
        'dislikes',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function likesby(): HasMany
    {
        return $this->hasMany(MemeLikes::class, 'meme_id');
    }
}