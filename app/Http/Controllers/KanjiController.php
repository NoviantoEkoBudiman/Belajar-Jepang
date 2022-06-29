<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kanjis;

class KanjiController extends Controller
{
    public function index(){
        $kanji = Kanjis::where("kanji_id",1)->inRandomOrder()->first();
        return view('welcome',compact('kanji'));
    }
    
    public function next(Request $req){
        // dd($id);
        $kanji = Kanjis::where("kanji_id","!=",$req->kanji_id)->where('kanji_group',$req->kanji_group)->inRandomOrder()->first();
        return view('welcome',compact('kanji'));
    }
}
