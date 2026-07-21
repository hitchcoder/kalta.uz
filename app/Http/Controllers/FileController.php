<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateKaltaRequest;
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
        $uploadedFile = $request->file('file');

        // Store the file in the public storage folder
        $path = $uploadedFile->store('uploads', 'public');

        // Sanitize the original filename before persisting/displaying it.
        $originalName = basename($uploadedFile->getClientOriginalName());
        $safeName = Str::limit(preg_replace('/[^\w\-. ]/', '_', $originalName), 255, '');

        $file = File::create(['path' => $path, 'name' => $safeName]);
        $file->kalta()->create([
            'url' => randomString(),
            'user_id' => 1,
            'ip' => $request->ip()
        ]);
        return redirect()->back()->with('success', 'File uploaded successfully!');
    }
}
