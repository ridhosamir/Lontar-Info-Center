<?php

namespace App\Http\Controllers;

use App\Models\PortalUtama;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PortalUtamaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort');
        $query = PortalUtama::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_portal_user', 'like', "%{$search}%")
                    ->orWhere('keterangan_user', 'like', "%{$search}%")
                    ->orWhere('link', 'like', "%{$search}%");
            });
        }

        if ($sort === 'asc') {
            $query->orderBy('nama_portal_user', 'asc');
        } elseif ($sort === 'desc') {
            $query->orderBy('nama_portal_user', 'desc');
        }

        $portalUtamas = $query->paginate(6)->appends($request->except('page'));

        return view('admins.portal-utama', compact('portalUtamas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_portal_user' => 'required|string|max:255|unique:portal_utamas,nama_portal_user',
            'keterangan_user' => 'nullable|string',
            'link' => 'required|url'
        ]);

        try {
            PortalUtama::create($request->all());
            return response()->json(['message' => 'Portal Utama created successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating portal: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_portal_user' => [
                'required',
                'string',
                'max:255',
                Rule::unique('portal_utamas', 'nama_portal_user')->ignore($id, 'id_portal_utama')
            ],
            'keterangan_user' => 'nullable|string',
            'link' => 'required|url',
        ]);

        try {
            $portalUtama = PortalUtama::findOrFail($id);
            $portalUtama->update($request->all());
            return response()->json(['message' => 'Portal Utama updated successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating portal: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $portalUtama = PortalUtama::findOrFail($id);
            $portalUtama->delete();
            return response()->json(['message' => 'Portal Utama deleted successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting portal: ' . $e->getMessage()], 500);
        }
    }
}