<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class LayananRespon extends Model
{
    use HasFactory;

    protected $table = 'layanan_respon';

    protected $fillable = [
        'layanan_id',
        'respon_id',
    ];

    protected $hidden = [
        'layanan_id',
        'respon_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function parentLayanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class, 'layanan_id', 'id');
    }

    public function parentRespon(): BelongsTo
    {
        return $this->belongsTo(Respon::class, 'respon_id', 'id');
    }
}
