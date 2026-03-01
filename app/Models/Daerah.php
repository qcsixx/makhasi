<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daerah extends Model
{
    use HasFactory;

    protected $table = 'daerahs';

    protected $fillable = ['id', 'nama'];

    /**
     * Get all makanan for this daerah.
     */
    public function makanan()
    {
        return $this->hasMany(Makanan::class);
    }
}
