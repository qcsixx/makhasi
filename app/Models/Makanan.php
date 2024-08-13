<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Makanan extends Model
{
    use HasFactory;
    public function daerahs()
    {
        return $this->belongsTo(Daerah::class, 'daerah_id', 'id');
    }
    protected $table = 'makanan';

    protected $fillable = ['id','nama', 'deskripsi', 'resep', 'panduan', 'image', 'daerah_id'];
}