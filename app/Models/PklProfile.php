<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PklProfile extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function program()
    {
        return $this->belongsTo(ProgramKursus::class, 'program_id');
    }

    public function tasks()
    {
        return $this->hasMany(PklTask::class, 'pkl_profile_id')->latest();
    }

    public function quizzes()
    {
        return $this->hasMany(PklQuiz::class, 'pkl_profile_id')->latest();
    }

    public function invoices()
    {
        return $this->hasMany(PklInvoice::class, 'pkl_profile_id')->latest();
    }

    public function portfolios()
    {
        return $this->hasMany(PklPortfolio::class, 'pkl_profile_id')->latest();
    }

    public function certificate()
    {
        return $this->hasOne(PklCertificate::class, 'pkl_profile_id');
    }

    public function histories()
    {
        return $this->hasMany(PklHistory::class, 'pkl_profile_id')->latest('logged_at');
    }

    public function studentProgress()
    {
        return $this->hasMany(PklStudentProgress::class, 'pkl_profile_id');
    }

    // Combined Progress calculation helper (Modules & Tasks)
    public function getProgressPercentageAttribute()
    {
        $totalModules = $this->studentProgress()->count();
        $completedModules = $this->studentProgress()->where('status', 'completed')->count();

        $totalTasks = $this->tasks()->count();
        $completedTasks = $this->tasks()->whereIn('status', ['completed', 'reviewed'])->count();

        $totalItems = $totalModules + $totalTasks;
        if ($totalItems === 0) {
            return 0;
        }

        $completedItems = $completedModules + $completedTasks;
        return round(($completedItems / $totalItems) * 100);
    }
}
