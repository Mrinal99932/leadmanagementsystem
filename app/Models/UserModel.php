<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	protected $table='users';
	protected $primaryKey='user_id';
	protected $allowedFields=['username','password','role'];
	
	public function __construct()
	{
		$db= \Config\Database::connect();
		parent::__construct($db);
	}
	public function insertuser($data)
	{
		$this->insert($data);
	}
	public function getallusers()
	{
		return $this->findall();
	}
	public function deleteuser($id)
	{
		$this->delete($id);
	}
	public function getuserbyid($id)
	{
		return $this->find($id);
	}
	public function updateuser($id,$data)
	{
		$this->update($id,$data);
	}
	public function ladminlogin($data)
	{
		return $this->find($data);
	}
	public function getuserbyid3($id)
	{
		return $this->find($id);
	}
}
?>
		