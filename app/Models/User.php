<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'contact', 'address', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token' //, 'api_token'
    ];

    public function role() {
        return $this->hasOne(Role::class, 'code', 'role_code');
    }

    public function scopeNonAdmin($query) {
        return $query->where('role_code', '!=', Role::CODE_ADMIN);
    }

}
