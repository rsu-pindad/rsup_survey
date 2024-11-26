<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\belongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
// use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class Unit extends Model
{
    // use HasFactory, SoftDeletes, HasApiTokens, HasRoles, HasPermissions;
    use HasFactory, SoftDeletes;

    protected $table = 'unit';

    protected $fillable = [
        'nama_unit',
        'multi_penilaian'
    ];

    protected $hidden = [
        'created_at',
        'deleted_at',
        'updated_at'
    ];

    protected $casts = [
        'nama_unit'       => 'string',
        'multi_penilaian' => 'boolean'
    ];

    public function penjamin(): HasMany
    {
        return $this->hasMany(Penjamin::class);
    }

    public function unitProfil(): HasOne
    {
        return $this->hasOne(UnitProfil::class, 'unit_id');
    }

    public function unitMultiLayanan(): BelongsToMany
    {
        return $this->belongsToMany(Layanan::class, 'unit_multi_layanan', 'unit_id', 'layanan_id');
    }

    public function layanans(): BelongsToMany
    {
        return $this->belongsToMany(Layanan::class);
    }

    public function pivotsMultiLayanan(): BelongsToMany
    {
        // Relasi Tabel, 'Foreign key pada relasi tabel', 'key local pada model'
        return $this->belongsToMany(MultiLayanan::class, 'unit_multi_layanan', 'unit_id', 'id');
    }

    // protected static function boot()
    // {
    //     parent::boot();
    //     static::removeMulti(function ($unit) {
    //         $unit->pivotsMultiLayanan()->detach();
    //     });
    // }
}
