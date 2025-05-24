<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $fillable = [
        'asaas_id', 'nombre', 'sexo', 'es_persona_fisica', 'documento', 'telefono', 'celular',
        'email', 'calle', 'numero', 'barrio', 'ciudad', 'estado', 'cep', 'contacto',
        'complemento', 'es_proveedor',
    ];

    public function ventas()
    {
        return $this->hasMany(Venta::class, 'cliente_id');
    }

    public function compras()
    {
        return $this->hasMany(Compra::class, 'proveedor_id');
    }
}