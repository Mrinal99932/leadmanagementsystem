<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\UserModel1;
use CodeIgniter\Controller;
class Admincontroller extends BaseController

{
	
	public function adminlogin()
	{
		return view ('adminlogin');
	}
	public function dashboard()
	{
		$model=new UserModel();
		$user=$model->where('username',$this->request->getpost('username'))
		            ->where('password',$this->request->getpost('password'))
					->first();
					
		if($user)
		{
			$session=session();
			$session->set('uid',$this->request->getpost('username'));
			return view('admindashboard');
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
            
            return redirect()->to('/adminlogin');
        }

        return view('error1');
    }
	public function addagent()
	{
		$session=session();
        if (!$session->get('uid')) {

            return redirect()->to('/adminlogin');
        }
		return view('user_signup');
	}
	public function adduser()
	{
		$session=session();
        if (!$session->get('uid')) {

            return redirect()->to('/adminlogin');
        }
       else{
		
		$model= new UserModel();
		$data=array(
		'username'=>$this->request->getpost('username'),
		'password'=>$this->request->getpost('password'),
		'role'=>$this->request->getpost('role'),
		);

		$model->insertuser($data);
	   return redirect()->to('/user_signup');}
		
	}
	public function admindashboard()
	{
		$session=session();
		if (!$session->get('uid')) {
		return redirect()->to('/adminlogin');
		}
		return view('admindashboard');
		
	}
	public function viewagent()
	{
		$session=session();
		if (!$session->get('uid')) {
		return redirect()->to('/adminlogin');
		}
		else{
		$model = new UserModel();
       $data['users']=$model->getallusers();
		return view('datatable1',$data);}
	}
	public function del($id)
	{
		$model=new UserModel();
		$model->deleteuser($id);
		return redirect()->to('/viewagent');
	}
	public function update($id)
	{
		$session=session();
		if (!$session->get('uid')) {
		return redirect()->to('/adminlogin');
		}
		else{
		$model=new UserModel();
		$data['users']=$model->getuserbyid($id);
		return view('user_update',$data);}
	}
	public function doupdate()
	{
		$session=session();
		if (!$session->get('uid')) {
		return redirect()->to('/adminlogin');
		}
		else{
		$model=new UserModel();
		$data=array(
		'username'=>$this->request->getpost('username'),
		'password'=>$this->request->getpost('password'),
		'role'=>$this->request->getpost('role'),
		);
		$id=$this->request->getpost('id');
		$model->updateuser($id,$data);
		return redirect()->to('/viewagent');}
	}
	public function logout()
	{
		$session=session();
		$session->destroy();
		return redirect()->to('/adminlogin');
	}
	
}
?>