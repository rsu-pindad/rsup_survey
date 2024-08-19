<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
// use Illuminate\Database\Eloquent\SoftDeletes;

class MultiLayanan extends Model
{
    use HasFactory;

    protected $table = 'unit_multi_layanan';

    protected $fillable = [
        'unit_id',
        'layanan_id',
        'urutan_multi_layanan'
    ];

    protected $hidden = [
        'created_at',
        'deleted_at',
        'updated_at'
    ];

    public function parentUnit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function parentLayanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class, 'layanan_id', 'id');
    }

    public function units(): BelongsToMany
    {
        return $this->BelongsToMany(Layanan::class, 'layanan_id', 'id');
    }

}
