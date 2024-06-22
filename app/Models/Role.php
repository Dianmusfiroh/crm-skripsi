<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 't_role'; 
    protected $fillable = [
        'id',
        'name',
    ];
    public $timestamps = false;
    public function user()
    {
        return $this->hasMany(User::class, 'id', 'role_id');

    }

}
