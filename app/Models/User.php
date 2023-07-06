<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasUuids, HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'role',
        'email',
        'phone_number',
        'centy_plus_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function guardian()
    {
        return $this->hasOne(Guardian::class);
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($user) {
            if ($user->role === 'parent') {
                $user->centy_plus_id = 'CNT' . self::generateParentSequence($user->phone_number) . '-' . $user->phone_number;
            } elseif ($user->role === 'student' || $user->role === 'teacher') {
                $user->centy_plus_id = '' . self::generateStudentTeacherSequence();
            }
        });
    }

    public static function generateParentSequence()
    {
        $parentSequence = static::where('role', 'parent')->count();
        return $parentSequence + 1;
    }

    protected static function generateStudentTeacherSequence()
    {
        // Retrieve the last student/teacher
        $lastUser = static::whereIn('role', ['student', 'teacher'])->latest('centy_plus_id')->first();

        if ($lastUser) {
            $sequence = intval(substr($lastUser->centy_plus_id, -7)) + 1; // Extract sequence and increment
        } else {
            $sequence = 1;
        }

        return str_pad($sequence, 7, '0', STR_PAD_LEFT);
    }
}
