<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Enums\SmsPassTypeEnum;
use Enums\DeliveryStatusEnum;

class Sms extends Model
{
    use HasUuids,HasFactory;

    protected $fillable = [
        "external_ref",
        "recipient",
        "text",
        "short_code",
        "pass_type",
    ];

    protected $casts = [
        'pass_type' => SmsPassTypeEnum::class,
        'delivery_status' => DeliveryStatusEnum::class,
    ];
}
