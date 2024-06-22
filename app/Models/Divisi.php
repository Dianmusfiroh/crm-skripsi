<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;
    protected $table = 't_tim'; 
    protected $fillable = [
        'id',
        'name',
    ];
    public $timestamps = false;
    public function anggota()
    {
        return $this->hasMany(Anggota::class, 'id', 'id_tim');

    }
    public function projek()
    {
        return $this->hasMany(Projek::class, 'tim_id', 'id');
    }

}
