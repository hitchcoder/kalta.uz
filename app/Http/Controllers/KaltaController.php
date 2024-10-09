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

class KaltaController extends Controller
{

    public function make(Request $request)
    {
        $url = $request->url;

        // if url is valid then create a short url
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            $randomString = randomString();
            $short = Short::create(['long_url' => $url]);
            $short->kalta()->create([
                'url' => $randomString,
                'user_id' => 1,
                'ip' => $request->ip()
            ]);
            return redirect()->back();
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kaltas = Kalta::all();
        return view('welcome', compact('kaltas'));
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
    public function store(StoreKaltaRequest $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(Kalta $kalta)
    {
        if(!empty($path = $kalta->kaltaable()->first()->path)){
            $file = storage_path("app/public/$path");
            if (Storage::disk('public')->exists("$path")) {
                return response()->download($file, $kalta->kaltaable()->first()->name);
            }
        }
        return redirect()->to($kalta->kaltaable()->first()->long_url);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kalta $kalta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKaltaRequest $request, Kalta $kalta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kalta $kalta)
    {
        //
    }
}
