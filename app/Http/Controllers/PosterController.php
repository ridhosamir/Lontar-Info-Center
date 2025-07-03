<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use Illuminate\Http\Request;

class PosterController extends Controller
{
    public function index()
    {
        $posters = Poster::all();
        return view('admin.poster.index', compact('posters'));
    }

    public function create()
    {
        return view('admin.poster.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $image = $request->file('gambar');
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images/posters'), $imageName);

        Poster::create(['gambar' => $imageName]);

        return redirect()->route('poster.index')->with('success', 'Poster created successfully.');
    }

    public function show(Poster $poster)
    {
        return view('admin.poster.show', compact('poster'));
    }

    public function edit(Poster $poster)
    {
        return view('admin.poster.edit', compact('poster'));
    }

    public function update(Request $request, Poster $poster)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Hapus gambar lama
        if ($poster->gambar && file_exists(public_path('images/posters/'.$poster->gambar))) {
            unlink(public_path('images/posters/'.$poster->gambar));
        }

        $image = $request->file('gambar');
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images/posters'), $imageName);

        $poster->update(['gambar' => $imageName]);

        return redirect()->route('poster.index')->with('success', 'Poster updated successfully.');
    }

    public function destroy(Poster $poster)
    {
        if ($poster->gambar && file_exists(public_path('images/posters/'.$poster->gambar))) {
            unlink(public_path('images/posters/'.$poster->gambar));
        }

        $poster->delete();

        return redirect()->route('poster.index')->with('success', 'Poster deleted successfully.');
    }
}