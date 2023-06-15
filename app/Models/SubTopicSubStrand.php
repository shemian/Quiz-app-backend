<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubTopicSubStrand extends Model
{
    use HasUuids,HasFactory;

    protected $fillable = [
        'topic_strand_id',
        'name',
    ];

    public function topicStrand(): BelongsTo
    {
        return $this->belongsTo(TopicStrand::class);
    }

}
