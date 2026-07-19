<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKaltaRequest;
use App\Http\Requests\UpdateKaltaRequest;
use App\Models\Bio;
use App\Models\File;
use App\Models\Kalta;
use App\Models\Short;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class KaltaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kaltas = Kalta::with('kaltaable')->orderBy('created_at', 'desc')->get();
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
        $kaltaable = $kalta->kaltaable;

        if ($kaltaable instanceof Short) {
            return redirect()->to($kaltaable->long_url);
        }

        if ($kaltaable instanceof File) {
            if ($kaltaable->path && Storage::disk('public')->exists($kaltaable->path)) {
                return response()->download(storage_path("app/public/{$kaltaable->path}"), $kaltaable->name);
            }

            Log::warning('Kalta file missing from storage.', ['kalta_id' => $kalta->id, 'path' => $kaltaable->path]);
            abort(404);
        }

        if ($kaltaable instanceof Bio) {
            return view('bio.show', ['bio' => $kaltaable]);
        }

        Log::warning('Kalta has no resolvable resource.', ['kalta_id' => $kalta->id]);
        abort(404);
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
