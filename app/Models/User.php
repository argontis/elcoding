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

    public function isBengkel()
    {
        return strtolower(trim($this->role ?? '')) === 'bengkel';
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

    public function isBengkelOrAdmin()
    {
        return $this->isBengkel() || $this->isAdminOrMentor();
    }

    public function isBimbel()
    {
        $role = strtolower(trim($this->role ?? ''));
        $username = strtolower(trim($this->username ?? ''));
        return in_array($role, ['bimbel', 'edupulse'])
            || in_array($username, ['bimbel', 'edupulse', 'sarah'])
            || $this->email === 'sarah@edupulse.id'
            || $this->email === 'bimbel@edupulse.id';
    }

    public function isBimbelOrAdmin()
    {
        return $this->isBimbel() || $this->isAdminOrMentor();
    }

    public function isResto()
    {
        $role = strtolower(trim($this->role ?? ''));
        $username = strtolower(trim($this->username ?? ''));
        return in_array($role, ['resto', 'restohub', 'culinary'])
            || in_array($username, ['resto', 'restohub', 'budi'])
            || $this->email === 'budi@restohub.id'
            || $this->email === 'resto@restohub.id';
    }

    public function isRestoOrAdmin()
    {
        return $this->isResto() || $this->isAdminOrMentor();
    }

    public function isTechfix()
    {
        $role = strtolower(trim($this->role ?? ''));
        $username = strtolower(trim($this->username ?? ''));
        return in_array($role, ['techfix', 'techfixpro', 'servicecenter', 'techfix_pro'])
            || in_array($username, ['techfix', 'techfixpro', 'techfix_pro'])
            || $this->email === 'admin@techfixpro.id'
            || $this->email === 'techfix@techfixpro.id';
    }

    public function isTechfixOrAdmin()
    {
        return $this->isTechfix() || $this->isAdminOrMentor();
    }

    public function isKlinik()
    {
        $role = strtolower(trim($this->role ?? ''));
        $username = strtolower(trim($this->username ?? ''));
        return in_array($role, ['klinik', 'clinic'])
            || in_array($username, ['testklinik', 'klinik', 'clinic'])
            || $this->email === 'klinik@elcoding.id';
    }

    public function isKlinikOrAdmin()
    {
        return $this->isKlinik() || $this->isAdminOrMentor();
    }

    public function isBarbershop()
    {
        $role = strtolower(trim($this->role ?? ''));
        $username = strtolower(trim($this->username ?? ''));
        return in_array($role, ['barbershop', 'atelier', 'barber'])
            || in_array($username, ['barbershop', 'atelier', 'mario'])
            || $this->email === 'admin@lstyle.id'
            || $this->email === 'mario@lstyle.id';
    }

    public function isBarbershopOrAdmin()
    {
        return $this->isBarbershop() || $this->isAdminOrMentor();
    }

    public function isCleanUser()
    {
        $role = strtolower(trim($this->role ?? ''));
        $username = strtolower(trim($this->username ?? ''));
        return in_array($role, ['clean', 'laundry', 'lclean'])
            || in_array($username, ['clean', 'lclean', 'elena'])
            || $this->email === 'clean@lclean.id'
            || $this->email === 'elena@lclean.id';
    }

    public function isCleanOrAdmin()
    {
        return $this->isCleanUser() || $this->isAdminOrMentor();
    }

    public function isCrmLead()
    {
        $role = strtolower(trim($this->role ?? ''));
        $username = strtolower(trim($this->username ?? ''));
        return in_array($role, ['crmlead', 'crm', 'nusantaracrm', 'nusantaracri', 'crm_lead'])
            || in_array($username, ['crmlead', 'crm'])
            || $this->email === 'crmlead@elcoding.id';
    }

    public function isCrmLeadOrAdmin()
    {
        return $this->isCrmLead() || $this->isAdminOrMentor();
    }
}
