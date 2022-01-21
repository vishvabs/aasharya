<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suh extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'district_id', 'ulb_id','genid', 'name', 'address', 'username', 'password','status','created_id','updated_id','suh_status',
        'capacity','geo','is_cctv', 'is_water', 'is_iso', 'hygiene', 'is_food', 'is_vaccination','sma_name', 'sma_payment', 'created_date','sma_date'
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function ulb()
    {
        return $this->belongsTo(Ulb::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // public function created()
    // {
    //     return $this->belongsTo(User::class);
    // }
    // public function updated()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
