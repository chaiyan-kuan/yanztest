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
               
            <?php } else { ?>
                
            <?php }
              ?>

          </li>
        </ul>
            
      </div>  
    </nav>
    <div class="col-xl-9" style=" margin:auto; padding:15px ; height : 0px;">
     
                      
                      <?php echo form_open_multipart('index.php/products_control/actionquestion3'); ?>
                       <div class="container-fluid" style="background: url(<?php echo base_url();?>assets/image/2.png); width:auto ; height : 540px;">
                          <div class="modal-dialog">
                            <div class="modal-content" style="height: auto; width: 650px;margin-left: -100px">
                               <div class="modal-header">
                                  <h3><span class="badge badge-pill badge-light" style="font-family:'EucrosiaUPC';font-size: 35px">3.การใช้งานของผู้ใช้เน้นการใช้งานด้านใดเป็นพิเศษหรือไม่</span></h3>
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
                      <input type="radio"  name="type" value="1" id="radio1">
                      <label for="radio1">เล่นเกม<br></label>
                      </div>
                       <div class="funkyradio-success">
                      <input type="radio"  name="type" value="2" id="radio2">
                      <label for="radio2">มัลติมีเดีย<br></label>
                      </div>
                         <div class="funkyradio-success">
                      <input type="radio"  name="type" value="3" id="radio3">
                      <label for="radio3">งานออฟฟิต<br></label>
                        </div>
                        <div class="funkyradio-success">
                      <input type="radio"  name="type" value="4" id="radio4">
                      <label for="radio4">ดูหนัง/เก็บหนัง ฟังเพลง<br></label>
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
