<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable {
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles() {
        return $this->belongsToMany(Role::class, 'user_role');
    }
    public function tasks() {
        return $this->HasMany(Task::class);
    }
    // simple method for check if user is admin or not
    public function hasRole($arg) {
        $user = Clone $this;
        $role = Role::where('title', $arg)->first();
        if (!$role) {
            return false;
        }
        if ($user->roles()->where('role_id', $role->id)->first()) {
            return true;
        } else {
            return false;
        }

    }
}
