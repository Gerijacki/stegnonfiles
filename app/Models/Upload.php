<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Upload extends Model
{
    protected $fillable = [
        'uuid',
        'path',
        'original_filename',
        'mime_type',
        'encryption_key',
        'user_password_salt',
        'iv_user_password',
        'iv_base_encryption',
        'has_password',
    ];

    protected static function booted()
    {
        static::creating(function ($upload) {
            $upload->uuid = Str::uuid();
        });
    }
}
