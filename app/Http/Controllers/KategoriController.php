<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kategori;


class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $kategori =Kategori::latest()->paginate(5);
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

        $kategori = new kategori;
        $kategori->kategori = $request->kategori;
        $kategori->save();
        return redirect()->route('backend.kategori.index');
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
        $kategori = Kategori::findOrFail($id);
    return view('backend.kategori.edit', compact('kategori'));

        $kategori->save();
        return redirect()->route('kategori.index');


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
    'kategori'      => 'required',
    
]);

        $kategori = kategori::findOrFail($id);
        $kategori->kategori  = $request->kategori;
        $kategori->save();
        return redirect()->route('backend.kategori.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    $kategori = kategori::findOrFail($id);
    $kategori->delete();
    return redirect()->route('backend.kategori.index');

    }
}
