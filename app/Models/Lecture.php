<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $fillable = [
        'nama',
        'nidn',
        'pendidikan',
        'jabatan',
        'email',
        'topik',
        'image',
    ];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value): ?string => $value !== null ? trim($value) : null,
            set: fn (?string $value): ?string => $value !== null ? trim($value) : null,
        );
    }
}