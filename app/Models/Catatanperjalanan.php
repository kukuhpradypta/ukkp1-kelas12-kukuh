<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Catatanperjalanan extends Model
{
    use HasFactory;
    use softDeletes;
    protected $fillable = [
        'id_user',
        'tgl',
        'jam',
        'lokasi',
        'suhu',
        'foto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
