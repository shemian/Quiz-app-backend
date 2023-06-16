<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EducationLevel extends Model
{
    use HasUuids, HasFactory;
    protected $fillable = [
        'education_system_id',
        'name',
    ];

    public function EducationSystem(): BelongsTo
    {
        return $this->belongsTo(EducationSystem::class);
    }

    public function Students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function educationSystemLevelSubjects(): HasMany
    {
        return $this->hasMany(EducationSystemLevelSubject::class);
    }

    public function Subjects(): HasMany
    {
        return $this->hasMany(Subject::class);
    }
}
