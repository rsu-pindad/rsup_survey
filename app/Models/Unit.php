<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unit extends Model
{
    // use HasFactory, SoftDeletes, HasApiTokens, HasRoles, HasPermissions;
    use HasFactory, SoftDeletes;

    protected $table = 'unit';

    protected $fillable = [
        'nama_unit',
    ];

    protected $hidden = [
        'created_at',
        'deleted_at',
        'updated_at'
    ];

    protected $casts = [
        'nama_unit' => 'string'
    ];

    public function penjamin() : HasMany
    {
        return $this->hasMany(Penjamin::class);
    }
}
