<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OriginSubExample extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = [
        'origin_submission_id',
        'example',
    ];
    public function origin_sub(): BelongsTo
    {
        return $this->belongsTo(OriginSubmission::class, 'origin_submission_id');
    }
}
