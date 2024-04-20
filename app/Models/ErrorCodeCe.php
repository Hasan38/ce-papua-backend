<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ErrorCodeCe extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','machine_type','error_code','problem_info','action_taken'];

    protected $casts = ['error_code' => 'array'];

    public function users(): BelongsTo {
        return $this->belongsTo(User::class,'user_id');
    }

    public function ratings(): HasMany {
        return $this->hasMany(Rating::class);
    }

    public function avgRating()
    {
        return $this->ratings->avg('nilai') ?? 0;
    }
}
