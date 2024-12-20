<?php namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Barang extends Entity
{
	protected $dates = ['created_date', 'updated_date'];

	public function setGambar($file)
	{
		$fileName = $file->getRandomName();
		$writePath ='./uploads';
		$file->move($writePath, $fileName);
		$this->attributes['gambar'] = $fileName;
		return $this;
	}
}