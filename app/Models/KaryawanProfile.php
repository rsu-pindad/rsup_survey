<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KaryawanProfile extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'karyawanprofile';

    protected $fillable = [
        'user_id',
        'karyawan_id',
        'unit_id',
        'layanan_id',
        'nama_karyawanprofile',
    ];

    protected $hiden = [
        'created_at',
        'deleted_at',
        'updated_at'
    ];

    protected $guarded = 'id';

    protected $casts = [
        'nama_karyawan_profile' => 'string',
    ];

    public function parentUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function parentKaryawan(): BelongsTo
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id', 'id');
    }

    public function parentUnit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function parentLayanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class, 'layanan_id', 'id');
    }
}
