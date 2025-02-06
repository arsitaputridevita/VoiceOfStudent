<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Priority extends Model
{

    public $table = 'priority';
  
 use HasFactory;
    protected $fillable = ['priority'];
    protected $visible = ['priority'];   
    
      public function keluhan()
{
    return $this->hasMany(Keluhan::class, 'keluhan_id');
}
}


