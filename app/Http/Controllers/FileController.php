<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKaltaRequest;
use App\Http\Requests\UpdateKaltaRequest;
use App\Models\File;
use App\Models\Kalta;
use App\Models\Short;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKaltaRequest $request)
    {
        // Store the file in the public storage folder
        $uploadedFile = $request->file('file');
        $path = $uploadedFile->store('uploads', 'public');

        // Strip control characters from the client-supplied name before persisting/serving it
        $originalName = Str::limit(
            preg_replace('/[\x00-\x1F\x7F]/', '', $uploadedFile->getClientOriginalName()),
            255,
            ''
        );

        $file = File::create(['path' => $path, 'name' => $originalName]);
        $file->kalta()->create([
            'url' => randomString(),
            'user_id' => Auth::id() ?? 1,
            'ip' => $request->ip()
        ]);
        return redirect()->back()->with('success', 'File uploaded successfully!');
    }
}
