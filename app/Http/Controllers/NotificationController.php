<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session; // Tambahkan baris ini


class NotificationController extends Controller
{
    public function index()
    {
        return view('notification');
    }

    public function sukses()
    {
        Session::flash('sukses', 'Data berhasil disimpan.');
        return redirect()->route('route_name');
    }

    public function gagal()
    {
        Session::flash('gagal', 'Terjadi kesalahan saat menyimpan data.');
        return redirect()->route('route_name');
    }
}
