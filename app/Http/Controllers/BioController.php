<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BioController extends Controller
{
    public function create(Request $request)
    {
        return view("bio.create");
    }

    public function store(Request $request)
    {
        $path = $request->file('file')->store('uploads', 'public');
        $randomString = randomString();

        $file = File::create(['path' => $path, 'name' => $request->file('file')->getClientOriginalName()]);
        $file->kalta()->create([
            'url' => $randomString,
            'user_id' => 1,
            'ip' => $request->ip()
        ]);
        return redirect()->back()->with('success', 'File uploaded successfully!');
        return view("bio.store");
    }
}
