<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = ['error_code_ce_id','user_id','nilai','comment'];
    
    public function error_code_ces(): BelongsTo {
        return $this->belongsTo(ErrorCodeCe::class,'error_id');
    }

    public function users(): HasOne {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function avgRating()
    {
        return $this->avg('nilai') ?? 0;
    }


}
