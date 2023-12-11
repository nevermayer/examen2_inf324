<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
	protected $table = 'factura';
	public $timestamps = false;
	protected $dateFormat = 'Y-m-d';

	protected $casts = [
		'total' => 'float',
		'cajero_id' => 'int',
		'cliente_id' => 'int'
	];

	protected $fillable = [
		'total',
		'fecha',
		'cajero_id',
		'cliente_id'
	];

	public function cajero()
	{
		return $this->belongsTo(Cajero::class);
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
