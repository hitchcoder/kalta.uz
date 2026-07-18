<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKaltaRequest;
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
    public function store(StoreKaltaRequest $request)
    {
        $uploaded = $request->file('file');

        // Store the file in the public storage folder under a randomly generated name
        $path = $uploaded->store('uploads', 'public');

        $originalName = pathinfo($uploaded->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $uploaded->getClientOriginalExtension();
        $safeName = Str::slug($originalName) ?: 'file';
        $displayName = Str::limit($extension ? "{$safeName}.{$extension}" : $safeName, 190, '');

        $file = File::create(['path' => $path, 'name' => $displayName]);
        $file->kalta()->create([
            'url' => randomString(),
            'user_id' => 1,
            'ip' => $request->ip()
        ]);
        return redirect()->back()->with('success', 'File uploaded successfully!');
    }
}
