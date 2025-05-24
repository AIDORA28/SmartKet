<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $fillable = ['name', 'category_id', 'stock', 'price', 'description'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'category_id', 'idCategorias');
    }
}
