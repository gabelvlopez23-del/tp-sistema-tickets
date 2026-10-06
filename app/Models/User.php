<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// AQUÍ SE VISUALIZA LA IMPORTACIÓN DEL COMPONENTE DE SPATIE:
use Spatie\Permission\Traits\HasRoles; 

class User extends Authenticatable
{
    // Aquí adentro inyectas la herramienta para que el Usuario pueda usar roles:
    use HasFactory, Notifiable, HasRoles; 

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relación Eloquent: Un usuario puede tener muchos tickets
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
