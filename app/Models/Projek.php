<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projek extends Model
{
    use HasFactory;
    protected $table = 't_projek';
    protected $fillable = [
        'id',
        'name',
        'tim_id',
        'updated_at',
        'created_at',
    ];

    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'projek_id', 'id');
    }

    public function tim(){
        return $this->belongsTo(Divisi::class, 'tim_id', 'id');
    }
}
