<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Diary;

class DiaryController extends Controller
{
    public function index()
    {
        $diaries = Diary::all();

        return view('diaries.index', compact('diaries'));
    }

    public function create()
    {
        return view('diaries.create');
    }
}
