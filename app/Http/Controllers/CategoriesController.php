<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Category;

class CategoriesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request,[
            'categories_languages_id'   =>  'required',
            'categories_name'           =>  'required'
        ],
        [
            'categories_languages_id.required'   =>  'Language id can\'t be null',
            'categories_name.required'           =>  'Category\'s name  can\'t be null'
        ]);

        if($validated){    
            $category = new Category;
            $category->categories_languages_id  = $request->categories_languages_id;
            $category->categories_name  = $request->categories_name;
    
            $hasil = $category->save();
            return redirect()
                    ->route('category.show', $request->categories_languages_id)
                    ->with('success', 'Kategori '.$category->categories_name.' berhasil ditambahkan');
        }else{
            return redirect()
                    ->route('category.show', $request->categories_languages_id)
                    ->withErrors('failed', 'Kategori '.$category->categories_name.' gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $language = Language::find($id);
        $categories = Category::where('categories_languages_id', $id)->orderBy('categories_name', 'asc')->get();
        return view('category.detail',compact('language','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
