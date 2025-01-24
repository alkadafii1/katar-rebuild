<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    // Check if user has a specific role
    public function hasRole($role)
    {
        return $this->roles->pluck('name')->contains($role);
    }

    // Assign a role to the user
    public function assignRole($role)
    {
        $role = Role::where('name', $role)->firstOrFail();
        $this->roles()->syncWithoutDetaching([$role->id]);
    }
}
