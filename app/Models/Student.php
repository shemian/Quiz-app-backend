<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Str;

class Student extends Model
{
    use HasUuids, HasFactory;

    protected $fillable = [
        'user_id',
        'guardian_id',
        'education_system_id',
        'education_level_id',
        'Date_of_birth',
        'school_name',
        'student_phone_number',
        'marks_obtained',
        'credit',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($student) {
            // Generate the centy_plus_id in the format "CTP-000001", "CTP-000002", etc.
            $lastStudent = static::orderBy('id', 'desc')->first();

            $sequence = $lastStudent ? intval(Str::after($lastStudent->centy_plus_id, 'CTP-')) + 1 : 1;
            $student->centy_plus_id = 'CTP-' . str_pad($sequence, 6, '0', STR_PAD_LEFT);
        });
    }

    public function guardians(): BelongsTo
    {
        return $this->belongsTo(Guardian::class);
    }

    public function EducationSystem(): BelongsTo
    {
        return $this->belongsTo(EducationSystem::class);
    }

    public function EducationLevel(): BelongsTo
    {
        return $this->belongsTo(EducationLevel::class);
    }

    public function StudentPlan(): HasOne
    {
        return $this->hasOne(StudentSubscriptionPlan::class);
    }

    public function results(): HasMany
    {
        return $this->hasMany(Result::class);
    }

    public function user()
    {
    return $this->belongsTo(User::class);
    }

}
