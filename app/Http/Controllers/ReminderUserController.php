<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReminderUserController extends Controller
{
    /**
     * Get a random reminder for display
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getReminder()
    {
        try {
            // Get a random reminder from the database
            $reminder = Reminder::inRandomOrder()->first();
            
            // If no reminder found
            if (!$reminder) {
                return response()->json(['success' => false]);
            }
            
            // Determine type of content based on what's available
            if (!empty($reminder->gambar)) {
                // Image type reminder
                return response()->json([
                    'success' => true,
                    'type' => 'gambar',
                    'image_path' => asset('images/reminders/' . $reminder->gambar)
                ]);
            } elseif (!empty($reminder->pesan)) {
                // Text type reminder
                return response()->json([
                    'success' => true,
                    'type' => 'pesan',
                    'message' => $reminder->pesan
                ]);
            } else {
                // Empty reminder
                return response()->json(['success' => false]);
            }
        } catch (\Exception $e) {
            Log::error('Error fetching reminder: ' . $e->getMessage());
            return response()->json(['success' => false]);
        }
    }
}