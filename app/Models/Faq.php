<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    // Table name (optional if follows Laravel convention)
    protected $table = 'faqs';

    // Fillable fields to allow mass assignment
    protected $fillable = [
        'question',
        'answer',
    ];
}
