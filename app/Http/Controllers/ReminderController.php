<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public function index()
    {
        $reminders = Reminder::all();
        return view('admin.reminder.index', compact('reminders'));
    }

    public function create()
    {
        return view('admin.reminder.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pesan' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images/reminders'), $imageName);
            $data['gambar'] = $imageName;
        }

        Reminder::create($data);

        return redirect()->route('reminder.index')->with('success', 'Reminder created successfully.');
    }

    public function show(Reminder $reminder)
    {
        return view('admin.reminder.show', compact('reminder'));
    }

    public function edit(Reminder $reminder)
    {
        return view('admin.reminder.edit', compact('reminder'));
    }

    public function update(Request $request, Reminder $reminder)
    {
        $request->validate([
            'pesan' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($reminder->gambar && file_exists(public_path('images/reminders/'.$reminder->gambar))) {
                unlink(public_path('images/reminders/'.$reminder->gambar));
            }

            $image = $request->file('gambar');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images/reminders'), $imageName);
            $data['gambar'] = $imageName;
        }

        $reminder->update($data);

        return redirect()->route('reminder.index')->with('success', 'Reminder updated successfully.');
    }

    public function destroy(Reminder $reminder)
    {
        if ($reminder->gambar && file_exists(public_path('images/reminders/'.$reminder->gambar))) {
            unlink(public_path('images/reminders/'.$reminder->gambar));
        }

        $reminder->delete();

        return redirect()->route('reminder.index')->with('success', 'Reminder deleted successfully.');
    }
}