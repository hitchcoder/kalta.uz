<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFileRequest $request)
    {
        // Store the file in the public storage folder under a random, non-guessable name
        $path = $request->file('file')->store('uploads', 'public');

        $originalName = basename($request->file('file')->getClientOriginalName());

        $file = File::create(['path' => $path, 'name' => $originalName]);
        $file->kalta()->create([
            'url' => randomString(),
            'user_id' => auth()->id() ?? 1,
            'ip' => $request->ip(),
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully!');
    }
}
