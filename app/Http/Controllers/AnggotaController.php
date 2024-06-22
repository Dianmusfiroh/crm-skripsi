<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Divisi;
use App\Models\Role;
use App\Models\User;
use Illuminate\Hashing\HashManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $modul;
    public function __construct()
    {
        $this->modul = 'anggota';
    }


    public function index()
    {
        $modul = $this->modul;
        $data = Anggota::all();
        $divisi = Divisi::all();
        $role = Role::all();
        return view('anggota.index', compact('data','role', 'divisi','modul'));
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
                'alamat' => 'required',
                'divisi' => 'required',
                'email' => 'required',
                'no_hp' => 'required',
                'password' => 'required',
                'role' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $request->role,
            ]);
            $data = Anggota::create([
                'name' => $request->name,
                'alamat' => $request->alamat,
                'id_tim' => $request->divisi,
                'no_hp' => $request->no_hp,
                'user_id' => $user->id
            ]);

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $modul = $this->modul;
        $data = Anggota::find($id);
        $divisi = Divisi::all();
        $role = Role::all();
        return view('anggota.edit', compact('data','modul','divisi','role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $data = Anggota::find($id);
        $data->update([
            'name' => $request->name,
            'alamat' => $request->alamat,
            'id_tim' => $request->divisi_id,
            'no_hp' => $request->no_hp,
        ]);
        $user = User::find($data->user_id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
