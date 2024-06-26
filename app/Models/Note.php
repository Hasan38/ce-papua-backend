<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Note extends Model
{
    use HasFactory;
    protected $fillable= ['machine_id','user_id', 'title','content'];

    public function machines() : BelongsTo{
        return $this->belongsTo(Machine::class,'machine_id');
    }

    public function users() : BelongsTo {
        return $this->belongsTo(User::class,'user_id');
    }
}
