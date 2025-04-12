<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id', 'pengumuman_id'];

    // public function pengumuman()
    // {
    //     return $this->belongsTo(Pengumuman::class);
    // }

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
