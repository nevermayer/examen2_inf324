<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = 'orden';
	public $timestamps = false;

	protected $casts = [
		'total' => 'float',
		'telefono' => 'int',
		'chef_id' => 'int',
		'mesa_id'=>'int',
		'camarero_id' => 'int',
		'factura_id'=>'int'
	];

	protected $fillable = [
		'nombre',
		'apellido_pat',
		'total',
		'estado',
		'fecha',
		'hora',
		'telefono',
		'chef_id',
		'mesa_id',
		'camarero_id',
		'factura_id'
	];

	public function camarero()
	{
		return $this->belongsTo(Camarero::class);
	}

	public function chef()
	{
		return $this->belongsTo(Chef::class);
	}

	public function factura()
	{
		return $this->belongsTo(Factura::class);
	}
	public function mesa()
	{
		return $this->belongsTo(Mesa::class);
	}
    public function productos(){
        return $this->belongsToMany(Producto::class,'consume')->withPivot('cantidad');
    }
}
