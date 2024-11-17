<?php namespace App\Models;

use CodeIgniter\Model;
use App\Entities\User;

class UserModel extends Model
{
	protected $table = 'user';
	protected $primaryKey = 'id';
	protected $allowedFields = [
		'username', 'avatar', 'password', 'salt', 'created_date', 'created_by', 'updated_date', 'updated_by'
	];
	protected $returnType = User::class;
	protected $useTimestamps = true;
	protected $createdField = 'created_date';
	protected $updatedField = 'updated_date';

	// Automatically hash password before saving
	protected $beforeInsert = ['hashPassword'];
	protected $beforeUpdate = ['hashPassword'];

	protected function hashPassword(array $data)
	{
		// Check if password exists in the data array and hash it
		if (isset($data['data']['password'])) {
			$data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
		}
		return $data;
	}
}
