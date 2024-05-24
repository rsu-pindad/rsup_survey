<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppSetting extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'app_setting';

    protected $fillable = [
        'initial_domain_logo',
        'initial_header_logo',
        'initial_body_logo',
        'initial_moto_text',
        'initial_alamat_text'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
