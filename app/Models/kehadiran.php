<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kehadiran extends Model
{
    use HasFactory;

    protected $table = 'kehadiran';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = ['id_user','date','time','status'];

    // public function user()
    // {
    //     return $this->belongsTo(user1::class);
    // }
}
