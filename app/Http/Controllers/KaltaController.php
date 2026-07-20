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
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

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
        try {
            $kaltaable = $kalta->kaltaable;

            if ($kaltaable instanceof Short) {
                return redirect()->to($kaltaable->long_url);
            }

            if ($kaltaable instanceof File && !empty($path = $kaltaable->path)) {
                $file = storage_path("app/public/$path");
                if (Storage::disk('public')->exists($path)) {
                    return response()->download($file, $kaltaable->name);
                }
            }

            if ($kaltaable instanceof Bio) {
                $bio = $kaltaable;
                return view("bio.show", compact('bio'));
            }

            abort(404);
        } catch (HttpExceptionInterface $e) {
            throw $e;
        } catch (\Throwable $e) {
            Log::error('Failed to resolve kalta resource', [
                'url' => $kalta->url ?? null,
                'exception' => $e->getMessage(),
            ]);
            abort(404);
        }
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
