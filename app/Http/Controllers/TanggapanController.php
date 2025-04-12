<?php
namespace App\Http\Controllers;

use App\Models\Keluhan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;

class TanggapanController extends Controller
{
    /**
     * Middleware auth untuk membatasi akses hanya bagi user yang login.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menampilkan daftar tanggapan.
     */
    public function index()
    {
        $tanggapans = Tanggapan::latest()->get(); // Ambil semua tanggapan

        // Jika user mengakses halaman dari '/tanggapan', tampilkan view user
        if (request()->is('tanggapan')) {
            return view('tanggapan', compact('tanggapans'));
        }

        // Jika admin mengakses dari '/backend/tanggapan', tampilkan view admin
        return view('backend.tanggapan.index', compact('tanggapans'));
    }

    /**
     * Menampilkan form untuk membuat tanggapan baru.
     */
    public function create()
    {
        $keluhans = Keluhan::all(); // Ambil semua keluhan untuk dipilih
        return view('backend.tanggapan.create', compact('keluhans'));
    }

    /**
     * Menyimpan tanggapan baru ke dalam database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'keluhan_id' => 'required|exists:keluhans,id',
            'tanggapan'  => 'required|string',
        ]);

        Tanggapan::create([
            'keluhan_id' => $request->keluhan_id,
            'tanggapan'  => $request->tanggapan,
        ]);

        return redirect()->route('backend.tanggapan.index')->with('success', 'Tanggapan berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail dari satu tanggapan.
     */
    public function show($id)
    {
        $tanggapan = Tanggapan::findOrFail($id);
        return view('detail_tanggapan', compact('tanggapan'));
    }

    /**
     * Menampilkan form edit tanggapan.
     */
    public function edit($id)
    {
        $tanggapan = Tanggapan::findOrFail($id);
        return view('backend.tanggapan.edit', compact('tanggapan'));
    }

    /**
     * Menyimpan perubahan data tanggapan yang sudah diedit.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggapan' => 'required|string',
        ]);

        $tanggapan = Tanggapan::findOrFail($id);
        $tanggapan->update([
            'tanggapan' => $request->tanggapan,
        ]);

        return redirect()->route('backend.tanggapan.index')->with('success', 'Tanggapan berhasil diperbarui!');
    }

    /**
     * Menghapus tanggapan dari database.
     */
    public function destroy($id)
    {
        $tanggapan = Tanggapan::findOrFail($id);
        $tanggapan->delete();

        return redirect()->route('backend.tanggapan.index')->with('success', 'Tanggapan berhasil dihapus!');
    }
}
