<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bebida extends Model
{
    protected $table = 'bebidas';
	public $timestamps = false;

	protected $casts = [
		'producto_id' => 'int'
	];

	protected $fillable = [
		'grado_alcoholico',
		'producto_id'
	];

	public function producto()
	{
		return $this->belongsTo(Producto::class);
	}
    
}
