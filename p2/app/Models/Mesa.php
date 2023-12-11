<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
	protected $table = 'mesa';
	public $timestamps = false;

	protected $casts = [
		'camarero_id' => 'int',
		'cliente_id' => 'int'
	];

	protected $fillable = [
		'nombre',
		'min_capacidad',
		'max_capacidad',
		'status',
		'camarero_id',
		'cliente_id'
	];

	public function camarero()
	{
		return $this->belongsTo(Camarero::class);
	}

	public function cliente()
	{
		return $this->belongsTo(Cliente::class);
	}

	public function ordenes()
	{
		return $this->hasMany(Orden::class);
	}
}
