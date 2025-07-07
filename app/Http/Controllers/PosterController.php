<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PosterController extends Controller
{
    public function index()
    {
        $posters = Poster::latest()->paginate(8);
        return view('admins.manage-poster', compact('posters'));
    }

    public function getAllPosters()
    {
        $posters = Poster::latest()->get();
        return response()->json($posters);
    }

    public function create()
    {
        return view('admins.manage-poster');
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|array',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/posters'), $imageName);
                Poster::create(['gambar' => $imageName]);
            }
        }

        return redirect()->route('admins.manage-poster')->with('success', 'Poster(s) created successfully.');
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

        $imagePath = public_path('images/posters/' . $poster->gambar);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $image = $request->file('gambar');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('images/posters'), $imageName);

        $poster->update(['gambar' => $imageName]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => 'Poster updated successfully.']);
        }

        return redirect()->route('admins.manage-poster')->with('success', 'Poster updated successfully.');
    }

    public function destroy(Request $request, Poster $poster)
    {
        $imagePath = public_path('images/posters/' . $poster->gambar);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $poster->delete();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => 'Poster deleted successfully.']);
        }

        return redirect()->route('admins.manage-poster')->with('success', 'Poster deleted successfully.');
    }

    public function destroyMultiple(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:posters,id_poster'
        ]);

        $ids = $request->input('ids');
        $posters = Poster::whereIn('id_poster', $ids)->get();

        foreach ($posters as $poster) {
            $imagePath = public_path('images/posters/' . $poster->gambar);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        Poster::whereIn('id_poster', $ids)->delete();

        return redirect()->route('admins.manage-poster')->with('success', 'Selected posters deleted successfully.');
    }
}