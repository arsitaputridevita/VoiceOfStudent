<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{

    public $table = 'priorities';

    use HasFactory;
    protected $fillable = ['priority'];
    protected $visible  = ['priority'];

    public function keluhan()
    {
        return $this->hasMany(Keluhan::class, 'keluhan_id');
    }
}
