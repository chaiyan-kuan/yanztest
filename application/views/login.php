<html>
<?php
if (isset($this->session->userdata['logged_in'])) {

redirect('');

 } ?>

<head>
<title>Login Form</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">


<body>
  <style> body{ background: url(<?php echo base_url();?>assets/image/bg.jpg);
                background-size:100%;
                background-repeat: no-repeat;
                width: 100%; }
  </style>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="<?php echo base_url();?>">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
      
      </ul>

    </div>
  </nav>
                  <center><h2>Login Form</h2>


              <?php echo form_open('index.php/products_control/actionLogin'); ?>
              <?php
                //print_r($error_message); exit();

                  echo $this->session->flashdata('message');

                  unset($_SESSION['message']);
                  ?>
                  <br>
              <label>Username </label>
              <input type="text" name="username" class="form-control" placeholder="Username" required/>
              <label>Password </label>
              <input type="password" name="password" class="form-control" placeholder="Password" required>
              <br>
              <input type="submit" class = "btn btn-outline-success" value=" Login " name="submit"/>
              
              <?php echo form_close(); ?>
             




</body>
</html>
