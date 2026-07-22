<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Models\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFileRequest $request)
    {
        $uploaded = $request->file('file');

        // store() generates a random filename on disk; the original name is
        // only kept for display/download and must not be used as a path.
        $path = $uploaded->store('uploads', 'public');
        $originalName = Str::limit(basename($uploaded->getClientOriginalName()), 255, '');

        $file = File::create(['path' => $path, 'name' => $originalName]);
        $file->kalta()->create([
            'url' => randomString(),
            'user_id' => 1,
            'ip' => $request->ip()
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully!');
    }
}
