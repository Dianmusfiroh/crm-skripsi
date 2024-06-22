<?php

namespace App\Http\Controllers;

use App\Models\Projek;
use App\Models\Tugas;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    protected $modul ;
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->modul = 'laporan';
    }
    public function index()
    {
        $modul = $this->modul;
        $tugas_selesai = Tugas::where('status_progres', 'selesai')->get();

        $data = Projek::all();
    
        return view('laporan.index', compact('modul','tugas_selesai','data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $modul = $this->modul;
       $data = Projek::find($id);
       $tugas = Tugas::where('projek_id',$id)->get();
       return view('laporan.show', compact('modul','tugas','data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function generatePDF(string $id)
    {
        $modul = $this->modul;
        $projek = Projek::find($id);
        $tugas = Tugas::where('projek_id',$id)->get();
        $tugas_selesai = Tugas::where('status_progres', 'selesai')->where('projek_id',$id)->get();
        // dd($tugas_selesai->count());
        $tgl_awal = Carbon::parse(Tugas::where('projek_id',$id)->min('target_awal'));
        $tgl_akhir = Carbon::parse(Tugas::where('projek_id',$id)->max('target_akhir'));
        $daysDifference = $tgl_awal->diffInDays($tgl_akhir);
        $data = [
            'modul' => $modul,
            'tugas' => $tugas, 
            'projek' => $projek,
            'tugas_selesai' => $tugas_selesai,
            'daysDifference' => $daysDifference
        ];

        $pdf = FacadePdf::loadView('laporan.pdf', $data);

        // return $pdf->stream('laporan.pdf');
        return $pdf->download('laporan_'.$projek->name.'.pdf');
    }
}
