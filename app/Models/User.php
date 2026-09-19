<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'rfid_uid', 'username', 'nomor_kartu', 'kota'])]

#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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

    public function pklProfile()
    {
        return $this->hasOne(PklProfile::class, 'user_id');
    }

    public function attendances()
    {
        return $this->hasMany(PklAttendance::class, 'user_id');
    }

    public function getRoleAttribute($value)
    {
        if (empty($value) || $value === 'user') {
            if ($this->email === 'elcoding.id@gmail.com' || $this->email === 'admin@elcoding.id' || $this->username === 'adminelcoding') {
                return 'admin';
            }
        }
        return $value;
    }

    public function isAdmin()
    {
        $role = strtolower(trim($this->role ?? ''));
        return in_array($role, ['admin', 'administrator', 'superadmin'])
            || $this->email === 'elcoding.id@gmail.com'
            || $this->email === 'admin@elcoding.id'
            || $this->username === 'adminelcoding';
    }

    public function isMentor()
    {
        return strtolower(trim($this->role ?? '')) === 'mentor';
    }

    public function isPklStudent()
    {
        return strtolower(trim($this->role ?? '')) === 'pkl_student' && !$this->isAdmin();
    }

    public function isAdminOrMentor()
    {
        $role = strtolower(trim($this->role ?? ''));
        return in_array($role, ['admin', 'mentor', 'administrator', 'superadmin'])
            || $this->email === 'elcoding.id@gmail.com'
            || $this->email === 'admin@elcoding.id'
            || $this->username === 'adminelcoding';
    }
}
