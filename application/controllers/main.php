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

/********


	*@function name :view registration page
	*@author :Radhika Jaladharan
	*@date: 02/03/2021



	*********/
public function register()
{
	$this->load->view('register');
}

/********


	*@function name :validation
	*@author :Radhika Jaladharan
	*@date: 02/03/2021



	*********/






public function email_availibility()  
      {  
      if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))  

           {  
                echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Invalid Email</span></label>';  
           }  
           else  
           {  
                $this->load->model("mainmodel");  
                if($this->mainmodel->is_email_available($_POST["email"]))  
                {  
                     echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Email Already register</label>';  
                }  
                else  
                {  
                     echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> </label>';  
                }  
           }  
       

      }
      public function phno_availability()
      {

                $this->load->model("mainmodel");  
                if($this->mainmodel->is_phno_available($_POST["phno"]))  
                {  
                     echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Phone number Already register</label>';  
                }  
                else  
                {  
                     echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> </label>';  
                }  
           }
      public function uname_availability()
      {

                $this->load->model("mainmodel");  
                if($this->mainmodel->is_uname_available($_POST["uname"]))  
                {  
                     echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> user name Already register</label>';  
                }  
                else  
                {  
                     echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> </label>';  
                }  
           }














/********


	*@function name :registration
	*@author :Radhika Jaladharan
	*@date: 02/03/2021



	*********/

public function registration()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules("fname","fname",'required');
		$this->form_validation->set_rules("lname","lname",'required');
		$this->form_validation->set_rules("dob","dob",'required');
		$this->form_validation->set_rules("address","address",'required');
		$this->form_validation->set_rules("district","district",'required');
		$this->form_validation->set_rules("pin","pin",'required');
		$this->form_validation->set_rules("phno","Phonenumber",'required');
		$this->form_validation->set_rules("uname","Phonenumber",'required');
		$this->form_validation->set_rules("email","Email",'required');
		$this->form_validation->set_rules("password","password",'required');
		
		
		if($this->form_validation->run())
		{
			$this->load->model('mainmodel');
			$pass=$this->input->post("password");
			$encpass=$this->mainmodel->encpassword($pass);
		$a=array("fname"=>$this->input->post("fname"),
			"lname"=>$this->input->post("lname"),
			"dob"=>$this->input->post("dob"),
			
			"address"=>$this->input->post("address"),
			"district"=>$this->input->post("district"),
			"pin"=>$this->input->post("pin"));
		$b=array("phno"=>$this->input->post("phno"),
			"uname"=>$this->input->post("uname"),
			"email"=>$this->input->post("email"),
			"password"=>$encpass,'usertype'=>'1');
		
		$this->mainmodel->register($a,$b);
		redirect(base_url().'main/register');

	    }

}










/********


	*@function name :login
	*@author :Radhika Jaladharan
	*@date: 02/03/2021



	*********/

public function login()
{
	$this->load->view('login');
}

public function adminpages()
{
	if($_SESSION['logged_in']==true && $_SESSION['usertype']=='0' && $_SESSION['status']=='1')
	{
		$this->load->view('adminpages');
	}
	else
	{
		redirect(base_url().'main/login');
	}
}



public function log()
{
	$this->load->library('form_validation');
	$this->form_validation->set_rules("email","email",'required');
	$this->form_validation->set_rules("password","password",'required');
	if($this->form_validation->run())
	{
		$this->load->model('mainmodel');
		$em=$this->input->post("email");
		$pass=$this->input->post("password");
		$rslt=$this->mainmodel->select_password($em,$pass);

		if ($rslt)
		{
			$id=$this->mainmodel->get_user_id($em);
			$user=$this->mainmodel->get($id);
			$this->load->library(array('session'));
			$this->session->set_userdata(array('id'=>(int)$user->id,'status'=>$user->status,'usertype'=>$user->usertype,'logged_in'=>(bool)true));
			if($_SESSION['logged_in']==true && $_SESSION['status']=='1' && $_SESSION['usertype']=='0')
			{
				redirect(base_url().'main/adminpages');
			}

			elseif ($_SESSION['logged_in']==true && $_SESSION['status']=='1'  && $_SESSION['usertype']=='1')
			{
				redirect(base_url().'main/user_page');
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




public function forgotpassword()
{
	$this->load->view('forgotpassword');
}


public function send()
{
    $to =  $this->input->post('from');  // User email pass here
    $subject = 'Welcome To Elevenstech';

    $from = 'team2ojt@gmail.com';              // Pass here your mail id

    $emailContent = '<!DOCTYPE><html><head></head><body><table width="600px" style="border:1px solid #cccccc;margin: auto;border-spacing:0;"><tr><td style="background:#000000;padding-left:3%"><img src="http://elevenstechwebtutorials.com/assets/logo/logo.png" width="300px" vspace=10 /></td></tr>';
    $emailContent .='<tr><td style="height:20px"></td></tr>';


    $emailContent .= $this->input->post('message');  //   Post message available here


    $emailContent .='<tr><td style="height:20px"></td></tr>';
    $emailContent .= "<tr><td style='background:#000000;color: #999999;padding: 2%;text-align: center;font-size: 13px;'><p style='margin-top:1px;'><a href='http://elevenstechwebtutorials.com/' target='_blank' style='text-decoration:none;color: #60d2ff;'>www.elevenstechwebtutorials.com</a></p></td></tr></table></body></html>";
               


    $config['protocol']    = 'smtp';
    $config['smtp_host']    = 'ssl://smtp.gmail.com';
    $config['smtp_port']    = '465';
    $config['smtp_timeout'] = '60';

    $config['smtp_user']    = 'team2ojt@gmail.com';    //Important
    $config['smtp_pass']    = 'nikhila@123';  //Important

    $config['charset']    = 'utf-8';
    $config['newline']    = "\r\n";
    $config['mailtype'] = 'html'; // or html
    $config['validation'] = TRUE; // bool whether to validate email or not

     

    $this->email->initialize($config);
    $this->email->set_mailtype("html");
    $this->email->from($from);
    $this->email->to($to);
    $this->email->subject($subject);
    $this->email->message($emailContent);
    $this->email->send();

    $this->session->set_flashdata('msg',"Mail has been sent successfully");
    $this->session->set_flashdata('msg_class','alert-success');
    return redirect('main/forgotpswd');

}




/********


	*@function name :view user
	*@author :Radhika Jaladharan
	*@date: 02/03/2021



	*********/


public function viewapp()

{
	if($_SESSION['logged_in']==true && $_SESSION['usertype']=='0' && $_SESSION['status']=='1')
	{
		$this->load->view('viewuser');
	}
	else
	{
			redirect('main/login','refresh');
	}
}

public function view()
{ 
	if($_SESSION['logged_in']==true && $_SESSION['usertype']=='0' && $_SESSION['status']=='1')
	{
		$this->load->model('mainmodel');
		$data['n']=$this->mainmodel->registrationview();
		$this->load->view('viewuser',$data);
	}
	else
	{
			redirect('main/login','refresh');
	}
}

/********


	*@function name :approve
	*@author :Radhika Jaladharan
	*@date: 02/03/2021



	*********/


public function approve()
	{
		if($_SESSION['logged_in']==true && $_SESSION['usertype']=='0' && $_SESSION['status']=='1')
	{

		$this->load->model('mainmodel');
		$id=$this->uri->segment(3);
		$this->mainmodel->appreg($id);
		redirect('main/view','refresh');
	}
	else
	{
		redirect('main/login','refresh');
	}
		
	}

/********


	*@function name :reject
	*@author :Radhika Jaladharan
	*@date: 02/03/2021



	*********/

	public function reject()
	{

		if($_SESSION['logged_in']==true && $_SESSION['usertype']=='0' && $_SESSION['status']=='1')
	{

		$this->load->model('mainmodel');
		$id=$this->uri->segment(3);
		$this->mainmodel->rejreg($id);
		redirect('main/view','refresh');
	}
	else
	{
		redirect('main/login','refresh');
	}
		
	}

/********


	*@function name :delete
	*@author :Radhika Jaladharan
	*@date: 02/03/2021



	*********/



public function delete()
	{

		if($_SESSION['logged_in']==true && $_SESSION['usertype']=='0' && $_SESSION['status']=='1')
	{

		$this->load->model('mainmodel');
		$id=$this->uri->segment(3);
		$this->mainmodel->delete($id);
		redirect('main/view','refresh');
	}
	else
	{
		redirect('main/login','refresh');
	}
		
	}


/********


	*@function name :user page
	*@author :Radhika Jaladharan
	*@date: 02/03/2021



	*********/

	public function user_page()
    {
    	if($_SESSION['logged_in']==true && $_SESSION['usertype']=='1' && $_SESSION['status']=='1')
		{
        $this->load->view('userpage');
    }
    else
    {
    	redirect('main/login','refresh');
    }
    }

/********


	*@function name :view for update
	*@author :Radhika Jaladharan
	*@date: 02/03/2021



	*********/

public function update_user()
{
	if($_SESSION['logged_in']==true && $_SESSION['usertype']=='1' && $_SESSION['status']=='1')
		{
			$this->load->model('mainmodel');
			$id=$this->session->id;
			$data['user_data']=$this->mainmodel->updatev($id);
			$this->load->view("update",$data);
		}
		else
		{
			redirect('main/login','refresh');
		}
}


/********


	*@function name :update
	*@author :Radhika Jaladharan
	*@date: 02/03/2021



	*********/



public function updateuser()
	{
		if($_SESSION['logged_in']==true && $_SESSION['usertype']=='1' && $_SESSION['status']=='1')
		{
			$a=array("fname"=>$this->input->post("fname"),
				"lname"=>$this->input->post("lname"),
				"dob"=>$this->input->post("dob"),
					 "address"=>$this->input->post("address"),
					 "district"=>$this->input->post("dis"),
					 "pin"=>$this->input->post("pin"));
			$b=array("phno"=>$this->input->post("phno"),
				"uname"=>$this->input->post("uname"),
				"email"=>$this->input->post("email"));
			$this->load->model('mainmodel');
		
			
		if($this->input->post("update"))
		{
			$id=$this->session->id;
			$this->mainmodel->updatedetails($a,$b,$id);
			redirect('main/update_user','refresh');
		}
	
	else
	{
		redirect('main/login','refresh');
	}
		
	}
	}






/********


	*@function name :logout
	*@author :Radhika Jaladharan
	*@date: 02/03/2021



	*********/
public function logout()
    {
        $data=new stdClass();
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']===true)
        {
            foreach ($_SESSION as $key => $value)
            {
               unset($_SESSION[$key]);
            }
            $this->session->set_flashdata('logout_notification','logged_out');
            redirect('/','refresh');
        }
        else{
            redirect('/','refresh');
        }
    }
  

}
