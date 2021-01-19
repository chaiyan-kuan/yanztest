<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ShowAllViews</title>
    <!--script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script-->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/html2canvas.js"></script>
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



    
    <div id ="container" style="background-color: transparent; ">
      <div class="row">
        <div class="col-sm-2">
          <nav class="nav flex-column"  style="font-weight: bold; font-size: 14px">
            <a class="nav-link disabled" href="#">ข้อที่ 1 คุณเลือก 
              <?php if ($this->session->userdata('q1')=='1'){?>
                    เงินเดือน 15000-25000 บาท
             <?php }else if ($this->session->userdata('q1')=='2'){?>
                    เงินเดือน 25001-35000 บาท
             <?php }else if ($this->session->userdata('q1')=='3'){?>
                    เงินเดือน 35000 ขึ้นไป
              <?php }?>
            </a>
            <a class="nav-link disabled" href="#">ข้อที่ 2 คุณเลือก 
               <?php if ($this->session->userdata('q2')=='1'){?>
                    CPU ของ Intel
             <?php }else if ($this->session->userdata('q2')=='2'){?>
                    CPU ของ AMD
             <?php }else if ($this->session->userdata('q1')=='3'){?>
                    ไม่มี CPU ที่เลือก
              <?php }?>
            </a>
            <a class="nav-link disabled" href="#">ข้อที่ 3 คุณเลือก 
            <?php if ($this->session->userdata('q31')=='1'){?>
                    เล่นเกมแบบ AAA Grade Game
            <?php }else if ($this->session->userdata('q31')=='2'){?>
                    เล่นเกมแบบ MMORPG Online Game
            <?php }else if ($this->session->userdata('q31')=='3'){?>
                    เล่นเกมแบบ Casual Game
            <?php }else if ($this->session->userdata('q31')=='4'){?>
                    เล่นเกมแบบ Shooting Game
            <?php }else if ($this->session->userdata('q32')=='1'){?>
                    งานกราฟฟิค/3D
            <?php }else if ($this->session->userdata('q32')=='2'){?>
                    งานตัดต่อวิดีโอ
            <?php }else if ($this->session->userdata('q32')=='3'){?>
                    งานตัดต่อภาพนิ่ง
            <?php }else if ($this->session->userdata('q3')=='3'){?>
                    งานออฟฟิต
            <?php }else if ($this->session->userdata('q3')=='4'){?>
                    ดูหนังเก็บหนัง ฟังเพลง
            <?php } ?>

            </a>
            <a class="nav-link disabled" href="#">ข้อที่ 4 คุณเลือก
            <?php if ($this->session->userdata('q4')=='1'){?>
                    ใช้งานห้องแอร์
            <?php }else if ($this->session->userdata('q4')=='2'){?>
                    ไม่ได้ใช้งานห้องแอร์
            <?php }else if ($this->session->userdata('q4')=='3'){?>
                    เวลาที่ใช้งานในห้องแอร์เท่าๆกันกับไม่ได้ใช้งาน
            <?php } ?>
            </a>
            <a class="nav-link disabled" href="#">ข้อที่ 5 คุณเลือก
            <?php if ($this->session->userdata('q5')=='1'){?>
                    เวลาใช้งาน 1-4 ชั่วโมง
            <?php }else if ($this->session->userdata('q5')=='2'){?>
                    เวลาใช้งาน 5-9 ชั่วโมง
            <?php }else if ($this->session->userdata('q5')=='3'){?>
                    เวลาใช้งาน 10-15 ชั่วโมง
            <?php }else if ($this->session->userdata('q5')=='4'){?>
                    เวลาใช้งานมากกว่า 15 ชั่วโมง
            <?php } ?>
            </a>
            <a class="nav-link disabled" href="#">ข้อที่ 6 คุณเลือก
            <?php if ($this->session->userdata('q6')=='1'){?>
                    ให้ระบบแนะนำจอมอนิเตอร์ให้
            <?php }else if ($this->session->userdata('q6')=='2'){?>
                    ไม่ให้ระบบแนะนำจอมอนิเตอร์
            <?php } ?>
            </a>
            <a class="nav-link disabled" href="#">ข้อที่ 7 คุณเลือก
            <?php if ($this->session->userdata('q7')=='1'){?>
                    ต้องการใช้งาน Wi-Fi
            <?php }else if ($this->session->userdata('q7')=='2'){?>
                    ไม่ต้องการใช้งาน Wi-Fi
            <?php } ?>
            </a>
            
          </nav>
        </div>
    <div class="col-xl-9" style="background-color: white ; margin:auto; padding:15px ; height : auto;">
     
      

<center>




<div class="alert alert-light" role="alert">
<div class="table-responsive">
  <div id="content">
    <table class="table table-sm" border ="1">
      <thead>
     <tr>
      <td><strong>Type</strong></td>
      
      <td><strong>Name</strong></td>
      <td><strong>Socket</strong></td>
      <td><strong>Core</strong></td>
      <td><strong>Thread</strong></td>
      <td><strong>Frequency</strong></td>
      <td><strong>Price</strong></td>
    
 </tr></thead>
     <?php foreach($cpu as $key => $post){?>
     <tr>
         <th>CPU
         
         <td><?php echo $post['name'];?></td>
         <td><?php echo $post['socket'];?></td>
         <td><?php echo $post['core'];?></td>
         <td><?php echo $post['thread'];?></td>
         <td><?php echo $post['frequency'];?></td>
         <td><?php echo $post['price'];?></td>

         
    </th>
    </tr>
</table>
    <?php }?>
    <table class="table table-sm" border ="1">
      <thead>
     <tr>
      <td><strong>Type</strong></td>
      
      <td><strong>Name</strong></td>
      <td><strong>Model</strong></td>
      <td><strong>Power Usage</strong></td>
      <td><strong>VGA</strong></td>
      <td><strong>DVI</strong></td>
      <td><strong>DisplayPort</strong></td>
      <td><strong>HDMI</strong></td>
      <td><strong>Price</strong></td>
    </tr></thead>
     <?php foreach($gpu as $key => $post){?>
     <tr>
         <th>GPU
         
         <td><?php echo $post['name'];?></td>
         <td><?php echo $post['model'];?></td>
         <td><?php echo $post['powerusage'];?></td>
         <td><?php echo $post['VGA'];?></td>
         <td><?php echo $post['DVI'];?></td>
         <td><?php echo $post['DisplayPort'];?></td>
         <td><?php echo $post['HDMI'];?></td>
         <td><?php echo $post['price'];?></td>

         
       </th>
     </tr>
  </table>
    <?php }?>
    <table class="table table-sm" border ="1">
      <thead>
     <tr>
      <td><strong>Type</strong></td>
      
      <td><strong>Name</strong></td>
      <td><strong>Socket</strong></td>
      <td><strong>Chipset</strong></td>
      <td><strong>Max Ram</strong></td>
      <td><strong>WI-FI</strong></td>
      <td><strong>Price</strong></td>

    </tr></thead>
    <?php foreach($mainboard as $key => $post){?>
     <tr>
         <th>Mainboard
         
         <td><?php echo $post['name'];?></td>
         <td><?php echo $post['socket'];?></td>
         <td><?php echo $post['chipset'];?></td>
         <td><?php echo $post['ram'];?></td>
         <td><?php echo $post['WIFI'];?></td>
         <td><?php echo $post['price'];?></td>

         </th>
       </tr>
     </table>

    <?php }?>
    <table class="table table-sm" border ="1">
      <thead>
     <tr>
      <td><strong>Type</strong></td>
      
      <td><strong>Name</strong></td>
      <td><strong>Capacity</strong></td>
      <td><strong>Price</strong></td>
    </tr></thead>
    <?php foreach($hdd as $key => $post){?>
     <tr>
         <th>HDD
         
         <td><?php echo $post['name'];?></td>
         <td><?php echo $post['capacity'];?></td>
         <td><?php echo $post['price'];?></td>

         </th>
       </tr>
     </table>

    <?php }?>
    <table class="table table-sm" border ="1">
      <thead>
     <tr>
      <td><strong>Type</strong></td>
      
      <td><strong>Name</strong></td>
      <td><strong>Capacity</strong></td>
      <td><strong>Price</strong></td>
    </tr></thead>
    <?php foreach($ssd as $key => $post){?>
     <tr>
         <th>SSD
         
         <td><?php echo $post['name'];?></td>
         <td><?php echo $post['capacity'];?></td>
         <td><?php echo $post['price'];?></td>

         </th>
       </tr>
     </table>

    <?php }?>
    <table class="table table-sm" border ="1">
      <thead>
     <tr>
      <td><strong>Type</strong></td>
      
      <td><strong>Name</strong></td>
      <td><strong>Maximum Power</strong></td>
      <td><strong>Price</strong></td>
    </tr></thead>
    <?php foreach($psu as $key => $post){?>
     <tr>
         <th>PSU
         
         <td><?php echo $post['name'];?></td>
         <td><?php echo $post['power'];?></td>
         <td><?php echo $post['price'];?></td>

         
       </th>
     </tr>
   </table>
    <?php }?>
     <?php if($this->session->userdata('nomonitor')!='NO'){?>
    <table class="table table-sm" border ="1">
      <thead>
     <tr>
      <td><strong>Type</strong></td>
      
      <td><strong>Name</strong></td>
       <td><strong>Size</strong></td>
      <td><strong>Panel</strong></td>
      <td><strong>Refreshrate</strong></td>
      <td><strong>Resolution</strong></td>
      <td><strong>VGA</strong></td>
      <td><strong>DVI</strong></td>
      <td><strong>DisplayPort</strong></td>
      <td><strong>HDMI</strong></td>
      <td><strong>Price</strong></td>
    </tr></thead>
    <?php foreach($monitor as $key => $post){?>
     <tr>
         <th>Monitor
         
         <td><?php echo $post['name'];?></td>
         <td><?php echo $post['size'];?></td>
         <td><?php echo $post['panel'];?></td>
         <td><?php echo $post['refreshrate'];?></td>
         <td><?php echo $post['resolution'];?></td>
         <td><?php echo $post['VGA'];?></td>
         <td><?php echo $post['DVI'];?></td>
         <td><?php echo $post['DisplayPort'];?></td>
         <td><?php echo $post['HDMI'];?></td>
         <td><?php echo $post['price'];?></td>

         </th>
       </tr>
     </table>

    <?php }
    }?>
    <table class="table table-sm" border ="1">
      <thead>
     <tr>
      <td><strong>Type</strong></td>
      
      <td><strong>Name</strong></td>
      <td><strong>Type</strong></td>
      <td><strong>Capacity</strong></td>
      <td><strong>Price</strong></td>
    </tr></thead>
    <?php foreach($ram as $key => $post){?>
     <tr>
         <th>RAM
         
         <td><?php echo $post['name'];?></td>
         <td><?php echo $post['type'];?></td>
         <td><?php echo $post['capacity'];?></td>
         <td><?php echo $post['price'];?></td>

         </th>
       </tr>
     </table>

    <?php }?>
    <table class="table table-sm" border ="1">
      <thead>
     <tr>
      <td><strong>Type</strong></td>
      
      <td><strong>Name</strong></td>
      <td><strong>Type</strong></td>
      <td><strong>Price</strong></td>
    </tr></thead>
    <?php foreach($cooler as $key => $post){?>
     <tr>
         <th>Cooler
         
         <td><?php echo $post['name'];?></td>
         <td><?php echo $post['type'];?></td>
         <td><?php echo $post['price'];?></td>

         </th>
       </tr>
     </table>

    <?php }?>
    <table class="table table-sm" border ="1">
     
    <?php ?>
     <tr>
         <th>Total
         
         <td><?php?></td>
         <td><?php echo $result ?></td>

       </th>
     </tr>

  </td>
</table>
</div>
</div>
</div>
 <button id="download" class = "btn btn-outline-danger">Save Image</button>
 <a class = "btn btn-outline-info" href="<?php echo base_url(); ?>index.php/products_control/tutorial">Tutorial</a>



</div>

        



</center>

</div>
</div>

<script type="text/javascript">

    document.getElementById("download").addEventListener("click", function() {


    html2canvas(document.querySelector('#content'),
      {width: 1920, height: 1080}).then(function(canvas) {
        
        console.log(canvas);
        saveAs(canvas.toDataURL(), 'file-name.jpg');
        });
    });


    function saveAs(uri, filename) {

        var link = document.createElement('a');

        if (typeof link.download === 'string') {

            link.href = uri;
            link.download = filename;

            //Firefox requires the link to be in the body
            document.body.appendChild(link);

            //simulate click
            link.click();

            //remove the link when done
            document.body.removeChild(link);

        } else {

            window.open(uri);

        }
    }
</script>

</body>
</html>
