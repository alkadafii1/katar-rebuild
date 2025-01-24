<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'roles'];

    /**
     * Get all users.
     */
    public static function getAllUsers()
    {
        return self::all();
    }

    /**
     * Get available roles.
     */
    public static function getAvailableRoles()
    {
        return ['admin', 'user', 'kasir'];
    }

    /**
     * Get validation rules.
     */
    public static function getValidationRules($id = null)
    {
        return [
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email,' . $id,
            'password' => $id ? 'nullable' : 'required',
            'roles'    => 'required|in:admin,user,kasir',
        ];
    }

    /**
     * Store a new user.
     */
    public static function storeUser($data)
    {
        $data['password'] = Hash::make($data['password']);
        self::create($data);
    }

    /**
     * Update an existing user.
     */
    public static function updateUser($id, $data)
    {
        $user = self::findOrFail($id);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data['password'] = $user->password;
        }

        $user->update($data);
    }

    /**
     * Delete a user.
     */
    public static function deleteUser($id)
    {
        $user = self::findOrFail($id);
        $user->delete();
    }
}
