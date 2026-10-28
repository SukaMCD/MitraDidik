<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'sender_id',
        'message_type',
        'message',
        'attachment_url',
        'status',
        'deliver_at',
        'read_at',
    ];

    protected $casts = [
        'deliver_at' => 'datetime',
        'read_at' => 'datetime',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(ChatRoom::class, 'room_id');
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function isHeld(): bool
    {
        return $this->status === 'held';
    }
}

