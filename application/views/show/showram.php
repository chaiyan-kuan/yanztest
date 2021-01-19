<?php //echo "<pre>";print_r($posts); exit();
defined('BASEPATH') OR exit('No direct script access allowed');
echo validation_errors(); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ShowAllViews</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
  </head>
  <body>
    <style> body{ background: url(<?php echo base_url();?>assets/image/bghome.jpg);
  								background-size:100%;
  								background-repeat: no-repeat;
                  background-attachment: fixed;
  								width: 100%; }
  	</style>

    <div class="sticky-top"><nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="<?php echo base_url();?>">Home</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto">
           <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url(); ?>index.php/products_control/addcpu">Add<span class="sr-only">(current)</span></a>
          </li>
          
        </ul>
             <form class="form-inline my-2 my-lg-0">
              <!--<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">-->
              <!--<a class="btn btn-outline-success my-2 my-sm-0" href="<?php echo base_url(); ?>index.php/request/showprofile/<?php echo $id ?>">Profile</a>-->
              <a style="margin-left:1.5em" class = "btn btn-outline-danger" href="<?php echo base_url(); ?>index.php/products_control/logout">logout</a>

              </form>
      </div>  
    </nav>
    <div class="col-xl-9" style="background-color: white ; margin:auto; padding:15px ; height : auto;">
     
        
          <ul class="pagination1">
           <li class="page-item"><a class = "page-link" href="<?php echo base_url(); ?>index.php/products_control/showcpu/<?php ?>">CPU</a></li>       
            <li class="page-item"><a class = "page-link" href="<?php echo base_url(); ?>index.php/products_control/showgpu/<?php ?>">GPU</a></li>
            <li class="page-item"><a class = "page-link" href="<?php echo base_url(); ?>index.php/products_control/showmainboard/<?php ?>">Mainboard</a></li>
            <li class="page-item active" aria-current="page">
              <span class="page-link">
                RAM
                <span class="sr-only">(current)</span>
              </span>
            </li>                   
            
            <li class="page-item"><a class = "page-link" href="<?php echo base_url(); ?>index.php/products_control/showssd/<?php ?>">SSD</a></li>
            <li class="page-item"><a class = "page-link" href="<?php echo base_url(); ?>index.php/products_control/showhdd/<?php ?>">HDD</a></li>
            <li class="page-item"><a class = "page-link" href="<?php echo base_url(); ?>index.php/products_control/showmonitor/<?php ?>">Monitor</a></li>
            <li class="page-item"><a class = "page-link" href="<?php echo base_url(); ?>index.php/products_control/showpsu/<?php ?>">PSU</a></li>
            <li class="page-item"><a class = "page-link" href="<?php echo base_url(); ?>index.php/products_control/showcooler/<?php ?>">Cooler</a></li>
          </ul>
      
      

<center>

<div class="alert alert-primary" role="alert">
<div class="table-responsive">
    <table class="table table-hover table-dark" border ="1">
      <thead>
     <tr>
      <td><strong>Id</strong></td>
      <td><strong>Name</strong></td>
      <td><strong>Type</strong></td>
      <td><strong>Capacity</strong></td>
      <td><strong>Bus</strong></td>
      <td><strong>Price</strong></td>
      <td><strong>Level</strong></td>
      
 </tr></thead>
     <?php foreach($ram as $key => $post){?>
     <tr>
         <th><?php echo $post['id'];?></td>
         <td><?php echo $post['name'];?></td>
         <td><?php echo $post['type'];?></td>
         <td><?php echo $post['capacity'];?></td>
         <td><?php echo $post['bus'];?></td>
         <td><?php echo $post['price'];?></td>
         <td><?php echo $post['level'];?></td>
         
         
         
         <td><center><a class = "btn btn-outline-info" href="<?php echo base_url(); ?>index.php/products_control/editram/<?php echo $post['id']; ?>">Edit</a></td>
         <td><center><a class = "btn btn-danger" href="<?php echo base_url(); ?>index.php/products_control/deleteram/<?php echo $post['id']; ?>">Delete</a></td>

    <?php }?>

  </td>
</table></div></div>





  
</div>
</div>
</div>


  </body>
</html>
