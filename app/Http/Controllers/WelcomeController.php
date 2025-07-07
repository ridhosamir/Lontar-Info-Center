<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PortalUtama;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\Poster; 

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
            $isAjax = $request->input('ajax', 0);
            
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
            $posters = Poster::all();

            // Check if this is an AJAX request
            if ($isAjax == 1) {
                return response()->json([
                    'success' => true,
                    'data' => $portalItems->items(),
                    'pagination' => [
                        'current_page' => $portalItems->currentPage(),
                        'last_page' => $portalItems->lastPage(),
                        'per_page' => $portalItems->perPage(),
                        'total' => $portalItems->total()
                    ]
                ]);
            }

            return view('welcome', compact('portalItems', 'search', 'posters'));
        } catch (QueryException $e) {
            // Handle AJAX error responses
            if ($request->input('ajax', 0) == 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Database error occurred'
                ]);
            }
            
            // Fallback for regular requests
            return view('welcome')->with('error', 'Database error occurred');
        }
    }
}