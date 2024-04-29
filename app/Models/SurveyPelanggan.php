<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SurveyPelanggan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'survey_pelanggan';

    protected $fillable = [
        'karyawan_id',
        'penjamin_layanan_id',
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
}
