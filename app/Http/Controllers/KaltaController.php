<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKaltaRequest;
use App\Http\Requests\UpdateKaltaRequest;
use App\Models\Bio;
use App\Models\File;
use App\Models\Kalta;
use App\Models\Short;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KaltaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kaltas = Kalta::orderBy('created_at', 'desc')->get();
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
    public function store(StoreKaltaRequest $request) {}

    /**
     * Display the specified resource.
     */
    public function show(Kalta $kalta)
    {
        if ($kalta->kaltaable()->first() instanceof Short) {
            return redirect()->to($kalta->kaltaable()->first()->long_url);
        } else if (!empty($path = $kalta->kaltaable()->first()->path)) {
            $file = storage_path("app/public/$path");
            if (Storage::disk('public')->exists("$path")) {
                return response()->download($file, $kalta->kaltaable()->first()->name);
            }
        } else if ($kalta->kaltaable()->first() instanceof Bio) {
            $bio = $kalta->kaltaable()->first();
            return view("bio.show", compact('bio'));
        }
        dd($kalta->kaltaable()->first instanceof Bio);
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
