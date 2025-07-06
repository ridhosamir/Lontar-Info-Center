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
     * @return \Illuminate\Http\Response
     */
public function index()
{
    try {
        // Check if click_count column exists
        $hasClickCountColumn = DB::getSchemaBuilder()->hasColumn('portal_utamas', 'click_count');

        if ($hasClickCountColumn) {
            // Get all portal items ordered by click count (most clicked first)
            $portalItems = PortalUtama::orderBy('click_count', 'desc')
                            ->paginate(4); // Show 9 items per page (3x3 grid)
        } else {
            // If click_count doesn't exist, order by id as fallback
            $portalItems = PortalUtama::paginate(9);
        }

        return view('welcome', compact('portalItems'));
    } catch (QueryException $e) {
        // Fallback if there's any database error
        return view('welcome');
    }
}
}