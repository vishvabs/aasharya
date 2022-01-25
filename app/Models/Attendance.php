<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'inmate_id', 'is_present','created_by'
      ];

      public function inmate()
      {
          return $this->belongsTo(Inmate::class);
      }
}
