<?php

namespace App\Http\Controllers;

use App\Enums\ProgrammingLanguageEnum;
use Illuminate\Http\Request;
use App\Models\Code;

class CodeController extends Controller
{
    public function create()
    {
        return view('codes.create'); // Form to submit code
    }

    public function store(Request $request)
    {
        $code = new Code();
        $code->content = $request->input('content');
        $code->visibility = $request->input('visibility', 'public');
        $code->prog_lang = ProgrammingLanguageEnum::TXT;
        $code->expiration = $request->input('expiration') ? now()->addMinutes($request->input('expiration')) : null;
        $code->save();
        return redirect()->route('code.show', $code->id);
    }

    public function show($id)
    {
        $code = Code::findOrFail($id);
        return view('show', ['code' => $code]);
    }
}
