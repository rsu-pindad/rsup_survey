<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Respon extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'respon';

    protected $fillable = [
        'nama_respon',
        'skor_respon'
    ];

    protected $guarded = 'id';

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $cast = [
        'nama_respon' => 'string'
    ];

    public function layananRespon(): HasMany
    {
        return $this->hasMany(LayananRespon::class);
    }
}
