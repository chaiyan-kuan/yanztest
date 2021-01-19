<?php //echo "<pre>";print_r($posts); exit();
defined('BASEPATH') OR exit('No direct script access allowed');
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Question1</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/custom.css">
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
  						 
  					<?php	} else { ?>
  							
  					<?php }
  						?>

          </li>
        </ul>
             <form class="form-inline my-2 my-lg-0">
              <!--<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">-->
              <!--<a class="btn btn-outline-success my-2 my-sm-0" href="<?php echo base_url(); ?>index.php/request/showprofile/<?php echo $id ?>">Profile</a>-->
              <?php if(isset($this->session->userdata['logged_in'])) { ?>
                  <a style="margin-left:1.5em" class = "btn btn-outline-danger" href="<?php echo base_url(); ?>index.php/products_control/logout">logout</a>
              <?php }?>
              </form>
      </div>  
    </nav>
    <div class="col-xl-9" style=" margin:auto; padding:15px ; height : auto;">
     
        
                      <?php echo form_open_multipart('index.php/products_control/actionquestion1'); ?>
                      

                      
                      <div class="container-fluid" style="background: url(<?php echo base_url();?>assets/image/2.png);">
                          <div class="modal-dialog">
                            <div class="modal-content" style="height: auto; width: 600px;margin-left: -70px">
                               <div class="modal-header">
                                  <h3><span class="badge badge-pill badge-light" style="font-family:'EucrosiaUPC';font-size: 40px">1.คุณมีรายได้ต่อเดือนเท่าไหร</span></h3>

                                

                              </div>
                              <div class="modal-body">
                                  <div class="col-xs-3 col-xs-offset-5">
                                     <div id="loadbar" style="display: none;">
                                        
                                        
                                    </div>
                                </div>

                       
                      <div class="funkyradio">
                          <?php //echo validation_errors(); 
                                        echo $this->session->flashdata('message1');

                                        unset($_SESSION['message1']);?>
                      <div class="funkyradio-success">
                      <input type="radio"  name="salary" value="1" id="radio1">
                      <label for="radio1">15000-25000<br></label>
                      </div>
                       <div class="funkyradio-success">
                      <input type="radio"  name="salary" value="2" id="radio2">
                      <label for="radio2">25001-35000<br></label>
                      </div>
                         <div class="funkyradio-success">
                      <input type="radio"  name="salary" value="3" id="radio3">
                      <label for="radio3">35000 ขึ้นไป<br></label>
                        </div>
                      
 
                      </div>

                      <br>
                      <center><button type="submit" class="btn btn-outline-success" value = "Submit">Next</button></center>
                      <br>


                      <?php echo form_close(); ?>


  
</div>
</div>
</div>


  </body>
</html>
