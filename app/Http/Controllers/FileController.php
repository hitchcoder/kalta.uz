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

        // Laravel generates a random storage filename, so this never touches
        // the user-supplied name; the disk write itself is safe from
        // path-traversal regardless of what the original filename contains.
        $path = $uploadedFile->store('uploads', 'public');

        $file = File::create([
            'path' => $path,
            'name' => $this->sanitizeFileName($uploadedFile->getClientOriginalName()),
        ]);

        $file->kalta()->create([
            'url' => randomString(),
            'user_id' => 1,
            'ip' => $request->ip(),
        ]);

        return redirect()->back()->with('success', 'File uploaded successfully!');
    }

    /**
     * Strip characters that could cause header/path injection when the
     * original name is later reused as a download filename.
     */
    private function sanitizeFileName(string $name): string
    {
        $name = basename($name);
        $name = preg_replace('/[^A-Za-z0-9._-]/', '_', $name);

        return Str::limit($name, 255, '');
    }
}
