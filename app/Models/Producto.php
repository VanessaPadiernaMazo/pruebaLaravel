<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'precio', 'categoria_id'];

    // Relación de muchos a 1 con categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
