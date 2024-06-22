<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerangkatController extends Controller
{
    protected $modul;

    public function __construct()
    {
        $this->modul = 'perangkat';
    }

    public function index()
    {
        $modul = $this->modul;
        return view('perangkat.index',compact('modul'));
    }
}
