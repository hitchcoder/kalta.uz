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
        $uploadedFile = $request->file('file');

        // Laravel generates a random, collision-safe name for the stored file itself.
        $path = $uploadedFile->store('uploads', 'public');

        // Sanitize the original filename before persisting it, since it's later
        // used as the Content-Disposition filename on download.
        $extension = $uploadedFile->getClientOriginalExtension();
        $baseName = Str::slug(pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME));
        $displayName = $baseName !== '' ? "{$baseName}.{$extension}" : $uploadedFile->hashName();

        $file = File::create(['path' => $path, 'name' => $displayName]);
        $file->kalta()->create([
            'url' => randomString(),
            'user_id' => 1,
            'ip' => $request->ip()
        ]);
        return redirect()->back()->with('success', 'File uploaded successfully!');
    }
}
