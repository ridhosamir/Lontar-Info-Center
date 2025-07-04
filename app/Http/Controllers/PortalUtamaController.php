<?php

namespace App\Http\Controllers;

use App\Models\PortalUtama;
use Illuminate\Http\Request;

class PortalUtamaController extends Controller
{
    public function index()
    {
        $portalUtamas = PortalUtama::all();
        return view('admins.portal-utama', compact('portalUtamas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_portal_user' => 'required',
            'keterangan_user' => 'nullable',
            'link' => 'nullable|url'
        ]);

        PortalUtama::create($request->all());

        return redirect()->route('admins.portal-utama')->with('success', 'Portal Utama created successfully.');
    }

    public function update(Request $request, PortalUtama $portalUtama)
    {
        $request->validate([
            'nama_portal_user' => 'required',
            'keterangan_user' => 'nullable',
            'link' => 'nullable|url'
        ]);

        $portalUtama->update($request->all());

        return redirect()->route('admins.portal-utama')->with('success', 'Portal Utama updated successfully.');
    }

    public function destroy(PortalUtama $portalUtama)
    {
        $portalUtama->delete();
        return redirect()->route('admins.portal-utama')->with('success', 'Portal Utama deleted successfully.');
    }
}