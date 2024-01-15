<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use App\Models\File;
use App\Models\Link;
use App\Models\Short;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LinkController extends Controller
{

    public function make(Request $request)
    {
        $url = $request->url;

        // if url is valid then create a short url
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            // Generate a random string with 5 characters
            do {
                $randomString = Str::random(5);
            } while (Link::where('url', $randomString)->exists());

            $short = Short::create(['long_url' => $url]);
            $short->link()->create([
                'url' => $randomString,
                'user_id' => 1,
                'ip' => $request->ip()
            ]);
            return redirect()->back();
        } else if (true) {
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = Link::all();
        return view('welcome', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLinkRequest $request)
    {
        // Store the file in the public storage folder
        $path = $request->file('file')->store('uploads', 'public');
        do {
            $randomString = Str::random(5);
        } while (Link::where('url', $randomString)->exists());

        $file = File::create(['path' => $path, 'name' => $request->file('file')->getClientOriginalName()]);
        $file->link()->create([
            'url' => $randomString,
            'user_id' => 1,
            'ip' => $request->ip()
        ]);
        return redirect()->back()->with('success', 'File uploaded successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Link $link)
    {
        if(!empty($path = $link->linkable()->first()->path)){
            $file = storage_path("app/public/$path");
            if (Storage::disk('public')->exists("$path")) {
                return response()->download($file, $link->linkable()->first()->name);
            }
        }
        return redirect()->to($link->linkable()->first()->long_url);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Link $link)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLinkRequest $request, Link $link)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Link $link)
    {
        //
    }
}
