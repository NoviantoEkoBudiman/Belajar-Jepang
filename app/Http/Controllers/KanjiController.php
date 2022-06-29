<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kanjis;

class KanjiController extends Controller
{
    public function index(){
        $kanji = Kanjis::inRandomOrder()->first();
        return view('welcome',compact('kanji'));
    }
    
    public function next(Request $id){
        $kanji = Kanjis::where("kanji_id","!=",$id->kanji_id)->inRandomOrder()->first();
        return view('welcome',compact('kanji'));
    }
}
