<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    public $table = 'pengumuman';
    use HasFactory;

    protected $fillable = ['judul', 'deskripsi', 'tanggal'];

//    public function like() {
    
//    }


}
