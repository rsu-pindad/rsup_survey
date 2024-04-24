<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Znck\Eloquent\Traits\BelongsToThrough;

class PenjaminLayanan extends Model
{
    use HasFactory, SoftDeletes, BelongsToThrough;

    protected $table = 'penjamin_layanan';

    protected $fillable = [
        'penjamin_id',
        'layanan_id',
    ];

    protected $guarded = 'id';

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'penjamin_id' => 'string',
        'layanan_id' => 'string'
    ];

    public function parentPenjamin(): BelongsTo
    {
        return $this->belongsTo(Penjamin::class, 'penjamin_id', 'id');
    }

    public function parentLayanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class, 'layanan_id', 'id');
    }

    public function parentPenjaminUnit()
    {
        return $this->belongsToThrough(Unit::class, Penjamin::class);
    }
}
