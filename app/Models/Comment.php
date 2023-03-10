<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'discussion_id',
        'user_id',
        'comment',
    ];

    protected $table = 'comments';

    public function discussion(): BelongsTo
    {
        return $this->belongsTo(Discussion::class, 'discussion_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
