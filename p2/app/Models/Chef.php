<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Chef
 * 
 * @property int $id
 * @property int $id_usuario
 * 
 * @property User $user
 * @property Collection|Orden[] $ordens
 * @property Collection|SolicitudChef[] $solicitud_chefs
 *
 * @package App\Models
 */
class Chef extends Model
{
	protected $table = 'chef';
	public $timestamps = false;

	protected $casts = [
		'id_usuario' => 'int'
	];

	protected $fillable = [
		'id_usuario'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id_usuario');
	}

	public function ordens()
	{
		return $this->hasMany(Orden::class);
	}

	public function ingredientes(){
        return $this->belongsToMany(Ingrediente::class, 'solicitud_chef', 'chef_id', 'ingredientes_id');
    }
}
