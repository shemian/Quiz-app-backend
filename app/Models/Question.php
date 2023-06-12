<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasUuids, HasFactory;

    protected $fillable = [
        'subject_id',
        'subtopic',
        'education_system_id',
        'education_level_id',
        'question',
        'option1',
        'option2',
        'option3',
        'option4',
        'answer',
        'marks'
    ];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function results(): HasMany
    {
        return $this->hasMany(Result::class);
    }
}
