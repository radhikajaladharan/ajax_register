<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('index');
	}



	public function register()

{
	$this->load->view('register');
}

public function registration()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules("fname","fname",'required');
		$this->form_validation->set_rules("lname","lname",'required');
		$this->form_validation->set_rules("age","age",'required');
		$this->form_validation->set_rules("gender","gender",'required');
		$this->form_validation->set_rules("address","address",'required');
		$this->form_validation->set_rules("district","district",'required');
		$this->form_validation->set_rules("phno","Phonenumber",'required');
		$this->form_validation->set_rules("email","Email",'required');
		$this->form_validation->set_rules("password","password",'required');
		
		
		if($this->form_validation->run())
		{
			$this->load->model('mainmodel');
			$pass=$this->input->post("password");
			$encpass=$this->mainmodel->encpassword($pass);
		$a=array("fname"=>$this->input->post("fname"),
			"lname"=>$this->input->post("lname"),
			"age"=>$this->input->post("age"),
			"gender"=>$this->input->post("gender"),
			"address"=>$this->input->post("address"),
			"district"=>$this->input->post("district"),
			"phno"=>$this->input->post("phno"));
		$b=array("email"=>$this->input->post("email"),
			"password"=>$encpass,'utype'=>'1');
		
		$this->mainmodel->register($a,$b);
		redirect(base_url().'main/register');

	    }

}

//login start

public function login()
{
$this->load->view('login');
}
public function new_login()
{
$this->load->library('form_validation');
$this->form_validation->set_rules("email","email",'required');
$this->form_validation->set_rules("password","password",'required');
if($this->form_validation->run())
{
$this->load->model('mainmodel');
$em=$this->input->post("email");
$pass=$this->input->post("password");
$rslt=$this->mainmodel->slctpass($em,$pass);

if ($rslt)
{
$id=$this->mainmodel->getusrid($em);
$user=$this->mainmodel->getusr($id);
$this->load->library(array('session'));
$this->session->set_userdata(array('id'=>(int)$user->id,'utype'=>$user->utype,'logged_in'=>(bool)true));
if($_SESSION['logged_in']==true && $_SESSION['utype']=='0')
{
redirect(base_url().'main/admin');
}

elseif ($_SESSION['utype']=='1')
{
redirect(base_url().'main/passenger');
}

    }
    else
    {
    echo "invalid user";
    }
}
else
{
redirect('main/login','refresh');
}
}



//login ends

/*passenger home page*/
public function passenger()

{
$this->load->view('passenger');
}

/*  passenger view of profile  for updation*/
public function passprofile()

{

		
		$this->load->model('mainmodel');
		$id=$this->session->id;
		$data['user_data']=$this->mainmodel->updateform($id);
		$this->load->view('passprofile',$data);

	}
	public function updatedetails1()
	{
		$a=array("fname"=>$this->input->post("fname"),
			"lname"=>$this->input->post("lname"),
			"age"=>$this->input->post("age"),
			"gender"=>$this->input->post("gender"),
			"address"=>$this->input->post("address"),
			"district"=>$this->input->post("district"),
			"phno"=>$this->input->post("phno"));
		$b=array("email"=>$this->input->post("email"));
		$this->load->model('mainmodel');
		
		if($this->input->post("update"))
		{
			$id=$this->session->id;
			$this->mainmodel->updates($a,$b,$id);
			redirect('main/passprofile','refresh');
		}

	}



/******flight search of passenger starts*/
 public function flightsearch()
    {
        $this->load->view('flightsearch');
    }
    public function searchaction()
    {
        $this->load->model('mainmodel');
        $d=date('y-m-d');
        $this->mainmodel->deletedate($d);
        $dep=$this->input->post("departure");
        $arr=$this->input->post("arrival");
        $date=$this->input->post("date");
        $data['n']=$this->mainmodel->uviewflight($dep,$arr,$date);
        $this->load->view('flight_seachresult',$data);


    }
  
// public function flightsss()

// {
// $this->load->view('flight');
// }

//passenger ::ends

/*************notification*******************/

//admin adding notification
public function notification()

{
		$this->load->model('mainmodel');
		$data['n']=$this->mainmodel->flightname();
		$this->load->view('notification',$data); 
}

//action
public function notify_action()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules("noti","notification",'required')
		;


		

		if($this->form_validation->run())
		{

			
			$this->load->model('mainmodel');

			$n=array("notification"=>$this->input->post("noti"),"f_id"=>$this->input->post("flight"),"cdate"=>date('y-m-d'));

			$this->mainmodel->notifymodel($n);
			redirect('main/notification','refresh');
		}	
	}

//insertion of notification ends

//admin view of notification	

	public function notiadmin()
	{
		
		$this->load->model('mainmodel');
		$date=date('y-m-d');// for auto delete of notification
 		$this->mainmodel->notidelete($date);
		$data['n']=$this->mainmodel->admin_notify();
		$this->load->view('admin_notify_view',$data);

	}

	/*notification:admin delete*/
	public function notify_delete()
	{
		$id=$this->uri->segment(3);
		$this->load->model('mainmodel');
		$this->mainmodel->admin_delete($id);
		redirect('main/notiadmin','refresh');
	}

	/*notification :admin update*/
	

	public function admin_update()
	{
		
		$a=array("notification"=>$this->input->post("noti"));
		$this->load->model('mainmodel');
		$id=$this->uri->segment(3);

		$data['user_data']=$this->mainmodel->singledata($id);
		$this->mainmodel->singleselect();
		$this->load->view('update_noti_view',$data);
		if($this->input->post("update"))
		{
			$this->mainmodel->updatedetails($a,$this->input->post("id"));
			redirect('main/notiadmin','refresh');
		}
	}
/*user view of notification*/
	public function notiuser()
	{
		$this->load->model('mainmodel');
		$data['n']=$this->mainmodel->user_notify();
		$this->load->view('notify_table_view',$data);
	} 
 
/*------------------notification ends-----------------*/


/*--------------------admin home page---------------*/
public function admin()

{
$this->load->view('admin')
;}

/* ------------ filght -------------------------------*/


public function flights()
{
	$this->load->model('mainmodel');
	$data['n']=$this->mainmodel->flights();
	$this->load->view('flight',$data);
}

public function flightreg()

{
	$this->load->view('flightreg');
}
 public function flightreg_action()
 {

 	$this->load->library('form_validation');
		$this->form_validation->set_rules("airlinename","airlinename",'required');
		$this->form_validation->set_rules("departure","departure",'required');
		$this->form_validation->set_rules("arrival","arrival",'required');
		$this->form_validation->set_rules("date","date",'required');
		$this->form_validation->set_rules("dtime","dtime",'required');
		$this->form_validation->set_rules("atime","atime",'required');
		
		$this->form_validation->set_rules("seatcapacity","seatcapacity",'required');
		$this->form_validation->set_rules("business","business",'required');
		$this->form_validation->set_rules("economy","economy",'required');
		$this->form_validation->set_rules("first","first",'required');

		$this->form_validation->set_rules("bcost","bcost",'required');
		$this->form_validation->set_rules("ecost","ecost",'required');
		$this->form_validation->set_rules("fcost","fcost",'required');
		
		
		if($this->form_validation->run())
		{
			$this->load->model('mainmodel');
		$a=array("airlinename"=>$this->input->post("airlinename"),
			"departure"=>$this->input->post("departure"),
			"arrival"=>$this->input->post("arrival"),
			"date"=>$this->input->post("date"),
			"dtime"=>$this->input->post("dtime"),
			"atime"=>$this->input->post("atime"),
			"seatcapacity"=>$this->input->post("seatcapacity"),
			"business"=>$this->input->post("business"),
			"economy"=>$this->input->post("economy"),
			"first"=>$this->input->post("first"),
			"bcost"=>$this->input->post("bcost"),
			"ecost"=>$this->input->post("ecost"),
			"fcost"=>$this->input->post("fcost"));

			$this->mainmodel->flightregist($a);
			redirect(base_url().'main/flightreg');
		
		

	    }


 }




public function updateflight()
{
	$this->load->model('mainmodel');
	$id=$this->uri->segment(3);
	$data['user_data']=$this->mainmodel->fupdate($id);
	$this->load->view('updateflight',$data);
}


public function flightupdate()
	{
		$a=array("airlinename"=>$this->input->post("airlinename"),
			"departure"=>$this->input->post("departure"),
			"arrival"=>$this->input->post("arrival"),
			"date"=>$this->input->post("date"),
			"dtime"=>$this->input->post("dtime"),
			"atime"=>$this->input->post("atime"),
			"seatcapacity"=>$this->input->post("seatcapacity"),
			"business"=>$this->input->post("business"),
			"economy"=>$this->input->post("economy"),
			"first"=>$this->input->post("first"),
			"bcost"=>$this->input->post("bcost"),
			"ecost"=>$this->input->post("ecost"),
			"fcost"=>$this->input->post("fcost"));
			$this->load->model('mainmodel');
		
		if($this->input->post("update"))
		{
			$id=$this->input->post("id");
			$this->mainmodel->updateflight($a,$id);
			redirect('main/flights','refresh');
		}

	}

 	public function deleteflight()
 	{
 		$id=$this->session->id;
 		$this->load->model('mainmodel');
		$this->mainmodel->flightdelete($id);
 	}


 	/**booking starts*/

 	public function book()
    {
    	//$id=$this->session->flightid;


    	$this->load->model('mainmodel');
    	$data['n']=$this->mainmodel->bookview();
		$this->load->view('bookview',$data);

    }

  //   public function bform()
  //   {
  //   	$this->load->model('mainmodel');
		// $id=$this->uri->segment(3);
		// $data['n']=$this->mainmodel->mbform($id);
		// $this->load->view('bform',$data);
  //   }

//
    public function bookpay()
    {
    	$id=$this->session->id;
    	$this->load->model('mainmodel');
    	$user['a']=$this->mainmodel->username($id);

    	
    	$data['n']=array("t"=>$this->input->post('t'),"ts"=>$this->input->post('ts'),"flightname"=>$this->input->post('airlinename'),"departure"=>$this->input->post("departure"),"arrival"=>$this->input->post("arrival"),"date"=>$this->input->post("date"),"dtime"=>$this->input->post("dtime"),"atime"=>$this->input->post("atime"));


    	 //$c[]=$user['a']+$data['n'];
    	//$c[]=array_merge_recursive($user,$data);
    	//print_r($data[a['fname']]);


    	// $a=array('id'=>5,'name'=>'kavya');
    	// $b=array('ids'=>7,'names'=>'Radhika');
    	// $c[]=$a+$b;
    	// print_r($c);

    }
    /***/

    /*** discount added by admin*/
    public function discount()
    {

    	$this->load->model('mainmodel');
		$data['n']=$this->mainmodel->flightname();
		$this->load->view('discount',$data); 	
    }

 public function discount_action()
    {
		$this->load->library('form_validation');
		$this->form_validation->set_rules("discount","discount",'required')
		;


		

		if($this->form_validation->run())
		{

			
			$this->load->model('mainmodel');

			$n=array("discount"=>$this->input->post("discount"),"f_id"=>$this->input->post("flight"));

			$this->mainmodel->mdiscount($n);
			redirect('main/discount','refresh');
		}	
	}

//insertion of


 	/*******************payment******************************/

public function receipt()
{
	$this->load->model('mainmodel');
	$id=$this->session->id;
	$fid=$this->session->flightid;
	$data['n']=$this->mainmodel->receipt($id,$fid);
	$this->load->view('receipt',$data);
}



  public function details()
    {
    	$id=$this->uri->segment(3);
    	$data['n']=$this->uri->segment(3);
    	$this->load->library(array('session'));
$this->session->set_userdata(array('flightid'=>$id));
    	
    	$this->load->view('details',$data);
    }
    public function seatavail(){
    	
$cls=$this->input->post("seat");
	$this->load->model('mainmodel');
	$id=$this->session->id;
	$fid=$this->session->flightid;
	
    	
    	//$id=$this->input->post("id");
    	$did=$this->session->flightid;
//     	$this->load->library(array('session'));
// $this->session->set_userdata(array('flightid'=>$id));
    	if($cls=='business'){
    		$u['no']=$this->mainmodel->seat($did,$cls);
    		//print_r($u);
    		$b=$u['no'];
    		$seat='b'.$b;
    		//echo $seat;
    		$this->load->view('details',$u);
    		//$this->load->view('conform',$u);

    		// if($this->input->post('book') != NULL)
    		// {
    		// 	$postData=$this->input->post();
    		// 	echo "<b>name:</b>".$postData['traveller']."</br>";
    		// }


    	}

    	//economy 
    	if($cls=='Economic')
    	{
    		$u['no']=$this->mainmodel->seat($did,$cls);
    		$e=$u['no'];
    		$seat='e'.$e;
    		$this->load->view('details',$u);
    		
    		
    	}

    	//first

    	if($cls=='first')
    	{
    		$u['no']=$this->mainmodel->seat($did,$cls);
    		$f=$u['0'];
    		$seat='f'.$f;
    		$this->load->view('details',$u);
    		
    	}

    	/*session to store seat number, class*/
    		$this->load->library(array('session'));
			$this->session->set_userdata(array('s_num'=>$seat,'class_type'=>$cls));
			$s=$this->session->s_num;
			//echo $s;
			$c=$this->session->class_type;
			//echo $c;
			/****/

    	$a=array("flight"=>$fid,"login_id"=>$id,'payment_status'=>'0',"class"=>$this->input->post("seat"),"seat_no"=>$seat);
	$this->mainmodel->bookinsert($a);
	
   
    }







public function payment()
{


$this->load->view('payment');
}

/**********************payment ends**********************************/
/*ticket view*/

public function ticket()
{

	$this->load->model('mainmodel');
	$id=$this->session->id;
	$fid=$this->session->flightid;
	$s=$this->session->s_num;
	$data['n']=$this->mainmodel->ticket($id,$fid,$s);
	$this->load->view('ticket',$data);
	
}




}
