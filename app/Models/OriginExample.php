<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OriginExample extends Model
{
    use HasFactory;
    protected $fillable = [
        'origin_id',
        'example',
    ];
    public function origin(): BelongsTo
    {
        return $this->belongsTo(OriginMeme::class, 'origin_id');
    }
}
