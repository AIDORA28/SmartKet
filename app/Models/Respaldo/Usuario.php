<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;
    protected $table = 'usuarios';
    protected $fillable = ['name', 'email', 'password', 'role', 'client_id'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'client_id', 'idClientes');
    }
}
