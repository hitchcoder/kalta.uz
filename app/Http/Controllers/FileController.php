<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Models\File;

class FileController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFileRequest $request)
    {
        // Store the file in the public storage folder under a generated name;
        // the original (user-controlled) filename is kept only as display metadata.
        $path = $request->file('file')->store('uploads', 'public');

        $file = File::create([
            'path' => $path,
            'name' => basename($request->file('file')->getClientOriginalName()),
        ]);
        $file->kalta()->create([
            'url' => randomString(),
            'user_id' => 1,
            'ip' => $request->ip(),
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully!');
    }
}
