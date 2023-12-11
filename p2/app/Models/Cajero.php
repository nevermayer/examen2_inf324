<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cajero
 * 
 * @property int $id
 * @property int $id_usuario
 * 
 * @property User $user
 * @property Collection|Factura[] $facturas
 *
 * @package App\Models
 */
class Cajero extends Model
{
	protected $table = 'cajero';
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

	public function facturas()
	{
		return $this->hasMany(Factura::class);
	}
}
