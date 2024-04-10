<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Machine extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id','customer_type', 'area_id',
        'branch', 'terminal_id','sn', 'machine_type',
        'address', 'zona', 'service_status','pengelola',
        'lat','long'];

    public function customers():BelongsTo {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function area_groups():BelongsTo {
        return $this->belongsTo(AreaGroup::class, 'area_id');
    }
}
