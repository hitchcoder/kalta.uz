<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Models\File;
use Illuminate\Support\Str;

class FileController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFileRequest $request)
    {
        $uploaded = $request->file('file');

        // Store under a random name; the original name is kept only for display/download.
        $path = $uploaded->store('uploads', 'public');
        $originalName = Str::limit(basename($uploaded->getClientOriginalName()), 255, '');

        $file = File::create(['path' => $path, 'name' => $originalName]);
        $file->kalta()->create([
            'url' => randomString(),
            'user_id' => auth()->id() ?? 1,
            'ip' => $request->ip(),
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully!');
    }
}
