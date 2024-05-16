<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = ['area_id', 'title','remarks','start_date','end_date'];

    public function area_groups(): BelongsTo {
        return $this->belongsTo(AreaGroup::class,'area_id','id');
    }

}
