<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'boards';

    // Fillable fields
    protected $fillable = [
        'title', // Board name
        'user_id', // Foreign key to users table (assuming a board belongs to a user)
    ];

    // Define the relationship with User (many boards belong to one user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with Category (one board can have many categories)
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
