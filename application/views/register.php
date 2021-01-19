<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?><!DOCTYPE html>
<html lang="en">
<?php
if (!isset($this->session->userdata['logged_in'])) {

 redirect('');
}
?>
<head>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
	<meta charset="utf-8">
	<title>Register</title>
</head>
<body>

		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <a class="navbar-brand" href="<?php echo base_url();?>">Home</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNavDropdown">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item active">
		        <a class="nav-link" href="<?php echo base_url(); ?>index.php/request/register">Register <span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="<?php echo base_url(); ?>index.php/showall">ShowAll</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="<?php echo base_url(); ?>index.php/request/login">Login</a>
		      </li>
		      <li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          Other
		        </a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<?php
							if (isset($this->session->userdata['logged_in'])) {
									$id = ($this->session->userdata['logged_in']['id']);?>
							 <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/request/showprofile/<?php echo $id ?>">Profile</a>
						<?php	} else { ?>
								<a class="dropdown-item disabled" href="<?php echo base_url(); ?>index.php/request/showprofile/">Profile</a>
						<?php }
							?>

		          <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/showall/testpage">Test</a>
		          <a class="dropdown-item" href="<?php echo base_url(); ?>index.php/request/sendemail">Send Email</a>
		        </div>
		      </li>
		    </ul>

		  </div>
		</nav>

	<style> body{ background: url(<?php echo base_url();?>assets/image/bg.jpg);
								background-size:100%;
								background-repeat: no-repeat;
								width: 100%; }
	</style>
	<center><?php echo $this->session->flashdata('message1');
								echo $this->session->flashdata('message2');

	unset($_SESSION['message1']);
	unset($_SESSION['message2']);
	echo validation_errors();
	?>
	<?php echo form_open_multipart('index.php/products_control/actionRegister', 'class="email" id="myform"'); ?>
  <fieldset>
    <legend>Register</legend>
		<div class="form-group">
      <label for="exampleInputEmail1">Username</label>
      <input type="text" name="username" class="form-control" id="username" placeholder="Username" required value="<?=set_value('username')?>">

    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>

    </div>
			<div class="form-group">
			<label for="exampleInputEmail1">Email address</label>
			<input type="text" name="email" class="form-control" id="email" placeholder="example@email.com" required value="<?=set_value('email')?>">

	</div>


		<div class="form-group">
			<label for="exampleInputEmail1">Firstname</label>
			<input type="text" name="firstname" class="form-control" id="firstname" placeholder="Firstname" required value="<?=set_value('firstname')?>" >

		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Lastname</label>
			<input type="text" name="lastname" class="form-control" id="lastname" placeholder="Lastname" required value="<?=set_value('lastname')?>">

		</div>

		<div class="form-group">
			<label for="exampleInputEmail1">Telephone Number</label>
			<input type="text" name="tel" maxlength="10" class="form-control" id="tel" placeholder="Telephone Number" required value="<?=set_value('tel')?>">

		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Address</label>
			<input type="text" name="address" class="form-control" id="address" placeholder="Address" required value="<?=set_value('address')?>">

		</div>


    <button type="submit" class="btn btn-primary" value = "Register">Submit</button>
  </fieldset>

<?php echo form_close(); ?>



</body>
</html>
