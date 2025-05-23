<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $fillable = ['nombre', 'precio', 'stock', 'descripcion', 'categoria_id'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function detallesVentas()
    {
        return $this->hasMany(DetalleVenta::class, 'producto_id');
    }
}