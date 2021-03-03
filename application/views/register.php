<!DOCTYPE html>
<html>
<head>
<title>Registration</title>
<meta charset=utf-8>
            <meta name="viewport" content="width=device-width,initial-scale=1">

             <!---Fontawesome--->
            <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
            <!---Bootstrap5----->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
 <style>

 
  .top{
background-color:#5c00e6;
}
body{
background-image: url("../img/.png");
background-size: cover;
background-attachment: fixed;
}


</style>
</head>
<body>

<nav class="navbar navbar-expand-lg top1 sticky-top top">
    <div class="container">
     
        <a href="" class="text-decoration-none text-white"></a>
       
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto ">
                <li class="nav-item">
                    <a href="<?php echo base_url()?>" class="nav-link text-white">Home</a>
                </li>
               
                <li class="nav-item">
                    <a href="<?php echo base_url()?>main/login" class="nav-link text-white">Sign In</a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo base_url()?>main/register" class="nav-link text-white" >Sign Up</a>
                </li>

               
               
            </ul>
        </div>
    </div>
</nav>

<!--nav end-->
<section>

<div class="container ">
<div class="row">
<div class="container col-5 ms-5">
<h3 class="text-center text-primary mt-5">REGISTRATION</h3>
<form  method="post" action="<?php echo base_url()?>main/registration" class=" ">

<fieldset>


<label class=>First Name:</label>
<input type="text" name="fname" placeholder="firstname" required maxlength="25" pattern="[a-zA-Z]+" class="form-control"><br>

<label class="">Last Name:</label>
<input type="text" name="lname"  placeholder="lastname" required maxlength="25" pattern="[a-zA-Z]+" class="form-control"><br>


<label class="form-label">Date of Birth:</label>
<input type="date" name="dob"  required class="form-control"><br>

<br>


<label class="form-label">Address:</label>
<textarea name="address"  required  class="form-control" placeholder="Address"></textarea><br>

<label class="form-label">District:</label>
<input list="district" name="district"  required class="form-control" placeholder="District">
<datalist id="district">
<option value="kollam">
<option value="Trivandrum">
<option value="kottayam">
<option value="Alapuzha">
<option value="Idukki">
</datalist><br>

<label class="form-label">PIN:</label>
<input type="text" name="pin"  required class="form-control"><br>
<br>
<label class="">Phone number:</label>
<input type="text" name="phno" placeholder="phoneno"  required  pattern="[7-9]{1}[0-9]{9}" class="form-control"  id="phno"><span id="phno_result"></span>
<br>
<label class="">UserName:</label>
<input type="text" name="uname" placeholder="UserName" required maxlength="25" pattern="[a-zA-Z]+" class="form-control" id="uname"><span id="uname_result"></span><br>

<label class="">Email:</label>
<input type="Email" name="email" placeholder="email" required class="form-control" id="email"><span id="email_result"></span><br>

<label class=" ">Password:</label>
<input type="Password" name="password" placeholder="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" class="form-control"><br>

<div class="container text-center">

<input type="submit" name="submit" value="Register" class="btn btn-primary w-50 mt-3  mb-3">
</div>


</fieldset>


</form>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>  
 $(document).ready(function(){  
      $('#email').change(function(){  
           var email = $('#email').val();  
           if(email != '')  
           {  
                $.ajax({  
                     url:"<?php echo base_url(); ?>main/email_availibility",  
                     method:"POST",  
                     data:{email:email},  
                     success:function(data){  
                          $('#email_result').html(data);  
                     }  
                });  
           }  
      });  

      $('#phno').change(function(){  
           var phno = $('#phno').val();  
           if(phno != '')  
           {  
                $.ajax({  
                     url:"<?php echo base_url(); ?>main/phno_availability",  
                     method:"POST",  
                     data:{phno:phno},  
                     success:function(data){  
                          $('#phno_result').html(data);  
                     }  
                });  
           }  
      });  
       $('#uname').change(function(){  
           var uname = $('#uname').val();  
           if(uname != '')  
           {  
                $.ajax({  
                     url:"<?php echo base_url(); ?>main/uname_availability",  
                     method:"POST",  
                     data:{uname:uname},  
                     success:function(data){  
                          $('#uname_result').html(data);  
                     }  
                });  
           }  
      });  
 });  
 </script>  
</div>

<div class="col-7">
</div>

</div class="">
</div>
</section >

</body>
</html>

