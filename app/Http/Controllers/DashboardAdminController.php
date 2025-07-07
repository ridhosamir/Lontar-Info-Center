<?php

namespace App\Http\Controllers;

use App\Models\PortalAdmin;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function showDashboard(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort');
        $query = PortalAdmin::query();
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_portal_admin', 'like', "%{$search}%")
                  ->orWhere('keterangan_admin', 'like', "%{$search}%")
                  ->orWhere('link', 'like', "%{$search}%");
            });
        }

        if ($sort === 'asc') {
            $query->orderBy('nama_portal_admin', 'asc');
        } elseif ($sort === 'desc') {
            $query->orderBy('nama_portal_admin', 'desc');
        }

        $portalAdmins = $query->paginate(6)->appends($request->except('page'));

        return view('admins.dashboard-admin', compact('portalAdmins'));
    }
}