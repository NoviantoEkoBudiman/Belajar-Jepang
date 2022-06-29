<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kanjis extends Model
{
    use HasFactory;

    protected $primaryKey = "kanji_id";
    protected $table = "kanji";
}
