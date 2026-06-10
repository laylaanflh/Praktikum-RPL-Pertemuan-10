<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
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