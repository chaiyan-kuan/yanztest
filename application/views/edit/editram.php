<?php //echo "<pre>";print_r($posts); exit();
defined('BASEPATH') OR exit('No direct script access allowed');
 ?>

<html>
<head>
  <title>Edit by<?php ?></title>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
</head>
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
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url(); ?>index.php/products_control/showcpu">Show<span class="sr-only">(current)</span></a>
        </li>
       
      </ul>
            <form class="form-inline my-2 my-lg-0">
            
            <a style="margin-left:1.5em" class = "btn btn-outline-danger" href="<?php echo base_url(); ?>index.php/products_control/logout">logout</a>

            </form>
    </div>
  </nav>
<?php echo form_open_multipart('index.php/products_control/updateram'); ?>
<center> <?php echo validation_errors();
              echo $this->session->flashdata('message1');
              echo $this->session->flashdata('message2');

              unset($_SESSION['message1']);
              unset($_SESSION['message2']);
              ?>
  <div class="form-group">
    <?php foreach($ram as $key => $post){?>
    <input type="hidden" name="id" value ="<?php echo $post['id'] ; ?>">

    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" placeholder="name" value = "<?php echo $post['name'];?>" name = "name">

  </div>

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Type</label>
    <input type="text" class="form-control" placeholder="type" value = "<?php echo $post['type'];?>" name = "type">

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Capacity</label>
    <input type="text" class="form-control" placeholder="capacity" value = "<?php echo $post['capacity'];?>" name = "capacity">

  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">Bus</label>
    <input type="text" class="form-control" placeholder="bus" value = "<?php echo $post['bus'];?>" name = "bus">

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Level</label>
    <input type="text" class="form-control" placeholder="level" value = "<?php echo $post['level'];?>" name = "level">

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Price</label>
    <input type="text" class="form-control" placeholder="price" value = "<?php echo $post['price'];?>" name = "price">

  </div>

  <?php } ?>
  <br>
  <br>
  <button type="submit" class="btn btn-primary">Edit</button>
  <a class = "btn btn-outline-info" href="<?php echo base_url(); ?>index.php/ShowAll/">Back</a>


<?php echo form_close(); ?>
</body>
</html>
