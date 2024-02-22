<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'age',
        'type',
    ];
    const TYPE = [
        0 => 'costumer',
        1 => 'admin',
    ];

    public function admins()
    {
        return $this->hasMany(Admin::class, 'user_id', 'id');
    }
    public function customers()
    {
        return $this->hasMany(Customer::class, 'user_id', 'id');
    }
    public function interactions(): HasMany
    {
        return $this->hasMany(Interaction::class);
    }

    // public function roles(): BelongsToMany
    // {
    //     return $this->belongsToMany(Role::class, 'role_users');
    // }

    // public function permissions(): BelongsToMany
    // {
    //     return $this->belongsToMany(Permission::class, 'users_permissions');
    // }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        //     'password' => 'hashed',
    ];
}
