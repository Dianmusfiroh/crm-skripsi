<?php

namespace App\Http\Controllers;

use App\Models\Broadcast;
use Illuminate\Http\Request;

class BroadcastController extends Controller
{
    protected $modul;

    public function __construct(){
        $this->modul = 'broadcast';
    }
    public function index(){
        $modul = $this->modul;
        $data = Broadcast::orderBy('create_time','desc')->get();
        return view('broadcast.index', compact('modul', 'data'));
    }
    public function send(Request $request){
        $data = Broadcast::find($request->id);
        $data->status = '0';
        $data->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully',
        ]);
    }
}
