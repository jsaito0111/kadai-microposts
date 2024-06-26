<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageStatus extends Model
{
    public function message() {
        return $this->belongsTo(Message::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}