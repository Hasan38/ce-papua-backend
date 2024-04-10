<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AreaGroup extends Model
{
    use HasFactory;

    protected $fillable=['regional_id','name','lat','long'];

    public function regionals(): BelongsTo {
        return $this->belongsTo(Regional::class,'regional_id');
    }

    public function users(): HasMany {
        return $this->hasMany(User::class);
    }

    public function machines(): HasMany {
        return $this->hasMany(Machine::class);
    }
}
