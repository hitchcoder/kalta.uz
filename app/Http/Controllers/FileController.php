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
        $originalName = $uploaded->getClientOriginalName();
        $safeName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $uploaded->getClientOriginalExtension();

        // Store the file in the public storage folder under a sanitized name
        $path = $uploaded->storeAs('uploads', Str::random(20) . '_' . $safeName, 'public');

        $file = File::create(['path' => $path, 'name' => $originalName]);
        $file->kalta()->create([
            'url' => randomString(),
            'user_id' => 1,
            'ip' => $request->ip()
        ]);
        return redirect()->back()->with('success', 'File uploaded successfully!');
    }
}
