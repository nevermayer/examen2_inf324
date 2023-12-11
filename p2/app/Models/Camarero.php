<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Camarero
 * 
 * @property int $id
 * @property int $id_usuario
 * 
 * @property User $user
 * @property Collection|Mesa[] $mesas
 * @property Collection|Orden[] $ordens
 *
 * @package App\Models
 */
class Camarero extends Model
{
	protected $table = 'camarero';
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

	public function mesas()
	{
		return $this->hasMany(Mesa::class);
	}

	public function ordens()
	{
		return $this->hasMany(Orden::class);
	}
}
