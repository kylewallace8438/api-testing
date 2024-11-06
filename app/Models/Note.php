<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $table = 'notes';

    protected $fillable = [
        'title',
        'description',
        'content',
        'is_pinned',
        'tags',
        'user_id'
    ];

    protected function casts(): array
    {
        return [
            'is_pinned' => 'boolean'
        ];
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
