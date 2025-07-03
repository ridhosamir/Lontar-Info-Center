<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    protected $table = 'reminders';
    protected $primaryKey = 'id_reminder';
    protected $fillable = [
        'pesan',
        'gambar'
    ];
}