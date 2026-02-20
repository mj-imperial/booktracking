<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'author',
        'pages'
    ];

     public function users(): BelongsToMany {
        return $this->belongsToMany(
                        User::class, 
                        'book_user', 
                        'book_id', 
                        'user_id'
                    )->withPivot('current_page', 'started_at',
                                    'finished_at', 'is_finished', 'rating');
    }

    public function genres(): BelongsToMany {
        return $this->belongsToMany(
            Genre::class,
            'book_genre',
            'book_id',
            'genre_id'
        );
    }
}
