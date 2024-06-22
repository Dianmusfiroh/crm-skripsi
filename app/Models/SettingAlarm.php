<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingAlarm extends Model
{
    use HasFactory;
    protected $table = 't_set_alarm';

    protected $fillable = [
        'id',
        'waktu',
    ];

    public $timestamps = false;

}
