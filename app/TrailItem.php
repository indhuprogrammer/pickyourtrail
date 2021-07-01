<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrailItem extends Model
{
   protected $table = 'trail_items';
   
   protected $primaryKey = 'id';

   protected $fillable = [
       'trail_id','date','cost','created_at','updated_at'
    ];
}
