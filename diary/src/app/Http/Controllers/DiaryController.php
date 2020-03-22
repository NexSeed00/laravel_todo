<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Diary;

class DiaryController extends Controller
{
    // 追加
    public function index()
    {
        $diaries = Diary::all();

        dd($diaries);
    }
}
