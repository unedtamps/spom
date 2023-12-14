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
        'about',
        'origin_story',
    ];
    public function contributors(): HasMany
    {
        return $this->hasMany(Contributor::class, 'origin_id');
    }
    public function submissions(): HasMany
    {
        return $this->hasMany(OriginSubmission::class, 'user_id');
    }
    public function examples(): HasMany
    {
        return $this->hasMany(OriginExample::class, 'origin_id');
    }
}
