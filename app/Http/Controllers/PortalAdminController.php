<?php

namespace App\Http\Controllers;

use App\Models\PortalAdmin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PortalAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = PortalAdmin::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_portal_admin', 'like', "%{$search}%")
                  ->orWhere('keterangan_admin', 'like', "%{$search}%")
                  ->orWhere('link', 'like', "%{$search}%");
            });
        }

        $portalAdmins = $query->paginate(8)->appends($request->except('page'));

        return view('admins.portal-admin', compact('portalAdmins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_portal_admin' => 'required|string|max:255|unique:portal_utamas,nama_portal_user',
            'keterangan_admin' => 'nullable|string',
            'link' => 'required|url',
        ]);

        try {
            PortalAdmin::create([
                'nama_portal_admin' => $request->nama_portal_admin,
                'keterangan_admin' => $request->keterangan_admin,
                'link' => $request->link,
            ]);

            return response()->json(['message' => 'Portal successfully created!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating portal: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_portal_admin' => [
                'required',
                'string',
                'max:255',
                Rule::unique('portal_admins', 'nama_portal_admin')->ignore($id, 'id_portal_admin')
            ],
            'keterangan_admin' => 'nullable|string',
            'link' => 'required|url',
        ]);

        try {
            $portal = PortalAdmin::findOrFail($id);
            $portal->update([
                'nama_portal_admin' => $request->nama_portal_admin,
                'keterangan_admin' => $request->keterangan_admin,
                'link' => $request->link,
            ]);

            return response()->json(['message' => 'Portal successfully updated!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating portal: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $portal = PortalAdmin::findOrFail($id);
            $portal->delete();

            return response()->json(['message' => 'Portal successfully deleted!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting portal: ' . $e->getMessage()], 500);
        }
    }
}