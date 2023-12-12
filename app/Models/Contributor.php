<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contributor extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'origin_id',
    ];
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function origins(): BelongsTo
    {
        return $this->belongsTo(OriginMeme::class, 'origin_id');
    }
}
