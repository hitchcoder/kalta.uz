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

        // Store the file in the public storage folder under a generated name
        $path = $uploadedFile->store('uploads', 'public');

        $file = File::create(['path' => $path, 'name' => $this->sanitizeFilename($uploadedFile)]);
        $file->kalta()->create([
            'url' => randomString(),
            'user_id' => 1,
            'ip' => $request->ip()
        ]);
        return redirect()->back()->with('success', 'File uploaded successfully!');
    }

    /**
     * Build a safe display filename from the uploaded file's original name.
     */
    private function sanitizeFilename($uploadedFile): string
    {
        $baseName = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $uploadedFile->getClientOriginalExtension();
        $safeBaseName = Str::slug($baseName) ?: 'file';

        return $extension ? "{$safeBaseName}.{$extension}" : $safeBaseName;
    }
}
