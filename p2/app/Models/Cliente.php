<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
	protected $table = 'cliente';
	public $timestamps = false;

	protected $casts = [
		'telefono' => 'int'
	];

	protected $fillable = [
		'nombre',
		'apellido_pat',
		'apellido_mat',
		'email',
		'password',
		'telefono',
		'activo'
	];

	public function facturas()
	{
		return $this->hasMany(Factura::class);
	}

	public function mesas()
	{
		return $this->hasMany(Mesa::class);
	}
}
