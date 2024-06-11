<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Layanan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'layanan';

    protected $fillable = [
        'nama_layanan'
    ];

    protected $guarded = 'id';

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'nama_layanan' => 'string',
        'multi_layanan' => 'boolean',
    ];

    public function layananRespon(): HasMany
    {
        return $this->hasMany(LayananRespon::class);
    }

    public function units(): BelongsToMany
    {
        return $this->belongsToMany(Unit::class);
    }

    public function karyawanProfile(): HasMany
    {
        return $this->hasMany(KaryawanProfile::class, 'layanan_id', 'id');
    }

    public function pivotsLayananRespon(): BelongsToMany
    {
        // Relasi Tabel, 'Foreign key pada relasi tabel', 'key local pada model'
        return $this->belongsToMany(LayananRespon::class, 'layanan_respon', 'layanan_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($layanan) {
            if ($layanan->karyawanProfile()->exists()) {
                return false;
            }
            $layanan->pivotsLayananRespon()->detach();
        });
    }
}
