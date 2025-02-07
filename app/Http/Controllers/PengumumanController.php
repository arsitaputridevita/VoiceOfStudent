<?php

namespace App\Http\Controllers;
use App\Models\Pengumuman;
use RealRashid\SweetAlert\Facades\Alert;


use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $pengumuman =Pengumuman::latest()->paginate(5);
        $title = 'Delete User!';
        $text  = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('backend.pengumuman.index', compact('pengumuman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pengumuman.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required',
        ]);

        $pengumuman = new Pengumuman;
        $pengumuman->judul = $request->judul;
        $pengumuman->deskripsi = $request->deskripsi;
        $pengumuman->tanggal = $request->tanggal; 
        $pengumuman->save();
        Alert::success('Success', 'Success Message');

        return redirect()->route('backend.pengumuman.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('backend.pengumuman.show', compact('pengumuman'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
    return view('backend.pengumuman.edit', compact('pengumuman'));
    
        $pengumuman->save();
        return redirect()->route('backend.pengumuman.index');


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
    'judul'      => 'required',
    'deskripsi'     => 'required',
    'tanggal' => 'required',
]);

        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->judul  = $request->judul;
        $pengumuman->deskripsi  = $request->deskripsi;
        $pengumuman->tanggal = $request->tanggal;
        $pengumuman->save();
        Alert::success('Success', 'Success Message');

        return redirect()->route('backend.pengumuman.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    $pengumuman = Pengumuman::findOrFail($id);
    $pengumuman->delete();
    toast('Data Delete Succesfully', 'succes')->autoClose(1000);
    return redirect()->route('backend.pengumuman.index');

    }
}
