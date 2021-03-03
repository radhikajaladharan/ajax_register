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

 <!--------------------menu section-------------->


 <nav class="navbar top1 navbar-expand-lg menubar" >
    <div class="container">
      
      <div class="">
          <ul class="navbar-nav ">
            <li class="nav-item text-white"><a href="<?php echo base_url()?>main/update_user" class="nav-link">Update</a>
                
              </li>

              
              <li class="nav-item text-white"><a href="<?php echo base_url()?>main/book" class="nav-link"></a></li>
           <li class="nav-item text-white"><a href="<?php echo base_url()?>main/logout" class="nav-link">Log Out </a></li>
          </ul>
      </div>
    </div> 
 </nav>

<!-----------------------------end-------------------->




</body>
</html>