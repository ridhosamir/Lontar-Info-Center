<?php

namespace App\Http\Controllers;

use App\Models\PortalAdmin;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function showDashboard(Request $request)
    {
        $search = $request->input('search');
        $query = PortalAdmin::query();
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_portal_admin', 'like', "%{$search}%")
                  ->orWhere('keterangan_admin', 'like', "%{$search}%")
                  ->orWhere('link', 'like', "%{$search}%");
            });
        }

        $portalAdmins = $query->paginate(4);

        return view('admins.dashboard-admin', compact('portalAdmins'));
    }
}