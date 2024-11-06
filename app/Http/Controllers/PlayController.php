<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Category;
use App\Models\Card;
use DB;

class PlayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Language::orderBy('languages_name', 'asc')->get();
        return view('play.index',compact('languages'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        if($category->categories_type == 1){
            $card = Card::where('cards_categories_id', $id)->where('card_status','!=','1')->inRandomOrder()->first();
        }else{
            $card = Card::where('cards_categories_id', $id)->orderBy('cards_id', 'asc')->first();
        }
        return view('play.play',compact('card'));
    }

    function next($category_id, $card_id)
    {
        $card = Card::find($card_id);
        $card->card_status = 1;
        $card->save();
        $category = Category::find($category_id);
        if($category->categories_type == 1){
            $card = Card::where('cards_categories_id', $category_id)->where('card_status','!=','1')->inRandomOrder()->first();
        }else{
            $card = Card::where('cards_categories_id', $category_id)->where('card_status','!=','1')->orderBy('cards_id', 'asc')->first();
        }
        // dd($category->categories_languages_id);
        session(['language_id' => $category->categories_languages_id]);
        $languages = Language::orderBy('languages_name', 'asc')->get();
        return view('play.play',compact('languages','card'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $language = Language::find($id);
        $categories = Category::where('categories_languages_id',$id)->orderBy('categories_name', 'asc')->get();
        return view('play.categories',compact('language','categories'));
    }

    function finish($categories_id, $language_id)
    {
        DB::table('cards')
              ->where('cards_categories_id', $categories_id)
              ->update(['card_status' => 0]);
        $categories = Category::where('categories_languages_id',$language_id)->orderBy('categories_name', 'asc')->get();
        $language = Language::where("languages_id",$categories[0]->categories_languages_id)->first();
        return view('play.categories',compact('language','categories'));
    }
}
