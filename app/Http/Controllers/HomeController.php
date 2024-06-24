<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Projek;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $chrt = DB::select("SELECT 
       
        COALESCE(SUM(t_jml.jml), 0) AS jml
    FROM (
        SELECT YEAR(target_awal) AS tahun, 
               MONTH(target_awal) AS bulan, 
               WEEK(target_awal, 1) AS minggu
        FROM t_tugas
        WHERE status_progres = 'selesai'
        GROUP BY tahun, bulan, minggu
    ) AS calendar
    LEFT JOIN (
        SELECT YEAR(target_awal) AS tahun, 
               MONTH(target_awal) AS bulan, 
               WEEK(target_awal, 1) AS minggu, 
               COUNT(*) AS jml
        FROM t_tugas
        WHERE status_progres = 'selesai'
        GROUP BY tahun, bulan, minggu
    ) AS t_jml ON calendar.tahun = t_jml.tahun 
               AND calendar.bulan = t_jml.bulan 
               AND calendar.minggu = t_jml.minggu
    GROUP BY calendar.tahun, calendar.bulan, calendar.minggu
    ORDER BY calendar.tahun, calendar.bulan, calendar.minggu;");
    $jml_values = [];

    foreach ($chrt as $item){
        $jml_values[]  = $item->jml;
    }
    // dd($chrt);
    $json_data = json_encode($jml_values);

return view('dashboard', compact('json_data','modul','chrt','jml_values', 'total_divisi', 'total_projek', 'total_tugas', 'total_tugas_selesai','divisi'));
    }
}
