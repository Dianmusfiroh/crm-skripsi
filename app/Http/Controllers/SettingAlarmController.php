<?php

namespace App\Http\Controllers;

use App\Models\SettingAlarm;
use Illuminate\Http\Request;

class SettingAlarmController extends Controller
{
    protected $modul;
    public function __construct(){
        $this->modul = 'setting-alarm';
    }
    public function index()
    {
        $modul = $this->modul;
        $data = SettingAlarm::first();
        return view('alarm.index', compact('modul', 'data'));
    }

    public function update(Request $request, $id)
    {
        $data = SettingAlarm::find($id);
        $data->update($request->all());
        return redirect()->back();
        if ($data) {
            return redirect()
            ->route('alarm.index')
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
}
