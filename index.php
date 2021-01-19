<!DOCTYPE html>
<html>
<head>
	<title>จัดรายการอุปกรณ์คอมพิวเตอร์</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/custom.css">


</head>
<body>

	<style> body{ background: url(<?php echo base_url();?>assets/image/bghome.jpg);
								background-size:100%;
								background-repeat: no-repeat;
								width: 100%; }



	</style>
	<?php
	if (isset($this->session->userdata['logged_in'])) { ?>
  								<div class = "bb2">
									<a href="<?php echo base_url(); ?>index.php/products_control/showcpu" class="btn btn-outline-dark">Show Product</a>
									<br><a type=button  class="btn btn-outline-dark" href="<?php echo base_url(); ?>index.php/products_control/register">Sign Up</a>
								</div>
  					<?php } else { ?>
  							<div class = "bb2">
								<a href="<?php echo base_url(); ?>index.php/products_control/login" class="btn btn-outline-light">Login Admin</a>
							</div>
  					<?php } ?>
	
	<center>
	
		<div class = "bb1">
		<a href="<?php echo base_url(); ?>index.php/products_control/question1">

				<img src="<?php echo base_url();?>assets/image/b1.png" 
							onmouseover="this.src='<?php echo base_url();?>assets/image/b22.png'"
							onmouseout="this.src='<?php echo base_url();?>assets/image/b1.png'"
							onmousedown="this.src='<?php echo base_url();?>assets/image/b3.png'"
							border="0" alt="" ></a>

			</a>
		</div>


</body>
</html>
