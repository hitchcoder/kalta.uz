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
        // Store the file in the public storage folder
        $path = $request->file('file')->store('uploads', 'public');

        $originalName = $request->file('file')->getClientOriginalName();
        $safeName = Str::limit(preg_replace('/[^A-Za-z0-9._ -]/', '_', $originalName), 255, '');

        $file = File::create(['path' => $path, 'name' => $safeName]);
        $file->kalta()->create([
            'url' => randomString(),
            'user_id' => 1,
            'ip' => $request->ip()
        ]);
        return redirect()->back()->with('success', 'File uploaded successfully!');
    }
}
