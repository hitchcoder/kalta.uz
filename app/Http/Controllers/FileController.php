<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Models\File;
use App\Models\Kalta;
use App\Models\Short;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFileRequest $request)
    {
        // Store the file in the public storage folder under a generated name
        $path = $request->file('file')->store('uploads', 'public');

        // Sanitize the original filename before persisting/serving it back
        $originalName = basename($request->file('file')->getClientOriginalName());
        $originalName = Str::limit(preg_replace('/[\x00-\x1F\x7F]/', '', $originalName), 255, '');

        $file = File::create(['path' => $path, 'name' => $originalName]);
        $file->kalta()->create([
            'url' => randomString(),
            'user_id' => 1,
            'ip' => $request->ip()
        ]);
        return redirect()->back()->with('success', 'File uploaded successfully!');
    }
}
