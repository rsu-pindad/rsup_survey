<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Respon extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'respon';

    protected $fillable = [
        'nama_respon',
        'icon_respon',
        'has_question',
        'tag_warna_respon',
        'skor_respon',
        'urutan_respon'
    ];

    protected $guarded = 'id';

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'nama_respon' => 'string',
        'has_question' => 'boolean'
    ];

    public function layananRespon(): HasMany
    {
        return $this->hasMany(LayananRespon::class, 'respon_id', 'id');
    }

    public function pivotsLayananRespon(): BelongsToMany
    {
        return $this->belongsToMany(layananRespon::class, 'layanan_respon', 'respon_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($respon) {
            // if($respon->layananRespon()->exists()){
            //     return false;
            // }
            $respon->pivotsLayananRespon()->detach();
        });
    }
}
