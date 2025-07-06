<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PortalUtama;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class WelcomeController extends Controller
{
    /**
     * Display the welcome page with portal items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $search = $request->input('search');
            
            // Check if click_count column exists
            $hasClickCountColumn = DB::getSchemaBuilder()->hasColumn('portal_utamas', 'click_count');

            $query = PortalUtama::query();
            
            if ($hasClickCountColumn) {
                $query->orderBy('click_count', 'desc');
            } else {
                $query->orderBy('id', 'desc');
            }
            
            if ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('nama_portal_user', 'like', '%' . $search . '%')
                      ->orWhere('keterangan_user', 'like', '%' . $search . '%');
                });
            }

            $portalItems = $query->paginate(6);

            return view('welcome', compact('portalItems', 'search'));
        } catch (QueryException $e) {
            // Fallback if there's any database error
            return view('welcome')->with('error', 'Database error occurred');
        }
    }
}