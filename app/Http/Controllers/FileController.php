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
        $uploadedFile = $request->file('file');
        $originalName = basename($uploadedFile->getClientOriginalName());

        // Store the file in the public storage folder
        $path = $uploadedFile->store('uploads', 'public');

        $file = File::create(['path' => $path, 'name' => $originalName]);
        $file->kalta()->create([
            'url' => randomString(),
            'user_id' => 1,
            'ip' => $request->ip(),
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully!');
    }
}
