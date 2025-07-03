<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortalAdmin extends Model
{
    use HasFactory;

    protected $table = 'portal_admins';
    protected $primaryKey = 'id_portal_admin';
    protected $fillable = [
        'nama_portal_admin',
        'keterangan_admin',
        'link'
    ];
}