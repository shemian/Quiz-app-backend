<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasUuids, HasFactory;

    protected $fillable = [
        'user_id',
        'guardian_id',
        'account_number',
        'Date_of_birth',
        'school_name',
        'county',
        'username',
    ];

    public function guardians(): BelongsTo
    {
        return $this->belongsTo(Guardian::class);
    }

    public function StudentPlan(): HasOne
    {
        return $this->hasOne(StudentSubscriptionPlan::class);
    }

    public function results(): HasMany
    {
        return $this->hasMany(Result::class);
    }

}
