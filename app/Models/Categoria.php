<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    // Relación de 1 a muchos con productos
    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
