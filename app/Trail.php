<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trail extends Model
{
   protected $table = 'trail';
   
   protected $primaryKey = 'id';

   protected $fillable = [
       'customer_id','trail_to','flying_from','total_cost','created_at','updated_at'
    ];
}
