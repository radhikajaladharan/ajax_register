<?php
class mainmodel extends CI_model
{

public function encpassword($pass)
	{
		$encpass=md5($pass);
		return $encpass;
		//return password_hash($pass,PASSWORD_BCRYPT);
	}

/********


	*@function name :AJAX
	*@author :Radhika Jaladharan
	*@date: 02/03/2021



	*********/


function is_email_available($email)  
      {  
           $this->db->where('email', $email);  
           $query = $this->db->get("tb_login");  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;  
           }  
      }  
      public function is_phno_available($phno)  
      {  
           $this->db->where('phno', $phno);  
           $query = $this->db->get("tb_login");  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;  
           }  
      }
      public function is_uname_available($uname)
       {  
           $this->db->where('uname', $uname);  
           $query = $this->db->get("tb_login");  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;  
           }  
      }




/********


	*@function name :register
	*@author :Radhika Jaladharan
	*@date: 02/03/2021



	*********/


public function register($a,$b)
{
	
	$this->db->insert("tb_login",$b);
	$logid=$this->db->insert_id();
	$a['userid']=$logid;
	$this->db->insert("tb_register",$a);
	

	
}



/********


	*@function name :login
	*@author :Radhika Jaladharan
	*@date: 02/03/2021



	*********/


public function select_password($em,$pass)
{
$this->db->select('password');
$this->db->where("email=","$em");
$this->db->or_where("uname=","$em");
$this->db->or_where("phno=","$em");
$this->db->from("tb_login");
$qry=$this->db->get()->row('password');
return $this->verfypass($pass,$qry);
}
public function verfypass($pass,$qry)
{
$m=md5($pass);
if($qry==$m)
{
	return true;
}
else
{
	return false;
}

//return password_verify($pass,$qry);
}
public function get_user_id($em)
{
$this->db->select('id');
$this->db->from("tb_login");
$this->db->where("email=","$em");
$this->db->or_where("uname=","$em");
$this->db->or_where("phno=","$em");
return $this->db->get()->row('id');
}
public function get($id)
{
$this->db->select('*');
$this->db->from("tb_login");
$this->db->where("id",$id);
return $this->db->get()->row();
}

/********


	*@function name :view user 
	*@author :Radhika Jaladharan
	*@date: 02/03/2021



	*********/


public function registrationview()
	{
		$this->db->select('*');
		$this->db->join('tb_login','tb_login.id=tb_register.userid','inner');
		$qry=$this->db->get("tb_register");
		return $qry;
	}


/********


	*@function name :approve
	*@author :Radhika Jaladharan
	*@date: 02/03/2021



	*********/


		public function appreg($id)
	{
		$this->db->set('status','1');
		$qry=$this->db->where("id",$id);
		$qry=$this->db->update("tb_login");
		return $qry;
	}


/********


	*@function name :reject
	*@author :Radhika Jaladharan
	*@date: 02/03/2021



	*********/


	public function rejreg($id)
	{
		$this->db->set('status','2');
		$qry=$this->db->where("id",$id);
		$qry=$this->db->update("tb_login");
		return $qry;
	}
	/********


	*@function name :delete
	*@author :Radhika Jaladharan
	*@date: 02/03/2021



	*********/

	public function delete($id)
	{
		$qry=$this->db->join("tb_login",'tb_login.id=tb_register.userid','inner');
		$this->db->where("userid",$id);
		$this->db->delete("tb_register");
		
		$this->db->where("id",$id);
		$this->db->delete("tb_login");
	
	}
	

/********


	*@function name :update
	*@author :Radhika Jaladharan
	*@date: 02/03/2021



	*********/

public function update($a,$b)
{
	
	$this->db->insert("tb_login",$b);
	$logid=$this->db->insert_id();
	$a['userid']=$logid;
	$this->db->insert("tb_register",$a);
	

	
}

public function updatev($id)
	{
		$this->db->select('*');
		$qry=$this->db->join("tb_register",'tb_register.userid=tb_login.id','inner');
		$qry=$this->db->where("tb_register.userid",$id);
		$qry=$this->db->get("tb_login");

		return $qry;
	}


	public function updatedetails($a,$b,$id)
	{
		$this->db->select('*');
		$qry=$this->db->where("userid",$id);
		$qry=$this->db->join('tb_login','tb_login.id=tb_register.userid','inner');
		$qry=$this->db->update("tb_register",$a);
		$qry=$this->db->where("id",$id);
		$qry=$this->db->update("tb_login",$b);
		return $qry;
	}







}
?>