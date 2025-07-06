<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortalUtama extends Model
{
    use HasFactory;

    protected $table = 'portal_utamas';
    protected $primaryKey = 'id_portal_utama';
    protected $fillable = [
        'nama_portal_user',
        'keterangan_user',
        'link',
        'click_count',
    ];
}