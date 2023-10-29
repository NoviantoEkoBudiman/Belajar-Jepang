<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;

class LanguageController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    
    public function language()
    {
        $languages = Language::orderBy('languages_name', 'asc')->get();
        return view('options', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request,[
            'languages_name'  =>  'required'
        ],
        [
            'languages_name.required' => 'Language can\'t be null'
        ]);

        if($validated){
            $language = new Language;
            $language->languages_name  = $request->languages_name;
    
            $hasil = $language->save();
            return redirect()
                    ->route('language_index')
                    ->with('success', 'Data bahasa '.$language->languages_name.' berhasil ditambahkan');
        }else{
            return redirect()
                    ->route('language_index')
                    ->withErrors('failed', 'Data bahasa '.$language->languages_name.' gagal ditambahkan');
        }
    }
}
