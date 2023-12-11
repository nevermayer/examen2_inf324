<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
	public $timestamps = false;

	protected $fillable = [
		'nombre',
		'descripcion',
		'imagen',
		'status',
		'precio',
		'cantidad'
	];

	public function bebidas()
	{
		return $this->hasMany(Bebida::class);
	}

	public function platillos()
	{
		return $this->hasMany(Platillo::class);
	}

	public function postres()
	{
		return $this->hasMany(Postre::class);
	}
    public function ordens(){
        return $this->belongsToMany(Orden::class,'consume');
    }
}
