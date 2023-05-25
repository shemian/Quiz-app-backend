<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guardian extends Model
{
    use HasUuids, HasFactory;

    protected $fillable  =[
        'name',
        'email',
        'phone_number',
        'password'
    ];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
