<?php
namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::latest()->paginate();
        return view('backend.kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kategori' => 'required',
        ]);

        $kategori           = new Kategori;
        $kategori->kategori = $request->kategori;
        $kategori->save();

        return redirect()->route('backend.kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Bisa tambahkan detail kategori di sini kalau diperlukan
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('backend.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'kategori' => 'required',
        ]);

        $kategori           = Kategori::findOrFail($id);
        $kategori->kategori = $request->kategori;
        $kategori->save();

        return redirect()->route('backend.kategori.index')->with('success', 'Kategori berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::find($id);

        if (! $kategori) {
            return redirect()->back()->with('error', 'Kategori tidak ditemukan.');
        }

        // Cek apakah punya relasi departemen
        if ($kategori->departemen()->count() > 0) {
            $html = 'Kategori tidak bisa dihapus karena masih memiliki departemen:<ul>';
            foreach ($kategori->departemen as $data) {
                $html .= "<li>{$data->nama}</li>";
            }
            $html .= '</ul>';

            return redirect()->route('backend.kategori.index')->with('error', $html);
        }

        $kategori->delete();
        return redirect()->route('backend.kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
