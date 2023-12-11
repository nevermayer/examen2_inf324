<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table="users";
    protected $fillable = [
        'nombre_cuenta',
        'password',
        'apellido_pat',
        'apellido_mat',
        'nombre',
        'activo',
        'super_usuario',
        'turno'
    ];
    public $timestamps = false;
    
    public function administradors()
	{
		return $this->hasMany(Administrador::class, 'id_usuario');
	}

	public function auditorias()
	{
		return $this->hasMany(Auditoria::class, 'id_usuario');
	}

	public function cajeros()
	{
		return $this->hasMany(Cajero::class, 'id_usuario');
	}

	public function camareros()
	{
		return $this->hasMany(Camarero::class, 'id_usuario');
	}

	public function chefs()
	{
		return $this->hasMany(Chef::class, 'id_usuario');
	}
}
