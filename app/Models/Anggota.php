<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $table = 't_anggota'; 
    protected $fillable = [
        'id',
        'create_time',
        'update_time',
        'name',
        'no_hp',
        'alamat',
        'id_tim',
        'user_id'	

    ];
    public $timestamps = false;
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_tim', 'id');

    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function divisi(){
        return $this->belongsTo(Divisi::class, 'id_tim', 'id');
    }
    public function tugas(){
        return $this->hasMany(Tugas::class, 'id_anggota', 'id');
    }
}
