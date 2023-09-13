<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\UserModel1;
use CodeIgniter\Controller;
class Mycontroller extends BaseController
{
	/*public function index()
	{
		return view('user_signup');
	}
	public function adduser()
	{
		$model= new UserModel();
		$data=array(
		'username'=>$this->request->getpost('username'),
		'password'=>$this->request->getpost('password'),
		'role'=>$this->request->getpost('role'),
		);
		print_r($data);
		$model->insertuser($data);
		return redirect()->to('/user_signup');
		$user=$model->where('username',$this->request->getpost('username'))
		            ->where('password',$this->request->getpost('password'))
					->first();
		
		if($user)
		{
			$session=session();
			$session->set('logged_in',true);
			return view('user_signup');
		}
		else
		{
			return view('error1');
		}
	}*/
	public function myresume()
	{
		return view('resume');
	}
    public function datatable1()
	{
		$model = new UserModel();
       $data['users']=$model->getallusers();
	   return view('datatable1',$data);
	}
	public function del($id)
	{
		$model=new UserModel();
		$model->deleteuser($id);
		return redirect()->to('/datatable1');
	}
	public function update($id)
	{
		$model=new UserModel();
		$data['users']=$model->getuserbyid($id);
		return view('user_update',$data);
	}
	public function doupdate()
	{
		$model=new UserModel();
		$data=array(
		'username'=>$this->request->getpost('username'),
		'password'=>$this->request->getpost('password'),
		'role'=>$this->request->getpost('role'),
		);
		$id=$this->request->getpost('id');
		$model->updateuser($id,$data);
		return redirect()->to('/datatable1');
	}
	public function adminlogin()
	{
		return view ('adminlogin');
	}
	public function admindashboard()
	{
		$model=new UserModel();
		$user=$model->where('username',$this->request->getpost('username'))
		            ->where('password',$this->request->getpost('password'))
					->first();
					
		if($user)
		{
			$session=session();
			$session->set('uid',$this->request->getpost('username'));
			return view('resume');
		}
		else
		{
			return view('error1');
		}
	}
	public function error1()
	{
		        $session = session();
        if (!$session->get('uid')) {
            
            return redirect()->to('/login');
        }

        return view('error1');
    }
	public function logout()
	{
		$session=session();
		$session->destroy();
		return redirect()->to('/login1');
	}
		public function myresume1()
	{
		return view('agentresume');
	}
	public function index1()
	{
		return view('lead_signup');
	}
	public function adduser1()
	{
		
		$session=session();
		if (!$session->get('uid')) {
            
            return redirect()->to('/login');
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
		'assigned_agent_id'=>$this->request->getpost('assigned_agent_id'),
		'uploadedby'=>$uid
		);
		//$model->insertuser($data);
		//return redirect()->to('/lead_signup');
		print_r($data);
		}
		
	}
	public function datatable2()
	{
		$model = new UserModel1();
       $data['users']=$model->getallusers();
	   return view('datatable2',$data);
	}
	public function del1($id)
	{
		$model=new UserModel1();
		$model->deleteuser($id);
		return redirect()->to('/datatable2');
	}
	public function update1($id)
	{
		$model=new UserModel1();
		$data['users']=$model->getuserbyid($id);
		return view('lead_update',$data);
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
		);
		$id=$this->request->getpost('lead_id');
		$model->updateuser($id,$data);
		return redirect()->to('/datatable2');
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
			$session->set('logged_in',true);
			return view('agentresume');
		}
		else
		{
			return view('error2');
		}
	}
		public function error2()
	{
		        $session = session();
        if (!$session->get('logged_in')) {
            
            return redirect()->to('/login');
        }

        return view('error2');
    }
}
?>
		