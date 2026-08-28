<?php

namespace CollegeAdmin\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The guard name for Spatie permissions.
     *
     * @var string
     */
    protected $guard_name = 'web';

    /**
     * Boot the model and synchronize name field.
     */
    protected static function booted(): void
    {
        static::saving(function ($user) {
            if (empty($user->name) && (!empty($user->first_name) || !empty($user->last_name))) {
                $user->name = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? ''));
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

   public function role() {
    
     return $this->belongsTo( Role::class, 'role_id' );

     }



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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
        ];
    }
}
