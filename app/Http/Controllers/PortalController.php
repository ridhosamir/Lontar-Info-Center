<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PortalUtama;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class PortalController extends Controller
{
    /**
     * Record a click on a portal item and redirect to its URL.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function click($id)
    {
        try {
            $portalItem = PortalUtama::findOrFail($id);
            
            // Check if click_count column exists before incrementing
            $hasClickCountColumn = DB::getSchemaBuilder()->hasColumn('portal_utamas', 'click_count');
            
            if ($hasClickCountColumn) {
                // Increment the click count
                $portalItem->increment('click_count');
            }
            
            // Redirect to the portal link
            return redirect($portalItem->link);
        } catch (QueryException $e) {
            // If there's any database error, just redirect without incrementing
            if (isset($portalItem)) {
                return redirect($portalItem->link);
            }
            
            // If portal item not found, redirect to home
            return redirect('/');
        }
    }
}