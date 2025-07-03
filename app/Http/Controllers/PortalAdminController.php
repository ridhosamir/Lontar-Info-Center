<?php

namespace App\Http\Controllers;

use App\Models\PortalAdmin;
use Illuminate\Http\Request;

class PortalAdminController extends Controller
{
    public function index()
    {
        $portalAdmins = PortalAdmin::all();
        return view('admin.portal_admin.index', compact('portalAdmins'));
    }

    public function create()
    {
        return view('admin.portal_admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_portal_admin' => 'required',
            'keterangan_admin' => 'nullable'
        ]);

        PortalAdmin::create($request->all());

        return redirect()->route('portal-admin.index')->with('success', 'Portal Admin created successfully.');
    }

    public function show(PortalAdmin $portalAdmin)
    {
        return view('admin.portal_admin.show', compact('portalAdmin'));
    }

    public function edit(PortalAdmin $portalAdmin)
    {
        return view('admin.portal_admin.edit', compact('portalAdmin'));
    }

    public function update(Request $request, PortalAdmin $portalAdmin)
    {
        $request->validate([
            'nama_portal_admin' => 'required',
            'keterangan_admin' => 'nullable'
        ]);

        $portalAdmin->update($request->all());

        return redirect()->route('portal-admin.index')->with('success', 'Portal Admin updated successfully.');
    }

    public function destroy(PortalAdmin $portalAdmin)
    {
        $portalAdmin->delete();
        return redirect()->route('portal-admin.index')->with('success', 'Portal Admin deleted successfully.');
    }
}