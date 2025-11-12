<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $guarded = [];

    public function fileName(): Attribute
    {
        return Attribute::get(function () {
            return basename(storage_path('app/private/' . $this->file));
        });
    }

    public function fileSize(): Attribute
    {
        return Attribute::get(function () {
            return filesize(storage_path('app/private/' . $this->file));
        });
    }

    public function visualFileSize(): Attribute
    {
        return Attribute::get(function () {
            $size = $this->file_size;

            if ($size < 800) {
                return "$size بایت";
            }

            if ($size < 800000) {
                $size = round($size / 1024, 2);
                return "$size کیلوبایت";
            }

            $size = round($size / 1024 / 1024, 2);
            return "$size مگابایت";
        });
    }
}
