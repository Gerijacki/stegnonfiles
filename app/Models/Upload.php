<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($upload) {
            $upload->uuid = Str::uuid();
        });

        static::deleting(function ($upload) {
            if (Storage::exists($upload->path)) {
                Storage::delete($upload->path);
            }
        });
    }
}
