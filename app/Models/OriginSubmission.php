<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OriginSubmission extends Model
{
    use HasFactory;
    protected $fillable = [
        'tags',
        'about',
        'example',
        'origin_story',
        'origin_id',
        'user_id'
    ];
    public function user():BelongsTo{
        return $this->belongsTo(User::class,'user_id');
    }
    public function origins():BelongsTo{
        return $this->belongsTo(OriginMeme::class,'origin_id');
    }
}