<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platillo extends Model
{
	protected $table = 'platillos';
	public $timestamps = false;

	protected $casts = [
		'producto_id' => 'int'
	];

	protected $fillable = [
		'tiempo_elalboracion',
		'producto_id'
	];

	public function producto()
	{
		return $this->belongsTo(Producto::class);
	}

	public function ingredientes()
	{
		return $this->belongsToMany(Ingrediente::class, 'ingrediente_platillo', 'platillo_id', 'ingredientes_id')
					->withPivot('id');
	}
}
