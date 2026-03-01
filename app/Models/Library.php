<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Library extends Model
{
    use HasFactory;

    protected $table = 'library';

    protected $fillable = [
        'user_id',
        'makanan_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function makanan(): BelongsTo
    {
        return $this->belongsTo(Makanan::class);
    }
}
