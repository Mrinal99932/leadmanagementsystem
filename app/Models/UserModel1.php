<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel1 extends Model
{
	protected $table='leads';
	protected $primaryKey='lead_id';
	protected $allowedFields=['lead_name','lead_email','lead_phone','lead_status','assigned_agent_id','uploadedby','remark'];
	
	
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
	public function login2($data)
	{
		return $this->find($data);
	}
	
}
?>