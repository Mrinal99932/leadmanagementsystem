<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\UserModel1;
use CodeIgniter\Controller;
class Agentcontroller extends BaseController

{
	public function agentdashboard()
	{
		$session=session();
		if(!$session->get('uid')) {
			return redirect()->to('/login2');
		}
		else{
		return view('agentdashboard');}
	}
	public function login2()
	{
		return view ('login2');
	}
	public function dologin1()
	{
		$model=new UserModel();
		$user=$model->where('username',$this->request->getpost('username'))
		            ->where('password',$this->request->getpost('password'))
					->first();
					
		if($user)
		{
			$session=session();
			$session->set('uid',$this->request->getpost('username'));
			return view('agentdashboard');
		}
		else
		{
			return view('error2');
		}
	}
	public function error2()
	{
		        $session = session();
        if (!$session->get('uid')) {
            
            return redirect()->to('/login2');
        }

        return view('error2');
    }
	public function addleads()
	{
		$session=session();
		if (!$session->get('uid')) {
            
            return redirect()->to('/login2');
        }
		return view('addleads');
	}
	public function adduser1()
	{
		
		$session=session();
		if (!$session->get('uid')) {
            
            return redirect()->to('/login2');
        }
		else{
		$model= new UserModel1();
		$uid=$session->get('uid');
		echo "<h1>$uid</h1>";
		$data=array(
		'lead_name'=>$this->request->getpost('lead_name'),
		'lead_email'=>$this->request->getpost('lead_email'),
		'lead_phone'=>$this->request->getpost('lead_phone'),
		'lead_status'=>$this->request->getpost('lead_status'),
		'remark'=>$this->request->getpost('remark'),
		'uploadedby'=>$uid
		);
		$model->insertuser($data);
		return redirect()->to('/addleads');
		
		}
		
	}
	public function leadsview()
	{
		$session=session();
		if (!$session->get('uid')) {
            
            return redirect()->to('/adminlogin');
        }
		else{
			
		$model = new UserModel1();
       $data['users']=$model->getallusers();
		return view('datatable2',$data);}
	}
	public function del1($id)
	{
		$model=new UserModel1();
		$model->deleteuser($id);
		return redirect()->to('/leadsview');
	}
	public function update1($id)
	{
		$session=session();
		if (!$session->get('uid')) {
            
            return redirect()->to('/login2');
        }
		else{
		$model=new UserModel1();
		$data['users']=$model->getuserbyid($id);
		return view('lead_update',$data);}
	}
	public function doupdate1()
	{
		$model=new UserModel1();
		$data=array(
		'lead_name'=>$this->request->getpost('lead_name'),
		'lead_email'=>$this->request->getpost('lead_email'),
		'lead_phone'=>$this->request->getpost('lead_phone'),
		'lead_status'=>$this->request->getpost('lead_status'),
		'assigned_agent_id'=>$this->request->getpost('assigned_agent_id'),
		'remark'=>$this->request->getpost('remark'),
		);
		$id=$this->request->getpost('lead_id');
		$model->updateuser($id,$data);
		return redirect()->to('/viewleads');
	}
	public function logout2()
	{
		$session=session();
		$session->destroy();
		return redirect()->to('/login2');
	}
	public function viewleads()
	{
		$session=session();
		if (!$session->get('uid')) {
            
            return redirect()->to('/login2');
        }
		else{
		$user=$session->get('uid');
		$db=\Config\Database::connect();
		$query=$db->query("select * from leads where uploadedby='$user'");
		$data['leads']=$query->getResultArray();
        //print_r($data);
		return view('datatable3',$data);
	   }

		
	
		
	}
	
		
	
}
?>