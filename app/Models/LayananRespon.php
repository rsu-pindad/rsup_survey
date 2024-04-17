<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LayananRespon extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'layanan_respon';

    protected $fillable = [
        'layanan_id',
        'respon_id',
    ];

    protected $guarded = 'id';

    protected $hidden = [
        'layanan_id',
        'respon_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function parent_layanan() : BelongsTo
    {
        return $this->belongsTo(Layanan::class, 'layanan_id', 'id');
    }

    public function parent_respon() : BelongsTo
    {
        return $this->belongsTo(Respon::class, 'respon_id', 'id');
    }

}
