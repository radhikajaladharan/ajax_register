<!DOCTYPE html>
<html>
    <head>
        <title>Admin Home</title>
            <meta charset=utf-8>
            <meta name="viewport" content="width=device-width,initial-scale=1">
            <!---Fontawesome--->
            <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
            <!---Bootstrap5----->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
            <!------custom style------->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/index_style.css');?>" media="all"/>

  <style >
    .bi{
      background-image: url("../img/im3.png");
      background-size: cover; 
      background-attachment: fixed;
    }
  </style>

    </head>
  <body class="overhidden">
    <header>
        <nav>
            <div class="container-fluid top ">
                <div class="row">
                    <div class="col-7">
                        <a href="#" class="text-decoration-none text-white">Home Terms</a>
                    </div>
                <div class="col-5 text-end">
                    <i class="fab fa-facebook text-white "></i>
                    <i class="fab fa-instagram text-white "></i>
                    <i class="fab fa-linkedin text-white "></i>
                    <i class="fab fa-twitter text-white "></i>
                    <i class="fab fa-youtube text-white "></i>
                    <i class="fab fa-google text-white "></i>
                </div>
            </div>
        </div>
     </nav>  
 </header>
 <!--------------------menu section-------------->
 <nav class="navbar top1 navbar-expand-lg menubar" >
    <div class="container">
      <a href="#" class="text-decoration-none text-primary">TRAVEL KITE</a>  
      <div class="">
          <ul class="navbar-nav ">
              <li class="nav-item"><a href="<?php echo base_url()?>main/admin" class="nav-link">Home</a></li> 

              <li class="nav-item"><a href="<?php echo base_url()?>main/airport" class="nav-link">Airport</a></li>

              <li class="nav-item"><a href="#" class="nav-link">Flight</a>
                <ul class="submenu ">

                  <li class="nav-item "><a href="<?php echo base_url()?>main/flightreg" class="nav-link">Add</a></li>
                  
                  <li class="nav-item"><a href="<?php echo base_url()?>main/flights" class="nav-link">View</a></li>

                </ul>
              </li>

              <li class="nav-item"><a href="#" class="nav-link"> Notification</a>
                <ul class="submenu">

                  <li class="nav-item"><a href="<?php echo base_url()?>main/notification" class="nav-link">Add</a></li>
                  <li class="nav-item"><a href="<?php echo base_url()?>main/notiadmin" class="nav-link">View</a></li>

                </ul>
              </li>

              <li class="nav-item"><a href="<?php echo base_url()?>main/book" class="nav-link">Booking</a></li>
              <li class="nav-item"><a href="<?php echo base_url()?>main/discount" class="nav-link">Flight Discount</a></li>
           <li class="nav-item"><a href="<?php echo base_url()?>main/logout" class="nav-link">Log Out </a></li>
          </ul>
      </div>
    </div> 
 </nav>
<!-----------------------------end-------------------->
<section class="bi vh-100">
  

</section>



</body>
</html>