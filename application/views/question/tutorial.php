<?php //echo "<pre>";print_r($posts); exit();
defined('BASEPATH') OR exit('No direct script access allowed');
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ShowAllViews</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
  </head>
  <body>
    <style> body{ background: url(<?php echo base_url();?>assets/image/bg.jpg);
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
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo base_url(); ?>index.php/products_control/question1">Question<span class="sr-only">(current)</span></a>
          </li>
          
              <?php
              if (isset($this->session->userdata['logged_in'])) {
                  $id = ($this->session->userdata['logged_in']['id']);?>
               
            <?php } else { ?>
                
            <?php }
              ?>

          </li>
        </ul>
            
      </div>  
    </nav>
    <div class="col-xl-9" style="background-color: white ; margin:auto; padding:15px ; height : auto;">
    <a class = "btn btn-outline-danger" href="<?php echo base_url(); ?>index.php/products_control/receipt">Back to Result</a>
    <br>
    <br>
   
                      <center>
                      <table border="1">

                      <th>CPU</th>
                      <tr><td><img src = <?php echo base_url();?>assets/image/GuidePic/cpu.jpg height="500" width="700" id="img" data-toggle="modal" data-target="#myModal"></td>
                      <tr><th>GPU</th>
                      <tr><td><img src = <?php echo base_url();?>assets/image/GuidePic/gpu.jpg height="500" width="700" id="img1" data-toggle="modal1" data-target="#myModal1"></td>
                      <tr><th>Mainboard</th>
                      <tr><td><img src = <?php echo base_url();?>assets/image/GuidePic/mainboard.jpg height="500" width="700" id="img" data-toggle="modal" data-target="#myModal"></td>
                      <tr><th>Monitor</th>
                      <tr><td><img src = <?php echo base_url();?>assets/image/GuidePic/monitor.jpg height="500" width="700" id="img" data-toggle="modal" data-target="#myModal"></td>
   
                      <tr><th>SSD</th>
                      <tr><td><img src = <?php echo base_url();?>assets/image/GuidePic/ssd.jpg height="500" width="700" id="img" data-toggle="modal" data-target="#myModal"></td>
                      <tr><th>HDD</th>
                        <tr> <td><img src = <?php echo base_url();?>assets/image/GuidePic/hdd.jpg height="500" width="700" id="img" data-toggle="modal" data-target="#myModal"></td>
                      <tr><th>PSU</th>
                        <tr><td><img src = <?php echo base_url();?>assets/image/GuidePic/psu.jpg height="500" width="700" id="img" data-toggle="modal" data-target="#myModal"></td>
                      <tr><th>RAM</th>
                        <tr><td><img src = <?php echo base_url();?>assets/image/GuidePic/ram.jpg height="500" width="700" id="img" data-toggle="modal" data-target="#myModal"></td>

                      <tr><th>Cooler</th>
                      
                          <tr><td><img src = <?php echo base_url();?>assets/image/GuidePic/cooler.jpg height="500" width="700" id="img" data-toggle="modal" data-target="#myModal"></td>


                      </table>
                    </center>
<a class = "btn btn-outline-danger" href="<?php echo base_url(); ?>index.php/products_control/receipt">Back to Result</a>
  
</div>
</div>
</div>


  </body>
</html>
