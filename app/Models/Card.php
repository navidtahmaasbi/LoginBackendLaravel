<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'cards';

    // Fillable fields
    protected $fillable = [
        'title', // Card title
        'description', // Card description
        'category_id', // Foreign key to categories table
    ];

    // Define the relationship with Category (many cards belong to one category)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
