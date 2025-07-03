<?php

namespace App\Http\Controllers;

use App\Models\PortalUtama;
use Illuminate\Http\Request;

class PortalUtamaController extends Controller
{
    public function index()
    {
        $portalUtamas = PortalUtama::all();
        return view('admin.portal_utama.index', compact('portalUtamas'));
    }

    public function create()
    {
        return view('admin.portal_utama.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_portal_user' => 'required',
            'keterangan_user' => 'nullable'
        ]);

        PortalUtama::create($request->all());

        return redirect()->route('portal-utama.index')->with('success', 'Portal Utama created successfully.');
    }

    public function show(PortalUtama $portalUtama)
    {
        return view('admin.portal_utama.show', compact('portalUtama'));
    }

    public function edit(PortalUtama $portalUtama)
    {
        return view('admin.portal_utama.edit', compact('portalUtama'));
    }

    public function update(Request $request, PortalUtama $portalUtama)
    {
        $request->validate([
            'nama_portal_user' => 'required',
            'keterangan_user' => 'nullable'
        ]);

        $portalUtama->update($request->all());

        return redirect()->route('portal-utama.index')->with('success', 'Portal Utama updated successfully.');
    }

    public function destroy(PortalUtama $portalUtama)
    {
        $portalUtama->delete();
        return redirect()->route('portal-utama.index')->with('success', 'Portal Utama deleted successfully.');
    }
}