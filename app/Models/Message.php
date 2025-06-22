<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
        protected $fillable = ['name', 'email', 'message'];
    protected $table = 'messages';  
    public $timestamps = true; // Enable timestamps if needed
    // You can add additional methods or relationships here if needed
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];



    }
    /**
     * Get the human-readable message.
     *
     * @return string
     */
    public function getHumanReadableMessageAttribute(): string
    {
        return "Message from {$this->name} ({$this->email}): {$this
->message}";


    }
}
