<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OriginMeme extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'tags',
        'about',
        'example',
        'origin_story',
        'status'
    ];
    public function contributors(): HasMany
    {
        return $this->hasMany(Contributor::class, 'origin_id');
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(OriginSubmission::class,'user_id');
    }
}
