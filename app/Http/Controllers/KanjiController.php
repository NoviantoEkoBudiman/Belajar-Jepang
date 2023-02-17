<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kanjis;

class KanjiController extends Controller
{
    public function index(){
        return view('dashboard');
    }
    
    public function language()
    {
        return view('options');
    }
}
