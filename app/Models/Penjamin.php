<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penjamin extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'penjamin';

    protected $fillable = [
        'unit_id',
        'nama_penjamin',
    ];

    protected $guarded = 'id';

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $cast = [
        'nama_penjamin' => 'string'
    ];
    
    public function parentUnit() : BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
}
