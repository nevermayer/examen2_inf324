<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postre extends Model
{
	protected $table = 'postres';
	public $timestamps = false;

	protected $casts = [
		'producto_id' => 'int'
	];

	protected $fillable = [
		'tiempo_elaboracion',
		'producto_id'
	];

	public function producto()
	{
		return $this->belongsTo(Producto::class);
	}

	public function ingredientes()
	{
		return $this->belongsToMany(Ingrediente::class, 'ingrediente_postre', 'postres_id', 'ingredientes_id')
					->withPivot('id');
	}
}
