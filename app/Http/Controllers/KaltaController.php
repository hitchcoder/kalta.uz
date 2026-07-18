<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKaltaRequest;
use App\Http\Requests\UpdateKaltaRequest;
use App\Models\Bio;
use App\Models\File;
use App\Models\Kalta;
use App\Models\Short;
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
        $related = $kalta->kaltaable;

        abort_if(!$related, 404);

        if ($related instanceof Short) {
            return redirect()->to($related->long_url);
        }

        if ($related instanceof File) {
            abort_unless(Storage::disk('public')->exists($related->path), 404);
            return response()->download(storage_path("app/public/{$related->path}"), $related->name);
        }

        if ($related instanceof Bio) {
            return view('bio.show', ['bio' => $related]);
        }

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
