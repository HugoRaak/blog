<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * @mixin IdeHelperPost
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'created_at',
        'updated_at'
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function excerpt(string $string, int $limit = 100): ?string
    {
        $excerpt = Str::limit($string, $limit);
        if ($lastSpace = strrpos($excerpt, ' ')) {
            return substr($excerpt, 0, $lastSpace) . '...';
        }
        return $excerpt;
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
