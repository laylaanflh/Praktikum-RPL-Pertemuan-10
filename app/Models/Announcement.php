<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'content',
        'users_id',
        'slug',
    ];

    protected static function booted(): void
    {
        static::creating(function (Announcement $announcement): void {
            if (blank($announcement->users_id) && auth()->check()) {
                $announcement->users_id = auth()->id();
            }

            if (blank($announcement->slug) && filled($announcement->title)) {
                $announcement->slug = static::uniqueSlug($announcement->title);
            }
        });

        static::updating(function (Announcement $announcement): void {
            if ($announcement->isDirty('title') && filled($announcement->title)) {
                $announcement->slug = static::uniqueSlug($announcement->title, $announcement->id);
            }
        });
    }

    protected static function uniqueSlug(string $title, ?int $exceptId = null): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $count = 1;

        while (static::query()
            ->when($exceptId, fn ($query) => $query->where('id', '!=', $exceptId))
            ->where('slug', $slug)
            ->exists()) {
            $slug = $original.'-'.$count++;
        }

        return $slug;
    }

    /**
     * Relasi: Announcement ini dimiliki oleh (dibuat oleh) satu User.
     * belongsTo = "satu announcement milik satu user"
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}