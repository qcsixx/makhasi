<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'usertype',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the user's profile photo URL attribute.
     */
    protected function profilePhotoUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->profile_photo_path) {
                    /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
                    $disk = Storage::disk($this->profilePhotoDisk());
                    return $disk->url($this->profile_photo_path);
                }
                return $this->defaultProfilePhotoUrl();
            },
        );
    }

    /**
     * Get the user's favorite foods (library).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function makanan(): BelongsToMany
    {
        return $this->belongsToMany(Makanan::class, 'library', 'user_id', 'makanan_id')
            ->withTimestamps();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'usertype' => 'string',
        ];
    }

    /**
     * Define a one-to-many relationship with the Library model.
     */
    public function library(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Library::class);
    }

    /**
     * Check if user is admin.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->usertype === '1';
    }

    /**
     * Check if user is regular user.
     *
     * @return bool
     */
    public function isUser(): bool
    {
        return $this->usertype === '0';
    }
}

