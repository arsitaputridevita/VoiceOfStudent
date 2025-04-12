<?php
namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;



class PengumumanController extends Controller
{
    /**
     * Tambahkan middleware untuk memastikan hanya user yang login yang bisa mengakses.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menampilkan daftar pengumuman.
     */
  public function index()
{
    $pengumuman = Pengumuman::latest()->get();

    if (request()->is('pengumuman')) {
        return view('pengumuman', compact('pengumuman'));
    }

    return view('backend.pengumuman.index', compact('pengumuman'));
}


    // $pengumuman = Pengumuman::latest()->get(); // Ambil semua pengumuman

    // // Jika user mengakses halaman dari '/pengumuman', tampilkan view user
    //     if (request()->is('pengumuman')) {
    //         return view('pengumuman', compact('pengumuman'));
    //     } 

    //     // Jika admin mengakses dari '/backend/pengumuman', tampilkan view admin
    //     return view('backend.pengumuman.index', compact('pengumuman'));



    /**
     * Menampilkan form untuk membuat pengumuman baru.
     */
    public function create()
    {
        return view('backend.pengumuman.create');
    }

    /**
     * Menyimpan pengumuman baru ke dalam database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required',
            'deskripsi' => 'required',
            'tanggal'   => 'required|date',
        ]);

        Pengumuman::create([
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal'   => $request->tanggal,
        ]);

        return redirect()->route('backend.pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail dari satu pengumuman.
     */
    public function show($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('detail_pengumuman', compact('pengumuman'));
    }

    /**
     * Menampilkan form edit pengumuman.
     */
    public function edit($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('backend.pengumuman.edit', compact('pengumuman'));
    }

    /**
     * Menyimpan perubahan data pengumuman yang sudah diedit.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'     => 'required',
            'deskripsi' => 'required',
            'tanggal'   => 'required|date',
        ]);

        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->update([
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal'   => $request->tanggal,
        ]);

        return redirect()->route('backend.pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui!');
    }

    /**
     * Menghapus pengumuman dari database.
     */
    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->delete();

        return redirect()->route('backend.pengumuman.index')->with('success', 'Pengumuman berhasil dihapus!');
    }
// public function like($id)
// {
//     if (!Auth::check()) {
//         return redirect()->route('login');
//     }

//     $sudahLike = Like::where('user_id', Auth::id())
//         ->where('pengumuman_id', $id)
//         ->exists();

//     if (!$sudahLike) {
//         Like::create([
//             'user_id' => Auth::id(),
//             'pengumuman_id' => $id,
//         ]);
//     }

//     return redirect()->back();
// }

}
