<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;

class TimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $modul = 'tim';
    public function __construct(){
        $this->modul = 'tim';
    }
    public function index()
    {
        $modul = $this->modul;
        $data = Divisi::all();
        return view('tim.index', compact('modul', 'data'));
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
        //
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
        try {
            $data = Divisi::find($id);
            $data->projek()->delete();
            $data->anggota()->delete();
            $data->delete();
            return redirect()
                ->back()
                ->with([
                    'success' => 'Data Berhasil Dihapus'
                ]);
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with([
                    'error' => 'Terjadi Sesuatu Masalah, Mohon Coba Lagi'
                ]);
        }
    }
}
