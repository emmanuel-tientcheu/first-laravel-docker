<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'view',
        'deletable',
        'todo_id'
    ];

    public function todos(): BelongsTo {
        return $this->belongsTo(Todo::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
