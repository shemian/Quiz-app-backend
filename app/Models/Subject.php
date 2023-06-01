<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class Subject extends Model
{
    use HasUuids, HasFactory;

    protected $fillable  =[
        'name',
    ];


    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }


}
