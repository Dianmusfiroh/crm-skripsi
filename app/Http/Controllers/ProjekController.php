<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Projek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $modul;
    public function __construct(){
        $this->modul = 'projek';
    }
    public function index()
    {
        $modul = $this->modul;
        $data = Projek::all();
        $divisi = Divisi::all();
        return view('projek.index', compact('modul', 'data','divisi'));
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'divisi' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }
        $data = Projek::create([
            'name' => $request->name,
            'tim_id' => $request->divisi,
        ]);
        if ($data) {
            return redirect()
            ->back()
            ->withInput()
            ->with([
                'success' => 'Data Berhasil Ditambahkan'
            ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Terjadi Sesuatu Masalah, Mohon Coba Lagi'
                ]);
        }
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
        $modul = $this->modul;
        $data = Projek::find($id);
        $divisi = Divisi::all();
        return view('projek.edit', compact('modul', 'data','divisi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Projek::find($id);
        $data->name = $request->name;
        $data->tim_id = $request->divisi_id;
        $data->save();
     
        if ($data) {
            return redirect()
            ->route('projek.index')
            ->withInput()
            ->with([
                'success' => 'Data Berhasil Ditambahkan'
            ]);
        } else {
            return redirect()
                ->route('projek.index')
                ->withInput()
                ->with([
                    'error' => 'Terjadi Sesuatu Masalah, Mohon Coba Lagi'
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Projek::find($id);
            $data->tugas()->delete();
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
