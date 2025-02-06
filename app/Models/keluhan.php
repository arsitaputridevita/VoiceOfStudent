<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
        public $table = 'keluhans';


    use HasFactory;

    protected $fillable = ['kategori_id', 'deskripsi', 'departemen_id', 'priority_id', 'status'];
    protected $visible = ['kategori_id', 'deskripsi', 'departemen_id', 'priority_id', 'status'];

    public function kategori()
    {
        return $this->hasMany(Kategori::class, 'kategori_id');
    }
    public function departemen()
    {
        return $this->hasMany(Departemen::class, 'departemen_id');
    }
    public function priority()
    {
        return $this->hasMany(Priority::class, 'priority_id');
    }
}
