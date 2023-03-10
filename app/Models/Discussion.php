<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Traits\TrixRender;
use App\Traits\FormatDates;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discussion extends Model
{
    use HasFactory, HasTrixRichText, TrixRender, FormatDates;

    protected $fillable = [
        'user_id',
        'title',
        'tags',
        'discussion-trixFields',
        'updated_at',
    ];

    protected $table = 'discussions';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'discussion_id');
    }
}
