<?php
namespace App\Http\Controllers;

use App\Models\Priority;
use Illuminate\Http\Request;

class PriorityControllers extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $priority = Priority::latest()->paginate(5);
        return view('backend.priority.index', compact('priority'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.priority.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'priority' => 'required|string',
        ]);

       $priority           = new Priority;
       $priority->priority = $request->priority;
       $priority->save();
        return redirect()->route('backend.priority.index')->with('succes', 'Priority berhasil ditambahan!');
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
       $priority = Priority::findOrFail($id);
        return view('backend.priority.edit', compact('priority'));

       $priority->save();
        return redirect()->route('backend.priority.index');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'priority' => 'required',

        ]);

       $priority           = Priority::findOrFail($id);
       $priority->priority = $request->priority;
       $priority->save();
        return redirect()->route('backend.priority.index')->with('succes','Priority berhasil diupdate!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $priority = Priority::findOrFail($id);
       $priority->delete();
        return redirect()->route('backend.priority.index')->with('succes!!','berhasil di delete!');

    }
}
