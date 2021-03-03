<!DOCTYPE html>
<html>
<head>
	<title>Admin book view</title>

	<meta charset=utf-8>
            <meta name="viewport" content="width=device-width,initial-scale=1">

             <!---Fontawesome--->
            <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
            <!---Bootstrap5----->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
            <!-----------custom style----------->
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('/css/index_style.css');?>" media="all"/>
  
</head>

<body>

<nav class="navbar top1 navbar-expand-lg menubar" >
    <div class="container">
      
      <div class="">
          <ul class="navbar-nav ">
            
              
              <li class="nav-item"><a href="<?php echo base_url()?>main/adminpages" class="nav-link">Back</a></li>
           <li class="nav-item"><a href="<?php echo base_url()?>main/logout" class="nav-link">Log Out </a></li>
          </ul>
      </div>
    </div> 
 </nav>


<section class="text-center py-5 ">

	<div class="container ">

	<table class="table">
	
	
	<form method="post" action="">
	<table style="background-color: white;">
		<tr>
			<td>First Name</td>
			<td>Last Name</td>
			<td>DOB</td>
			
			<td>Address</td>
			
			<td>District</td>
			<td>PIN</td>
			
			<td>Phone</td>
			
			<td>Email</td>
			<td>Approve</td>
			<td>Reject</td>
			<td>Delete</td>
			</tr>
			<?php
			if($n->num_rows()>0)
			{
				foreach($n->result() as $row)
				{
					?>
					<tr>
						<td><?php echo $row->fname;?></td>
						<td><?php echo $row->lname;?></td>
						<td><?php echo $row->dob;?></td>
						
						<td><?php echo $row->address;?></td>
						
						<td><?php echo $row->district;?></td>
						<td><?php echo $row->pin;?></td>
						
						<td><?php echo $row->phno;?></td>
						
						<td><?php echo $row->email;?></td>
						<?php
						if($row->status==1)
						{
							?>
							<td>approved</td>
							<td><a href="<?php echo base_url()?>main/reject/<?php echo $row->id;?>">Reject</a></td>
							<td><a href="<?php echo base_url()?>main/delete/<?php echo $row->id;?>">Delete</a></td>

							<?php
						}
						elseif($row->status==2)
						{
							?>
							<td>Rejected</td>
							<td><a href="<?php echo base_url()?>main/approve/<?php echo $row->id;?>">Approve
						</a>
						<td><a href="<?php echo base_url()?>main/delete/<?php echo $row->id;?>">Delete</a></td>
						</td>
							<?php
						}
						else
						{
							?>
		
						<td><a href="<?php echo base_url()?>main/approve/<?php echo $row->id;?>">Approve
						</a>
						</td>
						<td><a href="<?php echo base_url()?>main/reject/<?php echo $row->id;?>">Reject</a></td>
						<td><a href="<?php echo base_url()?>main/delete/<?php echo $row->id;?>">Delete</a></td>
						<?php
					}
					?>
				</tr>

						
					<?php
				}
			}
			
				?>
				

	</table>
</div>
</section>
</body>
</html>