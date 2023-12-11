<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    protected $table = 'ingredientes';
	public $timestamps = false;

	protected $fillable = [
		'stock',
		'nombre',
		'fecha_vencimiento'
	];

	public function platillos()
	{
		return $this->belongsToMany(Platillo::class, 'ingrediente_platillo', 'ingredientes_id')
					->withPivot('id');
	}

	public function postres()
	{
		return $this->belongsToMany(Postre::class, 'ingrediente_postre', 'ingredientes_id', 'postres_id')
					->withPivot('id');
	}
    public function chefs(){
        return $this->belongsToMany(Chef::class, 'solicitud_chef', 'ingredientes_id', 'chef_id');
    }
}
