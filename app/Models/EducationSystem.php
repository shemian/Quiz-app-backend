<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EducationSystem extends Model
{
    use HasUuids, HasFactory;
    protected $fillable = [
        'name',
    ];

    public function EducationLevel(): HasMany
    {
        return $this->hasMany(EducationLevel::class);
    }

    public function Students(): HasMany
    {
        return $this->hasMany(Students::class);
    }
}
