<?php

namespace App\Models;

use App\Events\TodoCreatedEvent;
use App\Events\TodoCreatingEvent;
use App\Events\TodoDeletedEvent;
use App\Events\TodoDeletingEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Events\TodoEvent;
use App\Events\TodoStoredEvent;
use App\Events\TodoUpdatedEvent;
use App\Events\TodoUpdatingEvent;

class Todo extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        // 'creating' => TodoCreatingEvent::class,
        // 'created' => TodoCreatedEvent::class,
        // 'updating' => TodoUpdatingEvent::class,
        // 'updated' => TodoUpdatedEvent::class,
        // 'deleting' => TodoDeletingEvent::class,
        // 'deleted' => TodoDeletedEvent::class,
        // 'stored' => TodoStoredEvent::class,
    ];

    protected $fillable = [
        'task',
        'status',
        'created',
        'end',
        'user_id',
    ];

    public function users(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany {
        return $this->hasMany(Comment::class);
    }

}
