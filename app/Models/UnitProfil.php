<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UnitProfil extends Model
{
    use HasFactory;

    protected $table = 'unit_profil';

    protected $fillable = [
        'unit_id',
        'unit_main_logo',
        'unit_sub_logo',
        'unit_alamat',
        'unit_motto',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function parentUnit() : BelongsTo
    {
        return $this->belongsTo(Unit::class ,'unit_id', 'id');
    }

}
