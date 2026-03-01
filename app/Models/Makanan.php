<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Makanan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'makanan';

    protected $fillable = ['id', 'nama', 'deskripsi', 'resep', 'panduan', 'image', 'daerah_id', 'status'];

    /**
     * Get the daerah that owns the makanan.
     */
    public function daerah(): BelongsTo
    {
        return $this->belongsTo(Daerah::class, 'daerah_id', 'id');
    }

    /**
     * Get all library entries for this makanan.
     */
    public function libraries(): HasMany
    {
        return $this->hasMany(Library::class);
    }

    /**
     * Get all users who favorited this makanan.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'library');
    }

    /**
     * Get all ratings for this food.
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Get average rating for this food.
     */
    protected function averageRating(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->ratings()->avg('rating') ?? 0
        );
    }

    /**
     * Scope a query to only include published foods.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope a query to filter by region.
     */
    public function scopeByRegion($query, $regionId)
    {
        return $query->where('daerah_id', $regionId);
    }

    /**
     * Scope a query to get popular foods (most favorited).
     */
    public function scopePopular($query, $limit = 10)
    {
        return $query->withCount('libraries')
            ->orderBy('libraries_count', 'desc')
            ->limit($limit);
    }

    /**
     * Scope a query to get recent foods.
     */
    public function scopeRecent($query, $limit = 10)
    {
        return $query->orderBy('created_at', 'desc')->limit($limit);
    }

    /**
     * Scope a query to search by name.
     */
    public function scopeSearch($query, $search)
    {
        if (!empty($search)) {
            $search = strip_tags($search);
            $search = htmlspecialchars($search, ENT_QUOTES, 'UTF-8');
            return $query->where('nama', 'like', '%' . $search . '%');
        }
        return $query;
    }
}
