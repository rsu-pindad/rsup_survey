<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penjamin extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'penjamin';

    protected $fillable = [
        'nama_penjamin',
        'multi_layanan'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'nama_penjamin' => 'string',
        'multi_layanan' => 'boolean'
    ];

    public function parentUnit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function penjaminLayanans(): HasMany
    {
        return $this->hashMany(PenjaminLayanan::class, 'penjamin_id', 'id');
    }
}
