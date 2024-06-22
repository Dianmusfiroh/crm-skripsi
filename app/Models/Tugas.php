<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;
    protected $table = 't_tugas';
    protected $fillable = [
        'id',
        'created_at',
        'updated_at',
        'judul',
        'deskripsi',
        'status',
        'target_awal',
        'target_akhir',
        'id_anggota'	,
        'status_progres',
        'projek_id',

    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota');
    }

    public function Projek(){
        return $this->belongsTo(Projek::class, 'projek_id');
    }
}
