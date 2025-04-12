<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;

    protected $table = 'tanggapan'; // Sesuaikan dengan nama tabel yang benar

    protected $fillable = ['keluhan_id', 'tanggapan'];

    public function keluhan()
    {
        return $this->belongsTo(Keluhan::class, 'keluhan_id', 'id');
    }
}
