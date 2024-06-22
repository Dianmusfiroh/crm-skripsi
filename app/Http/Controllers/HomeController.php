<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Projek;
use App\Models\Tugas;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $modul;
    /**
     * Display a listing of the resource.
     */
    public function __construct() {
        $this->modul = 'dashbord';
    }
    public function index()
    {
        $modul = $this->modul;
        $total_divisi = Divisi::count();
        $total_projek = Projek::count();
        $total_tugas = Tugas::count();
        $total_tugas_selesai = Tugas::where('status_progres','selesai')->count();
        $divisi = Divisi::all();
        return view('dashboard', compact('modul', 'total_divisi', 'total_projek', 'total_tugas', 'total_tugas_selesai','divisi'));
    }
}
