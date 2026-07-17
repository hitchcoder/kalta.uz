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
        $uploadedFile = $request->file('file');

        // Store the file in the public storage folder
        $path = $uploadedFile->store('uploads', 'public');

        $sanitizedName = Str::limit(
            preg_replace('/[^\w\-.]/', '_', $uploadedFile->getClientOriginalName()),
            255,
            ''
        );

        $file = File::create(['path' => $path, 'name' => $sanitizedName]);
        $file->kalta()->create([
            'url' => randomString(),
            'user_id' => 1,
            'ip' => $request->ip()
        ]);
        return redirect()->back()->with('success', 'File uploaded successfully!');
    }
}
