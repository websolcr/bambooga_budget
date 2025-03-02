<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
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

    public $incrementing = false;

    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::orderedUuid()->toString();
        });
    }

    public const TYPES = [
        'SUPER_ADMIN' => 1,
        'ADMIN' => 2,
    ];

    public const PERMISSIONS_FOR_TYPE = [
        'SUPER_ADMIN' => [
            'SUPER_ADMIN',
            'ADMIN',
        ],
        'ADMIN' => [
            'ADMIN',
        ],
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array[]
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array[]
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'has_permission_as',
    ];

    public function setTypeAttribute(string $type): void
    {
        $this->attributes['type'] = self::TYPES[$type];
    }

    public function getTypeAttribute(): string
    {
        return array_search($this->attributes['type'], self::TYPES);
    }

    public function getHasPermissionAsAttribute(): array
    {
        return self::PERMISSIONS_FOR_TYPE[$this->type];
    }
}
