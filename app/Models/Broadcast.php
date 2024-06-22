<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Broadcast extends Model
{
    use HasFactory;
    protected $table = "t_broadcast";

    protected $fillable = [
        'kd_list_broadcast',	
        'pesan',
        'create_time',	
        'update_time',	
        'status',	
        'nomor'
    ];
    protected $keyType = 'string';
    public $timestamps = false;
    protected $primaryKey = 'kd_list_broadcast';
}
