<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LabaRugiController extends Controller
{
    public function laba_rugi()
    {
        $active_page = 'Laba Rugi';
        return view('contents.laba_rugi', compact('active_page'));
    }
}
