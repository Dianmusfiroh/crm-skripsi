<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Broadcast;
use App\Models\Projek;
use App\Models\Tugas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $modul;
    public function __construct() {
        $this->modul = 'tugas';
    }    
    public function index()
    {
        if (Auth::user()->role->id != '4') {
            $modul = $this->modul;
            $data = Tugas::all();
            $projek = Projek::all();
            $karyawan = Anggota::select('t_anggota.*')->join('users', 't_anggota.user_id', '=', 'users.id')->where('users.role_id', '!=', 3)->get();
    
            
            $tugas_baru = Tugas::where('status_progres', 'baru')->get();
            $tugas_proses = Tugas::where('status_progres', 'proses')->get();
            $tugas_testing = Tugas::where('status_progres', 'testing')->get();
            $tugas_selesai = Tugas::where('status_progres', 'selesai')->get();
            // total persentase
            $total_baru = $data->count() ? ($tugas_baru->count()/$data->count())* 100 : 0;
            $total_proses = $data->count() ? ($tugas_proses->count()/$data->count())* 100 : 0;
            $total_testing = $data->count() ? ($tugas_testing->count()/$data->count())* 100 : 0;
            $total_selesai = $data->count() ? ($tugas_selesai->count()/$data->count())* 100 : 0;
            $total = 100 - ($total_baru + $total_proses + $total_testing);
    
            // jumlah Hari
            $today = date('Y-m-d');
            $tgl_awal = Carbon::parse(Tugas::min('target_awal'));
            $tgl_akhir = Carbon::parse(Tugas::max('target_akhir'));
            $daysDifference = $tgl_awal->diffInDays($tgl_akhir);
    
        }else{
            $modul = $this->modul;
            $data = Tugas::where('id_anggota', Auth::user()->anggota->id)->get();
            $projek = Projek::all();
            $karyawan = Anggota::select('t_anggota.*')->join('users', 't_anggota.user_id', '=', 'users.id')->where('users.role_id', '!=', 3)->get();
    
            
            $tugas_baru = Tugas::where('status_progres', 'baru')->where('id_anggota', Auth::user()->anggota->id)->get();
            $tugas_proses = Tugas::where('status_progres', 'proses')->where('id_anggota', Auth::user()->anggota->id)->get();
            $tugas_testing = Tugas::where('status_progres', 'testing')->where('id_anggota', Auth::user()->anggota->id)->get();
            $tugas_selesai = Tugas::where('status_progres', 'selesai')->where('id_anggota', Auth::user()->anggota->id)->get();
            // total persentase
            $total_baru = $data->count() ? ($tugas_baru->count()/$data->count())* 100 : 0;
            $total_proses = $data->count() ? ($tugas_proses->count()/$data->count())* 100 : 0;
            $total_testing = $data->count() ? ($tugas_testing->count()/$data->count())* 100 : 0;
            $total_selesai = $data->count() ? ($tugas_selesai->count()/$data->count())* 100 : 0;
            $total = 100 - ($total_baru + $total_proses + $total_testing);
    
            // jumlah Hari
            $today = date('Y-m-d');
            $tgl_awal = Carbon::parse(Tugas::where('id_anggota', Auth::user()->anggota->id)->min('target_awal'));
            $tgl_akhir = Carbon::parse(Tugas::where('id_anggota', Auth::user()->anggota->id)->max('target_akhir'));
            $daysDifference = $tgl_awal->diffInDays($tgl_akhir);
    
        }

        return view('tugas.index', compact('total','daysDifference','data','modul','projek','karyawan','tugas_baru','tugas_proses','tugas_testing','tugas_selesai'));
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
            'judul' => 'required',
            'deskripsi' => 'required',
            'status' => 'required',
            'projek_id' => 'required',
            'target_awal' => 'required',
            'target_akhir' => 'required',
            'karyawan_id' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }
        $data = Tugas::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
            'projek_id' => $request->projek_id,
            'target_awal' => $request->target_awal,
            'target_akhir' => $request->target_akhir,
            'id_anggota' => $request->karyawan_id,
            'status_progres' => 'baru',
        ]);
        $pesan = "*Laporan*\n\n". 
                "Kamu mendapatkan Tugas :\n". 
                "Task: *$data->judul*\n". 
   
                "Terima kasih.\n";

                $message = [
                        'sender' => '999',
                        'nomor' => $data->anggota->no_hp,
                        'message'   => $pesan
                    ];
                $curl = curl_init();
                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'http://localhost:3000/send-message',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS =>http_build_query($message),
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded'
                  ),
                ));
                
                $response = curl_exec($curl);
                
                curl_close($curl);
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
    public function toProses(Request $request){
        $data = Tugas::find($request->id);
            $data->status_progres = 'proses';
            $data->save();
            $pesan = "*Laporan*\n\n". 
                    "Task: *$data->judul*\n". 
                    "Tugas Sementara Dikerjakan :\n". 
       
                    "Terima kasih.\n";
    
                    $message = [
                            'sender' => '999',
                            'nomor' => $data->anggota->no_hp,
                            'message'   => $pesan
                        ];
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'http://localhost:3000/send-message',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS =>http_build_query($message),
                      CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/x-www-form-urlencoded'
                      ),
                    ));
                    
                    $response = curl_exec($curl);
                    $jsonData = json_decode($response, true); 
                    if ($jsonData['status'] = 'false') {
                        Broadcast::create([
                            'kd_list_broadcast' => Uuid::uuid4()->toString(),
                            'pesan' => $pesan,
                            'status' => '0',
                            'nomor' => $data->anggota->no_hp
                        ]);
                    }
                    curl_close($curl);

            return response()->json([
                'status' => 'success',
                'message' => 'Successfully',
                'response' => $response,
            ]);

        
    }
    public function toVerif(Request $request){
        $data = Tugas::find($request->id);
        $data->status_progres = 'testing';
        $data->save();
        $kepalatim = DB::select("SELECT * FROM `users` u , t_anggota a WHERE u.id = a.user_id AND u.role_id = '2' AND a.id_tim = '".$data->anggota->id_tim."'");
        $pesan = "*Laporan*\n\n". 
                "Task: *$data->judul*\n". 
                "Tugas Sementara Diperiksa :\n". 
   
                "Terima kasih.\n";

                $message = [
                        'sender' => '999',
                        'nomor' =>$data->anggota->no_hp,
                        'message'   => $pesan
                    ];
                $curl = curl_init();
                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'http://localhost:3000/send-message',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS =>http_build_query($message),
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded'
                  ),
                ));
                
                $response = curl_exec($curl);
                $jsonData1 = json_decode($response, true); 

                if ($jsonData1['status'] = 'false') {
                    Broadcast::create([
                        'kd_list_broadcast' => Uuid::uuid4()->toString(),
                        'pesan' => $pesan,
                        'status' => '0',
                        'nomor' => $data->anggota->no_hp
                    ]);
                }
                curl_close($curl);
                // pimpinan tim
                $nama_anggota = $data->anggota->name;
                $pesan = "*Laporan*\n\n". 
                "Tugas dengan Task: *$data->judul* sudah dikerjakan oleh *$nama_anggota*\n". 
                "Tolong di Verifikasi :\n". 
   
                "Terima kasih.\n";

                $message = [
                        'sender' => '999',
                        'nomor' => $kepalatim[0]->no_hp,
                        'message'   => $pesan
                    ];
                $curl = curl_init();
                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'http://localhost:3000/send-message',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS =>http_build_query($message),
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded'
                  ),
                ));
                
                $response2 = curl_exec($curl);
                $jsonData = json_decode($response2, true); 
                if ($jsonData['status'] = 'false') {
                    Broadcast::create([
                        'kd_list_broadcast' => Uuid::uuid4()->toString(),
                        'pesan' => $pesan,
                        'status' => '0',
                        'nomor' => $kepalatim[0]->no_hp
                    ]);
                }
                curl_close($curl);
            return response()->json([
            'status' => 'success',
            'message' => 'Successfully',
            'response' => $response
        ]);
    }
    public function toSelesai(Request $request){
        $data = Tugas::find($request->id);
        $data->status_progres = 'selesai';
        $data->save();
        $format_enam_dua = substr_replace($data->anggota->no_hp,'62',0,1);
        $pesan = "*Laporan*\n\n". 
                "Task: *$data->judul*\n". 
                "Tugas Selesai Dikerjakan :\n". 
   
                "Terima kasih.\n";

                $message = [
                        'sender' => '999',
                        'nomor' => $format_enam_dua,
                        'message'   => $pesan
                    ];
                $curl = curl_init();
                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'http://localhost:3000/send-message',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS =>http_build_query($message),
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded'
                  ),
                ));
                
                $response = curl_exec($curl);
                $jsonData = json_decode($response, true); 
                if ($jsonData['status'] = 'false') {
                    Broadcast::create([
                        'kd_list_broadcast' => Uuid::uuid4()->toString(),
                        'pesan' => $pesan,
                        'status' => '0',
                        'nomor' => $data->anggota->no_hp
                    ]);
                }
                curl_close($curl);
                curl_close($curl);
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully',
            'response' => $response
        ]);
    }
    public function count_proses(){
        $data_proses = Tugas::where('status_progres', 'proses')->get();
        return $data_proses->count();
    }
}
