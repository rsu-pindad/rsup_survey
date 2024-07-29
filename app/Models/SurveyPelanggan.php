<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SurveyPelanggan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'survey_pelanggan';

    protected $fillable = [
        'nama_pelanggan',
        'handphone_pelanggan',
        'shift',
        'nilai_skor',
    ];

    protected $guarded = 'id';

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $timestamps = true;

    public function parentPenjamin(): BelongsTo
    {
        return $this->belongsTo(Penjamin::class, 'penjamin_id', 'id');
    }

    public function parentLayanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class, 'layanan_id', 'id');
    }


}
