<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inmate extends Model
{
    use HasFactory;
    protected $fillable = [
         'district_id', 'ulb_id','suh_id','genid', 'name', 'gender', 'category', 'type','age','special_abled','father','mother',
        'address','city','state', 'idistrict', 'pin', 'id_type', 'id_no', 'birthmark','know_person', 'know_mobile', 'vaccinated','desc', 'photo','created_by'
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function ulb()
    {
        return $this->belongsTo(Ulb::class);
    }
    public function suh()
    {
        return $this->belongsTo(Suh::class);
    }
}
