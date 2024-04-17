<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = ['error_id','user_id','nilai','comment'];
    
    public function error_code_ces(): BelongsTo {
        return $this->belongsTo(ErrorCodeCe::class,'error_id');
    }
}
