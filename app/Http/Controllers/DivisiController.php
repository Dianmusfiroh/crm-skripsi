<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;

class DivisiController extends Controller
{
    protected $modul;
    /**
     * Display a listing of the resource.
     */
    public function __construct() {
        $this->modul = 'divisi';
    }
    public function index()
    {
        $modul = $this->modul;
        $data = Divisi::all();
        return view('divisi.index', compact('modul', 'data'));
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
        try {
            $validator = Validator::make($request->all(), [
                'name'       => 'required',
            ]);
            if ($validator->fails()) {
                return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            }
            $data = Divisi::create($request->all());

            // Kirim respon ke klien dengan SweetAlert

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
         
        } catch (\Throwable $th) {
            return redirect()
            ->back()
            ->withInput()
            ->with([
                'error' => 'Terjadi Sesuatu Masalah, Mohon Hubungi Admin'
            ]);      
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Divisi::find($id);
        $modul = $this->modul;
        return view('divisi.edit', compact('modul', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Divisi::find($id);
        $data->update($request->all());
        if ($data) {
            return redirect()
            ->route('divisi.index')
            ->withInput()
            ->with([
                'success' => 'Data Berhasil Ditambahkan'
            ]);
        } else {
            return redirect()
                ->route('divisi.index')
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
        $data = Divisi::find($id);
        $data->delete();
        return redirect()
            ->back()
            ->with([
                'success' => 'Data Berhasil Dihapus'
            ]);
    }
}
