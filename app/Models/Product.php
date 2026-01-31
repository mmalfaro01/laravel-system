<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
    ];



    /**
     * Accessor: Get formatted price with ₱ currency.
     */
    public function getFormattedPriceAttribute()
    {
        return '₱' . number_format($this->price, 2);
    }

    /**
     * Accessor: Return full image URL or default placeholder.
     */
    public function getImageUrlAttribute()
    {
        return $this->image && file_exists(public_path('images/products/' . $this->image))
            ? asset('images/products/' . $this->image)
            : asset('images/default.png'); // fallback image
    }
}
