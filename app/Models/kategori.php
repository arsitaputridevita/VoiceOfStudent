<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
// <- INI PENTING, HARUS DIAWALI DENGAN 'Illuminate'

class Kategori extends Model
{
    use HasFactory;

    protected $table    = 'kategoris';
    protected $fillable = ['kategori'];
    protected $visible  = ['kategori'];

    public function departemen()
    {
        return $this->hasMany(Departemen::class, 'kategori_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($kategori) {
            if ($kategori->departemen()->count() > 0) {
                $html = 'Kategori tidak bisa dihapus karena masih memiliki departemen:<ul>';
                foreach ($kategori->departemen as $data) {
                    $html .= "<li>{$data->nama}</li>";
                }
                $html .= '</ul>';

                Session::flash('toast_notification', [
                    'level'   => 'error',
                    'message' => $html,
                ]);

                return false;
            }
        });
    }
}
