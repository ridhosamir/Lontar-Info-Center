<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ReminderController extends Controller
{
    public function index()
    {
        $reminder = Reminder::firstOrCreate(
            [],
            ['pesan' => 'Silakan atur pesan reminder di sini.']
        );
        return view('admins.manage-reminder', compact('reminder'));
    }

    public function update(Request $request, Reminder $reminder)
    {
        $request->validate([
            'update_type' => 'required|in:pesan,gambar',
            'pesan' => 'required_if:update_type,pesan|required_if:update_type,message',
            'gambar' => 'required_if:update_type,gambar|required_if:update_type,image|image|mimes:jpeg,png,jpg,gif|max:10240',
        ], [
            'pesan.required_if' => 'The message field is required.',
            'gambar.required_if' => 'The image field is required.',
            'gambar.image' => 'The uploaded file must be an image.',
            'gambar.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'gambar.max' => 'The image may not be greater than 10240 kilobytes.',
            'update_type.in' => 'The selected update type is invalid.',
            'update_type.required' => 'The update type is required.',
        ]);

        $updateType = $request->input('update_type');

        if ($updateType === 'pesan') {
            if ($reminder->gambar && File::exists(public_path('images/reminders/' . $reminder->gambar))) {
                File::delete(public_path('images/reminders/' . $reminder->gambar));
            }

            $reminder->update([
                'pesan' => $request->pesan,
                'gambar' => null,
            ]);
        } elseif ($updateType === 'gambar' && $request->hasFile('gambar')) {
            if ($reminder->gambar && File::exists(public_path('images/reminders/' . $reminder->gambar))) {
                File::delete(public_path('images/reminders/' . $reminder->gambar));
            }

            $image = $request->file('gambar');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/reminders'), $imageName);

            $reminder->update([
                'pesan' => null,
                'gambar' => $imageName,
            ]);
        }

        return redirect()->route('admins.manage-reminder')->with('success', 'Reminder updated successfully.');
    }
}