<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class kategori extends Model
{
  use HasFactory;
    protected $fillable = ['kategori'];
    protected $visible = ['kategori'];

  public function departemen()
{
    return $this->hasMany(Departemen::class, 'departemen_id');
}
}
