<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keluhan;
use App\Models\Departemen;
use App\Models\Priority;

class KeluhanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $keluhan = Keluhan::latest()->paginate(5);
    return view('backend.keluhan.index', compact('keluhan'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departemen = Departemen::all();
        $priority  = Priority::all();
        $keluhan = Keluhan::all();
        return view('backend.keluhan.create', compact('kategori','departemen','priority','keluhan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'deskripsi'   => 'required|min:10',
        'departemen_id' => 'required',
        'priority_id' => 'required',
]);

// Buat objek Departemen
    $keluhan              = new Keluhan();
        $keluhan->deskripsi   = $request->deskripsi;
    $keluhan->departemen_id = $request->departemen_id;
    $keluhan->priority_id = $request->priority_id;
    $keluhan->save();

return redirect()->route('backend.keluhan.index')->with('success', 'Departemen berhasil ditambahkan.');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $departemen = Departemen::findOrFail($id);
        $priority = Priority::all();
        $keluhan = Keluhan::all();
        return view('backend.departemen.edit', compact('departemen', 'priority','keluhan'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
    'deskripsi'   => 'required|min:1',
    'departemen_id' => 'required|',
    'priority_id' => 'required|',

]);

    $keluhan              = Keluhan::findOrFail($id);
    $keluhan->deskripsi   = $request->deskripsi;
    $keluhan->departemen_id = $request->departemen_id;
    $keluhan->priority_id = $request->priority_id;
    $keluhan->save();


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
