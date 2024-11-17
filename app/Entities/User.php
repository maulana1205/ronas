<?php namespace App\Entities;

use CodeIgniter\Entity\Entity;

class User extends Entity
{
	protected $table = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'App\Entities\User'; // Pastikan returnType adalah entitas User
    protected $allowedFields = ['username', 'email', 'password'];
	public function setPassword(string $pass)
	{
		$salt = uniqid('', true);
		$this->attributes['salt'] = $salt;
		$this->attributes['password'] = md5($salt.$pass);

		return $this;
	}
}