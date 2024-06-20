<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function sender() {
        return $this->belongsToMany(User::class, 'sender_id')->withTimestamps();
    }

    public function receiver() {
        return $this->belongsToMany(User::class, 'receiver_id')->withTimestamps();
    }

    public function statuses() {
        return $this->hasMany(MessageStatus::class);
    }
}
