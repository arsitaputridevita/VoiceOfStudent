<?php
namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Keluhan;
use App\Models\Priority;
use App\Models\Tanggapan;
use Illuminate\Http\Request;

class KeluhanController extends Controller
{
    
    
         public function index()
    {
        $jenis  = request()->get('jenis');
        $status = request()->get('status');

        $keluhanQuery = Keluhan::with(['kategori', 'priority', 'tanggapan'])->latest();

        if ($jenis) {
            $keluhanQuery->where('jenis', $jenis);
        }

        if ($status) {
            $keluhanQuery->where('status', $status);
        }

        // Mengambil keluhan dan termasuk like
        $keluhan = $keluhanQuery->get();

        if (request()->is('keluhan')) {
            return view('user.keluhan.index', compact('keluhan'));
        }

        return view('backend.keluhan.index', compact('keluhan'));
    }


    public function create()
    {
        $kategori = Kategori::all();
        $priority = Priority::all();

        return view('user.keluhan.create', compact('kategori', 'priority'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis'       => 'required',
            'deskripsi'   => 'required|min:10',
            'kategori_id' => 'required|exists:kategoris,id',
            'priority_id' => 'required|exists:priorities,id',
        ]);

        Keluhan::create($request->only(['jenis', 'deskripsi', 'kategori_id', 'priority_id']));

        return redirect()->route('user.keluhan.index')->with('success', 'Keluhan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $keluhan = Keluhan::with(['tanggapan'])->findOrFail($id);
        return view('user.keluhan.show', compact('keluhan'));
    }

    public function edit($id)
    {
        $keluhan  = Keluhan::findOrFail($id);
        $kategori = Kategori::all();
        $priority = Priority::all();

        if (request()->is('user/keluhan/*/edit')) {
            return view('user.keluhan.edit', compact('keluhan', 'kategori', 'priority'));
        }

        return view('backend.keluhan.edit', compact('keluhan', 'kategori', 'priority'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis'       => 'required',
            'deskripsi'   => 'required|min:10',
            'kategori_id' => 'required|exists:kategoris,id',
            'priority_id' => 'required|exists:priorities,id',
        ]);

        $keluhan = Keluhan::findOrFail($id);
        $keluhan->update($request->only(['jenis', 'deskripsi', 'kategori_id', 'priority_id']));

        if (request()->is('user/*')) {
            return redirect()->route('user.keluhan.index')->with('success', 'Keluhan berhasil diperbarui.');
        }

        return redirect()->route('backend.keluhan.index')->with('success', 'Keluhan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $keluhan = Keluhan::findOrFail($id);
        $keluhan->delete();

        if (request()->is('user/keluhan/*')) {
            return redirect()->route('user.keluhan.index')->with('success', 'Keluhan berhasil dihapus.');
        }

        return redirect()->route('backend.keluhan.index')->with('success', 'Keluhan berhasil dihapus.');
    }

    public function addTanggapan(Request $request)
    {
        $request->validate([
            'keluhan_id' => 'required',
            'tanggapan'  => 'required|string',
        ]);

        Tanggapan::updateOrCreate(
            ['keluhan_id' => $request->keluhan_id],
            ['tanggapan' => $request->tanggapan]
        );

        return redirect()->route('backend.keluhan.index')->with('success', 'Tanggapan berhasil diperbarui.');
    }

    public function like($id)
    {
        $keluhan = Keluhan::findOrFail($id);
        $keluhan->like += 1;
        $keluhan->save();

        return response()->json([
            'success' => true,
            'like'    => $keluhan->like,
        ]);
    }


    public function dislike($id)
    {
        $keluhan = Keluhan::findOrFail($id);
        $keluhan->dislike += 1;
        $keluhan->save();

        return response()->json([
            'success' => true,
            'dislike' => $keluhan->dislike,
        ]);
    }

  public function updateStatus(Request $request, $id)
{
    // Validasi input status
    $request->validate([
        'status' => 'required|in:proses,sedang diproses,selesai',
    ]);

    // Cari keluhan berdasarkan ID
    $keluhan = Keluhan::findOrFail($id);

    // Update status keluhan
    $keluhan->status = $request->status;
    $keluhan->save();

    // Kembalikan respons sukses
    return response()->json([
        'success' => true,
        'message' => 'Status keluhan berhasil diperbarui.',
        'status'  => $keluhan->status,
    ]);
}

}
