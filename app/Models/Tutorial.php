<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tutorial extends Model
{
    use HasFactory;

    protected $fillable= ['user_id','machine_type','customer','type','title','content','link'];

    protected $casts = ['machine_type' => 'array'];

    public function users() : BelongsTo {
        return $this->belongsTo(User::class,'user_id');
    }
}
