<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasUuids, HasFactory;

    protected $fillable  =[
        'student_id',
        'question_id',
        'yes_ans',
        'no_ans',
        'result_json',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
