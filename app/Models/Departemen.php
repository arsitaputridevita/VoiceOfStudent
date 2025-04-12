<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Departemen extends Model
{
    protected $table = 'departemens'; // Sesuaikan dengan nama tabel
     use HasFactory;
    protected $fillable = ['nama','kategori_id','deskripsi','image'];
    protected $visible = ['nama','kategori_id','deskripsi','image'];

   public function kategori()
{
    return $this->belongsTo(Kategori::class, 'kategori_id');
}
public function keluhan()
{
    return $this->hasMany (Keluhan::class, 'keluhan_id');
}



}
