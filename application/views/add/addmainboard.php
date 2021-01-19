<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?><!DOCTYPE html>
<html lang="en">
<?php
//if (isset($this->session->userdata['logged_in'])) {

// redirect('');
//}
?>
<head>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
	<meta charset="utf-8">
	<title>Add Mainboard</title>
</head>
<body>

		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <a class="navbar-brand" href="<?php echo base_url();?>">Home</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
			</nav>

	<style> 
		body{ background: url(<?php echo base_url();?>assets/image/bg.jpg);
								background-size:100%;
								background-repeat: no-repeat;
                background-attachment: fixed;
								width: 100%; }
	</style>


<div class="container">
  <div class="row">
    <div class="col-xl-9" style="background-color: white ; margin:auto; padding:15px ; height : auto;">
    	<center>
    		<nav aria-label="...">
				  <ul class="pagination pagination-lg">
				  	<li class="page-item"><a class = "page-link" href="<?php echo base_url(); ?>index.php/products_control/addcpu/<?php ?>">CPU</a></li>		  	
				    <li class="page-item"><a class = "page-link" href="<?php echo base_url(); ?>index.php/products_control/addgpu/<?php ?>">GPU</a></li>
				    <li class="page-item active" aria-current="page">
				      <span class="page-link">
				        Mainboard
				        <span class="sr-only">(current)</span>
				      </span>
				    </li>				    				
				    <li class="page-item"><a class = "page-link" href="<?php echo base_url(); ?>index.php/products_control/addram/<?php ?>">RAM</a></li>
				    <li class="page-item"><a class = "page-link" href="<?php echo base_url(); ?>index.php/products_control/addssd/<?php ?>">SSD</a></li>
				    <li class="page-item"><a class = "page-link" href="<?php echo base_url(); ?>index.php/products_control/addhdd/<?php ?>">HDD</a></li>
				    <li class="page-item"><a class = "page-link" href="<?php echo base_url(); ?>index.php/products_control/addmonitor/<?php ?>">Monitor</a></li>
				    <li class="page-item"><a class = "page-link" href="<?php echo base_url(); ?>index.php/products_control/addpsu/<?php ?>">PSU</a></li>
				    <li class="page-item"><a class = "page-link" href="<?php echo base_url(); ?>index.php/products_control/addcooler/<?php ?>">Cooler</a></li>
				  </ul>
			</nav>
    	</center>
        	<div class="col-8 col-xl-6" style="background-color:LightGrey; margin: auto ;padding: 15px;width : 500px ; height : auto;">
	          <center><?php echo $this->session->flashdata('message1');
	        				echo $this->session->flashdata('message2');

			        	unset($_SESSION['message1']);
			        	unset($_SESSION['message2']);
			        	echo validation_errors();
			        	?>
	        		
	        	</center>

        	<?php echo form_open_multipart('index.php/products_control/actionaddmainboard', 'class="email" id="myform"'); ?>
           <fieldset>
            <legend>Add Product Mainboard</legend>
        		<div class="form-group">
              <label>Name</label>
              <input type="text" style = "width : 100%;" name="name" class="form-control" id="name" placeholder="Name" required value="<?=set_value('name')?>">

              <label>Model</label>
              <input type="text" style = "width : 100%;" name="model" class="form-control" id="model" placeholder="Model" required value="<?=set_value('model')?>">

              <label>Socket</label>
              <input type="text" style = "width : 100%;" name="socket" class="form-control" id="socket" placeholder="Socket" required value="<?=set_value('socket')?>">

              <label>Chipset</label>
              <input type="text" style = "width : 100%;" name="chipset" class="form-control" id="chipset" placeholder="Chipset" required value="<?=set_value('chipset')?>">

              <label>Max Ram Capasity</label>
              <input type="text" style = "width : 100%;" name="ram" class="form-control" id="ram" placeholder="Max Ram Capasity" required value="<?=set_value('ram')?>">

              <label>Price</label>
              <input type="text" style = "width : 100%;" name="price" class="form-control" id="price" placeholder="Price" required value="<?=set_value('price')?>">
              <label>Level</label>
               <br>
              <select name="level">  
              		  <option name="level" value="0">Plese Select Level</option> 
					  <option name="level" value="5">5</option> 
					  <option name="level" value="4">4</option>  
					  <option name="level" value="3">3</option>  
					  <option name="level" value="2">2</option>  
					  <option name="level" value="1">1</option>  
					 
			  </select>   
			  <br>
			  <br>
              <label>Genre</label>
              <br>
              <input type="checkbox" name="gaming" value="gaming"> Gaming<br><br>
			  <input type="checkbox" name="multimedia" value="multimedia"> Multimedia<br><br>
			  <input type="checkbox" name="office" value="office"> Office<br><br>

			  <label>WIFI</label>
              <br>
			   <select name="WIFI"> 
              		  <option name="WIFI" value="0">Plese Select</option> 
					  <option name="WIFI" value="NO">NO</option>  
					  <option name="WIFI" value="YES">YES</option>  
					 
			  </select>  

            </div>
      
           
            <button type="submit" class="btn btn-primary" value = "Register">Submit</button>
            <a class = "btn btn-outline-info" href="<?php echo base_url(); ?>index.php/products_control/showmainboard">Back</a>
          </fieldset>

        <?php echo form_close(); ?>
        </div>

    </div>
  </div>
</div>


</body>
</html>
