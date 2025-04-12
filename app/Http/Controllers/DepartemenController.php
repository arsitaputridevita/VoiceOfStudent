<?php
namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DepartemenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $departemen = Departemen::latest()->get(); // Ambil semua departemen

    // Jika user mengakses halaman dari '/departemen', tampilkan view user
    if (request()->is('departemen')) {
        return view('departemen', compact('departemen'));
    }

    // Jika admin mengakses dari '/backend/departemen', tampilkan view admin
    return view('backend.departemen.index', compact('departemen'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori   = Kategori::all(); // Perbaikan variabel
        $departemen = Departemen::all();
        return view('backend.departemen.create', compact('kategori', 'departemen'));
    }

    /**
     * Store a newly created resource in storage.

     */
    public function store(Request $request)
    {
        // dd($request->all());

        // Validasi input
        $this->validate($request, [
            'nama'        => 'required|string|max:255',
            'kategori_id' => 'required|integer|exists:kategoris,id', // Pastikan kategori_id valid
            'deskripsi'   => 'required|min:1',
            'image'       => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        // Upload dan simpan gambar
        $image     = $request->file('image');
        $imageName = $image->hashName();
        Storage::putfile('departemens', $image);
        // $image->storeAs('public/departemens', $imageName); // Simpan di storage

        // Simpan data ke database
        Departemen::create([
            'nama'        => $request->nama,
            'kategori_id' => $request->kategori_id,
            'deskripsi'   => $request->deskripsi,
            'image'       => $imageName,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('backend.departemen.index')->with('success', 'Departemen berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $departemen = Departemen::findOrFail($id);
        return view('detail_departemen', compact('departemen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $departemen = Departemen::findOrFail($id);
        $kategori   = Kategori::all();
        return view('backend.departemen.edit', compact('departemen', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama'        => 'required|string|max:255',
            'kategori_id' => 'required|integer|exists:kategoris,id',
            'deskripsi'   => 'required|min:10',
            'image'       => 'nullable|image|mimes:jpeg,jpg,png|max:2048', // Gambar opsional saat update
        ]);

        $departemen              = Departemen::findOrFail($id);
        $departemen->nama        = $request->nama;
        $departemen->kategori_id = $request->kategori_id;
        $departemen->deskripsi   = $request->deskripsi;

        // Cek apakah ada file gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            Storage::delete('public/departemens/' . $departemen->image);

            // Upload gambar baru
            $image     = $request->file('image');
            $imageName = $image->hashName();
            Storage::putfile('departemens', $image);
            // $image->storeAs('public/departemens', $imageName);
            $departemen->image = $imageName;
        }

        // Simpan perubahan
        $departemen->save();

        return redirect()->route('backend.departemen.index')->with('success', 'Departemen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $departemen = Departemen::findOrFail($id);

        // Hapus gambar terkait
        Storage::delete('public/departemens/' . $departemen->image);

        // Hapus data departemen
        $departemen->delete();

        return redirect()->route('backend.departemen.index')->with('success', 'Departemen berhasil dihapus.');
    }
}
