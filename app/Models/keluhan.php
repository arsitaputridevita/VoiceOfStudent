<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    
    use HasFactory;

    protected $fillable = ['jenis', 'deskripsi', 'kategori_id', 'priority_id', 'status','like','dislike'];

    public function departemen()
    {
        return $this->belongsTo(Departemen::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function tanggapan()
    {
        return $this->hasOne(Tanggapan::class, 'keluhan_id', 'id');
    }
}

