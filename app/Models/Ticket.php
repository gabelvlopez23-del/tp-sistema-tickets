<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'user_id',
        'titulo',
        'descripcion',
        'estado',
    ];

    // Relación Eloquent: Un ticket pertenece a un único usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
