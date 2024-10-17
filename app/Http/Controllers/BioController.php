<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBioRequest;
use App\Models\Bio;
use Illuminate\Http\Request;
use \Auth;

class BioController extends Controller
{
    public function create(Request $request)
    {
        return view("bio.create");
    }

    public function store(StoreBioRequest $request)
    {
        // if (isset($request->avatar_icon)) {
        //     $imageName = time() . '_' . $request->avatar_icon->getClientOriginalName();
        //     $request->avatar_icon->move(public_path('images'), $imageName);
        //     $storeImg = 'images/' . $imageName;
        // }
        $bio = Bio::create($request->validated());
        $bio->kalta()->create([
            'url' => randomString(),
            'user_id' => Auth::id() ?? 1,
            'ip' => $request->ip(),
            'description' => $request->description ?? null,
            'name' => $request->title ?? null
        ]);
        $bio->save();
        return redirect()->route('bio.show', $bio);
    }

    public function index(){
        $bios = Bio::all();
        return view("bio.index", compact('bios'));
    }

    public function show(Bio $bio){
        return view("bio.show", compact('bio'));
    }
}
