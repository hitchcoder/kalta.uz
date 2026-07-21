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

        // Store the file under a generated name; never trust the client's path/name for the on-disk path.
        $path = $uploadedFile->store('uploads', 'public');

        // Sanitize the client-supplied name before persisting it, since it is later
        // reflected back in a Content-Disposition header on download.
        $originalName = basename(str_replace(["\r", "\n"], '', $uploadedFile->getClientOriginalName()));

        $file = File::create(['path' => $path, 'name' => $originalName]);
        $file->kalta()->create([
            'url' => randomString(),
            'user_id' => 1,
            'ip' => $request->ip()
        ]);
        return redirect()->back()->with('success', 'File uploaded successfully!');
    }
}
