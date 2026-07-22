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
        // store() generates a random filename on disk, so the upload is never
        // saved under a name an attacker controls.
        $path = $request->file('file')->store('uploads', 'public');

        $originalName = Str::of($request->file('file')->getClientOriginalName())
            ->ascii()
            ->replaceMatches('/[^A-Za-z0-9._-]/', '_')
            ->limit(255, '')
            ->toString();

        $file = File::create(['path' => $path, 'name' => $originalName]);
        $file->kalta()->create([
            'url' => randomString(),
            'user_id' => 1,
            'ip' => $request->ip()
        ]);
        return redirect()->back()->with('success', 'File uploaded successfully!');
    }
}
