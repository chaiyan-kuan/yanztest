<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model', 'product');
    }
  // Dashboard
    public function index()
    {
          $posts = $this->Product_model->getCPU();
          $arr['posts'] = $posts;
          $this->load->view('index',$arr);
    }
    public function register(){
          $this->load->view('register');
    }
   
    public function actionLogin(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

          if($this->form_validation->run()==FALSE){
            if(isset($this->session->userdata['logged_in'])){
              $this->load->view('showAllViews');
            }
          }else {
                  $username = $this->input->post('username');
                  $password = $this->input->post('password');

          $result = $this->Product_model->login_user($username,$password);
          //echo "<pre>";print_r($result); exit();
            if($result){
              $result =$this->Product_model->getUserByUsername($username);
              //echo "<pre>";print_r($result); exit();
              //echo "<pre>";print_r($result[0]['username']); exit();
              if($result!=false){
                $session_data = array(
                  'id' => $result[0]['id'],
                  'username' => $result[0]['username'],
                  'email' => $result[0]['email'],
                  'images' => $result[0]['images'],
                  'role' => $result[0]['role'],
                );
                //add user data in Session
                $this->session->set_userdata('logged_in',$session_data);
                $posts = $this->Product_model->getUserbyUsername($username);
                //print_r($posts); exit();
                $arr['posts'] = $posts;
                redirect('');
              }

            } else {
              $this->session->set_flashdata('message','Invalid Username or Password');
                //echo "<pre>";print_r($data); exit();
                redirect('index.php/products_control/login');
              //$this->load->view('login');

              }
            }
    }
    public function deletecpu($id){
             $this->Product_model->delete_cpu($id);
             redirect('index.php/products_control/showcpu');
    }
     public function deletegpu($id){
             $this->Product_model->delete_gpu($id);
             redirect('index.php/products_control/showgpu');
    }
     public function deleteram($id){
             $this->Product_model->delete_ram($id);
             redirect('index.php/products_control/showram');
    }
     public function deletemainboard($id){
             $this->Product_model->delete_mainboard($id);
             redirect('index.php/products_control/showmainboard');
    }
     public function deletessd($id){
             $this->Product_model->delete_ssd($id);
             redirect('index.php/products_control/showssd');
    }
     public function deletehdd($id){
             $this->Product_model->delete_hdd($id);
             redirect('index.php/products_control/showhdd');
    }
     public function deletepsu($id){
             $this->Product_model->delete_psu($id);
             redirect('index.php/products_control/showpsu');
    }
     public function deletemonitor($id){
             $this->Product_model->delete_monitor($id);
             redirect('index.php/products_control/showmonitor');
    }
     public function deletecooler($id){
             $this->Product_model->delete_cooler($id);
             redirect('index.php/products_control/showcooler');
    }
    public function logout() {

        // Removing session data
          $this->session->set_flashdata('message','Successfully Logout');
          $this->session->unset_userdata('logged_in', $sess_array);
          // $data['message_display'] = 'Successfully Logout';
          // $this->load->view('login', $data);
          redirect('index.php/products_control/login');
    }
    public function login(){
         $this->load->view('login');
    }
    public function receipt(){
          $cpu = $this->session->userdata['cpu'];
          $arr['cpu']= $this->Product_model->getID_CPU($cpu);

          $price_cpu = $arr['cpu'][0]['price'];

          $gpu = $this->session->userdata['gpu'];
          $arr['gpu']= $this->Product_model->getID_GPU($gpu);

          $price_gpu = $arr['gpu'][0]['price'];

          $hdd = $this->session->userdata['hdd'];
          $arr['hdd']= $this->Product_model->getID_HDD($hdd);

          $price_hdd = $arr['hdd'][0]['price'];

          $mainboard = $this->session->userdata['mainboard'];
          $arr['mainboard']= $this->Product_model->getID_MB($mainboard);

          $price_mainboard = $arr['mainboard'][0]['price'];

          $ssd = $this->session->userdata['ssd'];
          $arr['ssd']= $this->Product_model->getID_SSD($ssd);

          $price_ssd = $arr['ssd'][0]['price'];

          $monitor = $this->session->userdata['monitor'];
          $arr['monitor']= $this->Product_model->getID_Monitor($monitor);

          $price_monitor = $arr['monitor'][0]['price'];

          $psu = $this->session->userdata['psu'];
          $arr['psu']= $this->Product_model->getID_PSU($psu);

          $price_psu = $arr['psu'][0]['price'];

          $ram = $this->session->userdata['ram'];
          $arr['ram']= $this->Product_model->getID_RAM($ram);

          $price_ram = $arr['ram'][0]['price'];

          $cooler = $this->session->userdata['cooler'];
          $arr['cooler']= $this->Product_model->getID_Cooler($cooler);

          $price_cooler = $arr['cooler'][0]['price'];

          $total = $price_cpu + $price_gpu + $price_hdd + $price_mainboard + $price_ssd + $price_monitor + $price_psu + $price_ram + $price_cooler;
          $arr['result'] = $total;

          $this->load->view('question/receipt_view',$arr);        
    }
    public function addcpu(){
          $this->load->view('add/addcpu');
    }
    public function addgpu(){
          $this->load->view('add/addgpu');
    }
    public function addmainboard(){
          $this->load->view('add/addmainboard');
    }
    public function addram(){
          $this->load->view('add/addram');
    }
    public function addssd(){
          $this->load->view('add/addssd');
    }
    public function addhdd(){
          $this->load->view('add/addhdd');
    }
    public function addmonitor(){
          $this->load->view('add/addmonitor');
    }
    public function addpsu(){
          $this->load->view('add/addpsu');
    }
    public function addcooler(){
          $this->load->view('add/addcooler');
    }

    public function actionaddcpu(){
          $this->load->library('form_validation');
          $this->form_validation->set_rules('name', 'Name Product', 'trim|required|min_length[4]|max_length[32]');
          $this->form_validation->set_rules('socket', 'Socket', 'trim|required|min_length[4]|max_length[32]');
          $this->form_validation->set_rules('core', 'Core', 'required|min_length[1]|max_length[2]');
          $this->form_validation->set_rules('thread', 'Thread', 'trim|required|min_length[1]|max_length[2]');
          $this->form_validation->set_rules('frequency', 'Frequency', 'trim|required|min_length[4]|max_length[4]');
          $this->form_validation->set_rules('price', 'Price', 'trim|required|min_length[3]|max_length[6]');
          $this->form_validation->set_rules('level', 'Level', 'trim|required|min_length[1]|max_length[1]|greater_than[0]');     
          if($this->form_validation->run() == FALSE) {
            $this->addcpu();
          } else {
          $name = $this->input->post('name');
          $socket = $this->input->post('socket');
          $core = $this->input->post('core');
          $thread = $this->input->post('thread');
          $frequency = $this->input->post('frequency');
          $price = $this->input->post('price');
          $level = $this->input->post('level');
          $gaming = $this->input->post('gaming');
          $multimedia = $this->input->post('multimedia');
          $office = $this->input->post('office');
           if($gaming == 'gaming'){
             $gaming = 'YES';
          }else{
            $gaming = 'NO';
          }
          if($multimedia == 'multimedia'){
            $multimedia = 'YES';
          }else{
            $multimedia = 'NO';
          }
          if($office == 'office'){
            $office = 'YES';
          }else{
            $office = 'NO';
          }          
            $data = array(
              'name' => $name,
              'socket' => $socket,
              'core' => $core,
              'thread' => $thread,
              'frequency' => $frequency,
              'price' => $price,
              'level' => $level,
              'gaming' => $gaming,
              'multimedia' => $multimedia,
              'office' => $office,
            );
            $this->product->createCPU($data);
            redirect('index.php/products_control/showcpu');
              }
      }
    public function actionaddgpu(){
          $this->load->library('form_validation');
          $this->form_validation->set_rules('name', 'Name Product', 'trim|required|min_length[4]|max_length[32]');
          $this->form_validation->set_rules('model', 'Model', 'trim|required|min_length[4]|max_length[32]');
          $this->form_validation->set_rules('powerusage', 'Powerusage', 'required');
          $this->form_validation->set_rules('price', 'Price', 'trim|required|min_length[3]|max_length[256]');
          $this->form_validation->set_rules('level', 'Level', 'trim|required|min_length[1]|max_length[1]|greater_than[0]');



          if($this->form_validation->run() == FALSE) {
            $this->addgpu();
            //redirect('index.php/request/register');
          } else {

          $name = $this->input->post('name');
          $model = $this->input->post('model');
          $powerusage = $this->input->post('powerusage');
          $HDMI = $this->input->post('HDMI');
          $DP = $this->input->post('DP');
          $DVI = $this->input->post('DVI');
          $VGA = $this->input->post('VGA');
          $price = $this->input->post('price');
          $level = $this->input->post('level');
          $gaming = $this->input->post('gaming');
          $multimedia = $this->input->post('multimedia');
          $office = $this->input->post('office');


           if($gaming == 'gaming'){
             $gaming = 'YES';
          }else{
            $gaming = 'NO';
          }
          if($multimedia == 'multimedia'){
            $multimedia = 'YES';
          }else{
            $multimedia = 'NO';
          }
          if($office == 'office'){
            $office = 'YES';
          }else{
            $office = 'NO';
          }
          


          //var_dump($HDMI,$DP,$DVI,$VGA);

          if($HDMI == 'HDMI'){
             $HDMI = 'YES';
          }else{
            $HDMI = 'NO';
          }
          if($DP == 'DP'){
            $DP = 'YES';
          }else{
            $DP = 'NO';
          }
          if($DVI == 'DVI'){
            $DVI = 'YES';
          }else{
            $DVI = 'NO';
          }
          if($VGA == 'VGA'){
            $VGA = 'YES';
          }else{
            $VGA = 'NO';
          }


          //var_dump($HDMI,$DP,$DVI,$VGA);
          
          

            $data = array(
              'name' => $name,
              'model' => $model,
              'powerusage' => $powerusage,
              'HDMI' => $HDMI,
              'DisplayPort' => $DP,
              'DVI' => $DVI,
              'VGA' => $VGA,
              'price' => $price,
              'level' => $level,
              'gaming' => $gaming,
              'multimedia' => $multimedia,
              'office' => $office,

            );

            // insert values in database

            $this->product->createGPU($data);
            //$this->sendemail($email,$username,$password);
          //  $this->User_model->update_data($post_image);

            $this->load->view('login');
            redirect('index.php/products_control/showgpu');
              }
      }
    public function actionaddmonitor(){
          $this->load->library('form_validation');
          $this->form_validation->set_rules('name', 'Name Product', 'trim|required|min_length[4]|max_length[32]');
          $this->form_validation->set_rules('size', 'Size', 'trim|required|min_length[2]|max_length[32]');
          $this->form_validation->set_rules('panel', 'Panel', 'required');
          $this->form_validation->set_rules('refreshrate', 'RefreshRate', 'trim|required|min_length[2]|max_length[3]');
          $this->form_validation->set_rules('resolution', 'Resolution', 'trim|required|min_length[2]|max_length[10]');
          $this->form_validation->set_rules('price', 'Price', 'trim|required|min_length[2]|max_length[256]');
          $this->form_validation->set_rules('level', 'Level', 'trim|required|min_length[1]|max_length[1]|greater_than[0]');
         
          



          if($this->form_validation->run() == FALSE) {
            $this->addmonitor();
            //redirect('index.php/request/register');
          } else {

          $name = $this->input->post('name');
          $size = $this->input->post('size');
          $panel = $this->input->post('panel');
          $HDMI = $this->input->post('HDMI');
          $DP = $this->input->post('DP');
          $DVI = $this->input->post('DVI');
          $VGA = $this->input->post('VGA');
          $refreshrate = $this->input->post('refreshrate');
          $resolution = $this->input->post('resolution');
          $price = $this->input->post('price');
          $level = $this->input->post('level');
          $gaming = $this->input->post('gaming');
          $multimedia = $this->input->post('multimedia');
          $office = $this->input->post('office');


           if($gaming == 'gaming'){
             $gaming = 'YES';
          }else{
            $gaming = 'NO';
          }
          if($multimedia == 'multimedia'){
            $multimedia = 'YES';
          }else{
            $multimedia = 'NO';
          }
          if($office == 'office'){
            $office = 'YES';
          }else{
            $office = 'NO';
          }
          


          //var_dump($HDMI,$DP,$DVI,$VGA);

          if($HDMI == 'HDMI'){
             $HDMI = 'YES';
          }else{
            $HDMI = 'NO';
          }
          if($DP == 'DP'){
            $DP = 'YES';
          }else{
            $DP = 'NO';
          }
          if($DVI == 'DVI'){
            $DVI = 'YES';
          }else{
            $DVI = 'NO';
          }
          if($VGA == 'VGA'){
            $VGA = 'YES';
          }else{
            $VGA = 'NO';
          }


          //var_dump($HDMI,$DP,$DVI,$VGA);
          
          

            $data = array(
              'name' => $name,
              'size' => $size,
              'panel' => $panel,
              'refreshrate' => $refreshrate,
              'resolution' => $resolution,
              'HDMI' => $HDMI,
              'DisplayPort' => $DP,
              'DVI' => $DVI,
              'VGA' => $VGA,
              'price' => $price,
              'level' => $level,
              'gaming' => $gaming,
              'multimedia' => $multimedia,
              'office' => $office,

            );

            // insert values in database

            $this->product->createMonitor($data);
            //$this->sendemail($email,$username,$password);
          //  $this->User_model->update_data($post_image);

            $this->load->view('login');
            redirect('index.php/products_control/showmonitor');
              }
      }
    public function actionaddhdd(){
          $this->load->library('form_validation');
          $this->form_validation->set_rules('name', 'Name Product', 'trim|required|min_length[4]|max_length[32]');
          $this->form_validation->set_rules('type', 'Type', 'trim|required|min_length[2]|max_length[32]');
          $this->form_validation->set_rules('capacity', 'Capacity', 'required');
          $this->form_validation->set_rules('price', 'Price', 'trim|required|min_length[3]|max_length[256]');
          
          



          if($this->form_validation->run() == FALSE) {
            $this->addhdd();
            //redirect('index.php/request/register');
          } else {

          $name = $this->input->post('name');
          $type = $this->input->post('type');
          $capacity = $this->input->post('capacity');
          $price = $this->input->post('price');
          $gaming = $this->input->post('gaming');
          $multimedia = $this->input->post('multimedia');
          $office = $this->input->post('office');


           if($gaming == 'gaming'){
             $gaming = 'YES';
          }else{
            $gaming = 'NO';
          }
          if($multimedia == 'multimedia'){
            $multimedia = 'YES';
          }else{
            $multimedia = 'NO';
          }
          if($office == 'office'){
            $office = 'YES';
          }else{
            $office = 'NO';
          }
          


       

            $data = array(
              'name' => $name,
              'type' => $type,
              'capacity' => $capacity,
              'price' => $price,
              'gaming' => $gaming,
              'multimedia' => $multimedia,
              'office' => $office,

            );

            // insert values in database

            $this->product->createHDD($data);
            //$this->sendemail($email,$username,$password);
          //  $this->User_model->update_data($post_image);

            $this->load->view('login');
            redirect('index.php/products_control/showhdd');
              }
      }
    public function actionaddmainboard(){
          $this->load->library('form_validation');
          $this->form_validation->set_rules('name', 'Name Product', 'trim|required|min_length[4]|max_length[32]');
          $this->form_validation->set_rules('model', 'Model', 'trim|required|min_length[2]|max_length[32]');
          $this->form_validation->set_rules('socket', 'Socket', 'required|min_length[2]|max_length[32]');
          $this->form_validation->set_rules('chipset', 'Chipset', 'trim|required|min_length[2]|max_length[32]');
          $this->form_validation->set_rules('ram', 'Ram', 'trim|required|min_length[2]|max_length[32]');
          $this->form_validation->set_rules('price', 'Price', 'trim|required|min_length[3]|max_length[256]');
          $this->form_validation->set_rules('WIFI', 'WIFI', 'trim|required|min_length[2]|max_length[10]');
          
          



          if($this->form_validation->run() == FALSE) {
            $this->addmainboard();
            //redirect('index.php/request/register');
          } else {

          $name = $this->input->post('name');
          $model = $this->input->post('model');
          $socket = $this->input->post('socket');
          $chipset = $this->input->post('chipset');
          $ram = $this->input->post('ram');
          $price = $this->input->post('price');
          $WIFI = $this->input->post('WIFI');
          $gaming = $this->input->post('gaming');
          $multimedia = $this->input->post('multimedia');
          $office = $this->input->post('office');
          $WIFI = $this->input->post('WIFI');


           if($gaming == 'gaming'){
             $gaming = 'YES';
          }else{
            $gaming = 'NO';
          }
          if($multimedia == 'multimedia'){
            $multimedia = 'YES';
          }else{
            $multimedia = 'NO';
          }
          if($office == 'office'){
            $office = 'YES';
          }else{
            $office = 'NO';
          }
          

         

            $data = array(
              'name' => $name,
              'model' => $model,
              'socket' => $socket,
              'chipset' => $chipset,
              'ram' => $ram,
              'price' => $price,
              'gaming' => $gaming,
              'multimedia' => $multimedia,
              'office' => $office,
              'WIFI' => $WIFI,

            );

            // insert values in database

            $this->product->createMainboard($data);
            //$this->sendemail($email,$username,$password);
          //  $this->User_model->update_data($post_image);

            $this->load->view('login');
            redirect('index.php/products_control/showmainboard');
              }
      }
    public function actionaddpsu(){
          $this->load->library('form_validation');
          $this->form_validation->set_rules('name', 'Name Product', 'trim|required|min_length[4]|max_length[32]');
          $this->form_validation->set_rules('power', 'Maximum Power', 'trim|required|min_length[2]|max_length[32]');
          $this->form_validation->set_rules('price', 'Price', 'trim|required|min_length[3]|max_length[256]');
          
          



          if($this->form_validation->run() == FALSE) {
            $this->addpsu();
            //redirect('index.php/request/register');
          } else {

          $name = $this->input->post('name');
          $power = $this->input->post('power');
          $price = $this->input->post('price');
          $gaming = $this->input->post('gaming');
          $multimedia = $this->input->post('multimedia');
          $office = $this->input->post('office');


           if($gaming == 'gaming'){
             $gaming = 'YES';
          }else{
            $gaming = 'NO';
          }
          if($multimedia == 'multimedia'){
            $multimedia = 'YES';
          }else{
            $multimedia = 'NO';
          }
          if($office == 'office'){
            $office = 'YES';
          }else{
            $office = 'NO';
          }
          


         

            $data = array(
              'name' => $name,
              'power' => $power,
              'price' => $price,
              'gaming' => $gaming,
              'multimedia' => $multimedia,
              'office' => $office,

            );

            // insert values in database

            $this->product->createPSU($data);
            //$this->sendemail($email,$username,$password);
          //  $this->User_model->update_data($post_image);

            $this->load->view('login');
            redirect('index.php/products_control/showpsu');
              }
      }
    public function actionaddram(){
          $this->load->library('form_validation');
          $this->form_validation->set_rules('name', 'Name Product', 'trim|required|min_length[4]|max_length[32]');
          $this->form_validation->set_rules('type', 'Type', 'trim|required|min_length[2]|max_length[32]');
          $this->form_validation->set_rules('capacity', 'Capacity', 'trim|required|min_length[1]|max_length[32]');
          $this->form_validation->set_rules('bus', 'Bus', 'trim|required|min_length[2]|max_length[32]');
          $this->form_validation->set_rules('price', 'Price', 'trim|required|min_length[3]|max_length[256]');
          $this->form_validation->set_rules('level', 'Level', 'trim|required|min_length[1]|max_length[1]|greater_than[0]');
          
          



          if($this->form_validation->run() == FALSE) {
            $this->addram();
            //redirect('index.php/request/register');
          } else {

          $name = $this->input->post('name');
          $type = $this->input->post('type');
          $capacity = $this->input->post('capacity');
          $bus = $this->input->post('bus');
          $price = $this->input->post('price');
          $level = $this->input->post('level');
          $gaming = $this->input->post('gaming');
          $multimedia = $this->input->post('multimedia');
          $office = $this->input->post('office');


           if($gaming == 'gaming'){
             $gaming = 'YES';
          }else{
            $gaming = 'NO';
          }
          if($multimedia == 'multimedia'){
            $multimedia = 'YES';
          }else{
            $multimedia = 'NO';
          }
          if($office == 'office'){
            $office = 'YES';
          }else{
            $office = 'NO';
          }
          


          

            $data = array(
              'name' => $name,
              'type' => $type,
              'capacity' => $capacity,
              'bus' => $bus,
              'price' => $price,
              'level' => $level,
              'gaming' => $gaming,
              'multimedia' => $multimedia,
              'office' => $office,

            );

            // insert values in database

            $this->product->createRAM($data);
            //$this->sendemail($email,$username,$password);
          //  $this->User_model->update_data($post_image);

            
            redirect('index.php/products_control/showram');
              }
      }
    public function actionaddssd(){
          $this->load->library('form_validation');
          $this->form_validation->set_rules('name', 'Name Product', 'trim|required|min_length[4]|max_length[32]');
          $this->form_validation->set_rules('type', 'Type', 'trim|required|min_length[2]|max_length[32]');
          $this->form_validation->set_rules('capacity', 'Capacity', 'required');
          $this->form_validation->set_rules('price', 'Price', 'trim|required|min_length[3]|max_length[256]');
          $this->form_validation->set_rules('level', 'Level', 'trim|required|min_length[1]|max_length[1]|greater_than[0]');
          



          if($this->form_validation->run() == FALSE) {
            $this->addssd();
            //redirect('index.php/request/register');
          } else {

          $name = $this->input->post('name');
          $type = $this->input->post('type');
          $capacity = $this->input->post('capacity');
          $price = $this->input->post('price');
          $level = $this->input->post('level');
          $gaming = $this->input->post('gaming');
          $multimedia = $this->input->post('multimedia');
          $office = $this->input->post('office');


           if($gaming == 'gaming'){
             $gaming = 'YES';
          }else{
            $gaming = 'NO';
          }
          if($multimedia == 'multimedia'){
            $multimedia = 'YES';
          }else{
            $multimedia = 'NO';
          }
          if($office == 'office'){
            $office = 'YES';
          }else{
            $office = 'NO';
          }
          


          $config['upload_path'] ='./assets/image/';
          $config['allowed_types'] ='gif|jpg|png';
          $config['max_size'] ='2048';
          $config['max_width'] ='0';
          $config['max_height'] ='0';

          $this->load->library('upload',$config);
          if(!$this->upload->do_upload()){
            $errors = array('error'=> $this->upload->display_errors());
            $post_image ='noimage.jpg';

          }else{
            $data = array('upload_data' => $this->upload->data());
            $post_image = $_FILES['userfile']['name'];

          }

            $data = array(
              'name' => $name,
              'type' => $type,
              'capacity' => $capacity,
              'price' => $price,
              'level' => $level,
              'gaming' => $gaming,
              'multimedia' => $multimedia,
              'office' => $office,

            );

            // insert values in database

            $this->product->createSSD($data);
            //$this->sendemail($email,$username,$password);
          //  $this->User_model->update_data($post_image);

            $this->load->view('login');
            redirect('index.php/products_control/');
              }
      }
    public function actionaddcooler(){
          $this->load->library('form_validation');
          $this->form_validation->set_rules('name', 'Name Product', 'trim|required|min_length[4]|max_length[32]');
          $this->form_validation->set_rules('type', 'Type', 'trim|required|min_length[3]|max_length[32]');
          $this->form_validation->set_rules('price', 'Price', 'trim|required|min_length[3]|max_length[256]');
          
          



          if($this->form_validation->run() == FALSE) {
            $this->addpsu();
            //redirect('index.php/request/register');
          } else {

          $name = $this->input->post('name');
          $type = $this->input->post('type');
          $price = $this->input->post('price');
          $gaming = $this->input->post('gaming');
          $multimedia = $this->input->post('multimedia');
          $office = $this->input->post('office');


           if($gaming == 'gaming'){
             $gaming = 'YES';
          }else{
            $gaming = 'NO';
          }
          if($multimedia == 'multimedia'){
            $multimedia = 'YES';
          }else{
            $multimedia = 'NO';
          }
          if($office == 'office'){
            $office = 'YES';
          }else{
            $office = 'NO';
          }
          


          $config['upload_path'] ='./assets/image/';
          $config['allowed_types'] ='gif|jpg|png';
          $config['max_size'] ='2048';
          $config['max_width'] ='0';
          $config['max_height'] ='0';

          $this->load->library('upload',$config);
          if(!$this->upload->do_upload()){
            $errors = array('error'=> $this->upload->display_errors());
            $post_image ='noimage.jpg';

          }else{
            $data = array('upload_data' => $this->upload->data());
            $post_image = $_FILES['userfile']['name'];

          }

            $data = array(
              'name' => $name,
              'type' => $type,
              'price' => $price,
              'gaming' => $gaming,
              'multimedia' => $multimedia,
              'office' => $office,

            );

            // insert values in database

            $this->product->createCooler($data);
            //$this->sendemail($email,$username,$password);
          //  $this->User_model->update_data($post_image);

            
            redirect('index.php/products_control/showcooler');
              }
      }

      public function showcpu(){
          $cpu = $this->Product_model->getCPU();
          $gpu = $this->Product_model->getGPU();
          $arr['cpu'] = $cpu;
          if(!empty($gpu)){
            $arr['gpu']    = $gpu;
          
            }
          $this->load->view('show/showcpu',$arr);
      }
      public function showgpu(){
          $gpu = $this->Product_model->getGPU();
          
          $arr['gpu'] = $gpu;
          
          $this->load->view('show/showgpu',$arr);
      }
      public function showmainboard(){
          $gpu = $this->Product_model->getMB();
          
          $arr['mainboard'] = $gpu;
          
          $this->load->view('show/showmainboard',$arr);
      }
      public function showram(){
          $ram = $this->Product_model->getRAM();
          
          $arr['ram'] = $ram;
          
          $this->load->view('show/showram',$arr);
      }
      public function showssd(){
          $ssd = $this->Product_model->getSSD();
          
          $arr['ssd'] = $ssd;
          
          $this->load->view('show/showssd',$arr);
      }
      public function showhdd(){
          $hdd = $this->Product_model->getHDD();
          
          $arr['hdd'] = $hdd;
          
          $this->load->view('show/showhdd',$arr);
      }
      public function showmonitor(){
          $monitor = $this->Product_model->getMonitor();
          
          $arr['monitor'] = $monitor;
          
          $this->load->view('show/showmonitor',$arr);
      }
      public function showpsu(){
          $psu = $this->Product_model->getPSU();
          
          $arr['psu'] = $psu;
          
          $this->load->view('show/showpsu',$arr);
      }
      public function showcooler(){
          $cooler = $this->Product_model->getCooler();
          
          $arr['cooler'] = $cooler;
          
          $this->load->view('show/showcooler',$arr);
      }

      public function editCPU($id){
        $cpu = $this->Product_model->getID_CPU($id);
        $arr['cpu'] = $cpu;

        $this->load->view('edit/editcpu',$arr);
      }
      public function editGPU($id){
        $gpu = $this->Product_model->getID_GPU($id);
        $arr['gpu'] = $gpu;

        $this->load->view('edit/editgpu',$arr);
      }
      public function editmainboard($id){
        $mainboard = $this->Product_model->getID_MB($id);
        $arr['mainboard'] = $mainboard;

        $this->load->view('edit/editmainboard',$arr);
      }
      public function editHDD($id){
        $hdd = $this->Product_model->getID_HDD($id);
        $arr['hdd'] = $hdd;

        $this->load->view('edit/edithdd',$arr);
      }
      public function editSSD($id){
        $ssd = $this->Product_model->getID_SSD($id);
        $arr['ssd'] = $ssd;

        $this->load->view('edit/editssd',$arr);
      }
      public function editMonitor($id){
        $monitor = $this->Product_model->getID_Monitor($id);
        $arr['monitor'] = $monitor;

        $this->load->view('edit/editmonitor',$arr);
      }
      public function editPSU($id){
        $psu = $this->Product_model->getID_PSU($id);
        $arr['psu'] = $psu;

        $this->load->view('edit/editpsu',$arr);
      }
      public function editRAM($id){
        $ram = $this->Product_model->getID_RAM($id);
        $arr['ram'] = $ram;

        $this->load->view('edit/editram',$arr);
      }
      public function editCooler($id){
        $cooler = $this->Product_model->getID_Cooler($id);
        $arr['cooler'] = $cooler;

        $this->load->view('edit/editcooler',$arr);
      }
      public function checkLevel($level){

          if($level > 5 || $level < 1){
            return true;
          }else{
            return false;
          }

      }
      public function actionquestion1(){

          $this->form_validation->set_rules('salary', 'Salary', 'required');

           if($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message1','Plese Select Choice<br>');   
            
            redirect('index.php/products_control/question1');
           
          } else {
          $salary = $this->input->post('salary');

          

          if($salary == '1'){
              $level = '2';
              $this->session->set_userdata('q1',$salary);
          }else if($salary == '2'){
              $level = '3';
              $this->session->set_userdata('q1',$salary);
          }else if($salary =='3'){
              $level = '4';
              $this->session->set_userdata('q1',$salary);
          }

          
          $gpu = $this->Product_model->getGPUByLevel($level);
          $hdd = $this->Product_model->getHDDByLevel($level);
          $ssd = $this->Product_model->getSSDByLevel($level);
          $monitor = $this->Product_model->getMonitorByLevel($level);
          $psu = $this->Product_model->getPSUByLevel($level);
          $ram = $this->Product_model->getRAMByLevel('3');
          $cooler = $this->Product_model->getCoolerByLevel($level);
   
          $length = count($gpu);


          if($length > 1 ){
            $rand = rand(0,$length-1);
            $gpu_id = $gpu[$rand]['id'];
          }else{
            $gpu_id = $gpu[0]['id'];
          }

          $length = count($hdd);

          if($length > 1 ){
            $rand = rand(0,$length-1);
            $hdd_id = $hdd[$rand]['id'];
          }else{
            $hdd_id = $hdd[0]['id'];
          }

          $length = count($ssd);


          if($length > 1 ){
            $rand = rand(0,$length-1);
            $ssd_id = $ssd[$rand]['id'];
          }else{
            $ssd_id = $ssd[0]['id'];
          }

          $length = count($monitor);


          if($length > 1 ){
            $rand = rand(0,$length-1);
            $monitor_id = $monitor[$rand]['id'];
          }else{
            $monitor_id = $monitor[0]['id'];
          }

          $length = count($psu);


          if($length > 1 ){
            $rand = rand(0,$length-1);
            $psu_id = $psu[$rand]['id'];
          }else{
            $psu_id = $psu[0]['id'];
          }

          $length = count($ram);


          if($length > 1 ){
            $rand = rand(0,$length-1);
            $ram_id = $ram[$rand]['id'];
          }else{
            $ram_id = $ram[0]['id'];
          }

          $length = count($cooler);

          if($length > 1 ){
            $rand = rand(0,$length-1);
            $cooler_id = $cooler[$rand]['id'];
          }else{
            $cooler_id = $cooler[0]['id'];
          }


          $this->session->set_userdata('level',$level);
    
          $this->session->set_userdata('gpu',$gpu_id);
          $this->session->set_userdata('hdd',$hdd_id);
          $this->session->set_userdata('monitor',$monitor_id);
          $this->session->set_userdata('psu',$psu_id);
          $this->session->set_userdata('ram',$ram_id);
          $this->session->set_userdata('ssd',$ssd_id);
          $this->session->set_userdata('cooler',$cooler_id);


          redirect('index.php/products_control/question2');
        }
      }
      public function actionquestion2(){



          $this->form_validation->set_rules('brand', 'brand', 'required');
          if($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message1','Plese Select Choice<br>');   
            
            redirect('index.php/products_control/question2');
          } else {
          $brand = $this->input->post('brand');


          if($brand == '1'){
              $socket = '1151';
              $this->session->set_userdata('q2',$brand);
          }else if($brand == '2'){
              $socket = 'AM4';
              $this->session->set_userdata('q2',$brand);
          }else if($brand =='3'){
              $rand = rand(1,2);

              if($rand == '1'){
                $socket ='1151';
              }else{
                $socket ='AM4';
              }
              $this->session->set_userdata('q2',$brand);
          }

          $level = $this->session->userdata['level'];
          
          $select_cpu = $this->Product_model->getCPUBySocket($socket,$level);


          $select_mainboard = $this->Product_model->getMBBySocket($socket,$level);

         
          $length = count($select_cpu);


          if($length > 1 ){
            $rand = rand(0,$length-1);
            $cpu_id = $select_cpu[$rand]['id'];
          }else{
            $cpu_id = $select_cpu[0]['id'];
          }

          $length = count($select_mainboard);


          if($length > 1 ){
            $rand = rand(0,$length-1);
            $mainboard_id = $select_mainboard[$rand]['id'];
          }else{
            $mainboard_id = $select_mainboard[0]['id'];
          }

          

          echo '<pre> <br>'; var_dump($select_cpu);
          echo '<pre> <br>'; var_dump($select_mainboard);

 


          $this->session->set_userdata('level',$level);
    
          $this->session->set_userdata('cpu',$cpu_id);
          $this->session->set_userdata('socket',$socket);
          $this->session->set_userdata('mainboard',$mainboard_id);
          
          echo '<pre> cpu '; echo $this->session->userdata['cpu'];
          echo '<pre> socket '; echo $this->session->userdata['socket'];
          echo '<pre> Mainboard'; echo $this->session->userdata['mainboard'];
          echo '<br> gpu ' ; echo $this->session->userdata['gpu'];
          echo '<br> hdd ' ;echo $this->session->userdata['hdd'];
          echo '<br> ssd ' ;echo $this->session->userdata['ssd'];
          echo '<br> monitor ' ;echo $this->session->userdata['monitor'];
          echo '<br> psu ' ;echo $this->session->userdata['psu'];
          echo '<br> ram ' ;echo $this->session->userdata['ram'];
          echo '<br> cooler ';echo $this->session->userdata['cooler'];

          //echo $this->session->userdata['gpu'];
          //echo '<pre>'; var_dump($gpu_id); exit();

          redirect('index.php/products_control/question3');
        }
      }
      public function actionquestion3(){



          $this->form_validation->set_rules('type', 'type', 'required');
          if($this->form_validation->run() == FALSE) {
              $this->session->set_flashdata('message1','Plese Select Choice<br>');   
            
              redirect('index.php/products_control/question3');
          } else {
             
              $type = $this->input->post('type');
              $cpu = $this->session->userdata['cpu'];
              $socket = $this->session->userdata['socket'];
              $gpu = $this->session->userdata['gpu'];
              $hdd = $this->session->userdata['hdd'];
              $ssd = $this->session->userdata['ssd'];
              $mainboard = $this->session->userdata['mainboard'];
              $monitor = $this->session->userdata['monitor'];
              $psu = $this->session->userdata['psu'];
              $ram = $this->session->userdata['ram'];
              $cooler = $this->session->userdata['cooler'];

      
          

            if($type == '1'){
                redirect('index.php/products_control/question3_1');
            }else if($type == '2'){
                redirect('index.php/products_control/question3_2');
            }else if($type == '3'){
                $this->session->set_userdata('q3',$type);

                $m = "office";
                $this->session->set_userdata('type',$m);
                
                $type = $this->input->post('type');
                $select_cpu = $this->Product_model->getID_CPU($cpu);
                $level_select = $select_cpu[0]['level'];
                $level_adjust = $level_select - 1 ;

                if($this->checkLevel($level_adjust)){
                      $level_adjust = 1;
                                            
                  }
                //cpu
                $select_cpu = $this->Product_model->getCPUBySocket($socket,$level_adjust);
                $length = count($select_cpu);

                if($length > 1 ){
                  $rand = rand(0,$length-1);
                $cpu_id = $select_cpu[$rand]['id'];
                }else{
                $cpu_id = $select_cpu[0]['id'];
                }

                $this->session->set_userdata('cpu',$cpu_id);
                //gpu
                $select_gpu = $this->Product_model->getID_GPU($gpu);
                $level_select = $select_gpu[0]['level'];
                $level_adjust = $level_select - 3 ;

                if($this->checkLevel($level_adjust)){
                      $level_adjust = 1;
                                            
                  }
                $select_gpu = $this->Product_model->getGPUByLevel($level_adjust);
                $length = count($select_gpu);
                if($length > 1 ){
                  $rand = rand(0,$length-1);
                $gpu_id = $select_gpu[$rand]['id'];
                }else{
                $gpu_id = $select_gpu[0]['id'];
                }
                $this->session->set_userdata('gpu',$gpu_id);
                //mainboard
                $select_mainboard = $this->Product_model->getID_MB($mainboard);
                $level_select = $select_mainboard[0]['level'];
                $level_adjust = $level_select - 2 ;

                if($this->checkLevel($level_adjust)){
                      $level_adjust = 1;
                                            
                  }
                //cpu
                $select_mainboard = $this->Product_model->getMBBySocket($socket,$level_adjust);
                $length = count($select_mainboard);

                if($length > 1 ){
                  $rand = rand(0,$length-1);
                $mainboard_id = $select_mainboard[$rand]['id'];
                }else{
                $mainboard_id = $select_mainboard[0]['id'];
                }

                $this->session->set_userdata('mainboard',$mainboard_id);
                //ssd
                $select_ssd = $this->Product_model->getID_SSD($ssd);
                $level_select = $select_ssd[0]['level'];
                $level_adjust = $level_select - 1 ;

                if($this->checkLevel($level_adjust)){
                      $level_adjust = 1;
                                            
                  }
                $select_ssd = $this->Product_model->getSSDByLevel($level_adjust);
                $length = count($select_ssd);
                if($length > 1 ){
                  $rand = rand(0,$length-1);
                $ssd_id = $select_ssd[$rand]['id'];
                }else{
                $ssd_id = $select_ssd[0]['id'];
                }
                $this->session->set_userdata('ssd',$ssd_id);
                //psu
                $select_psu = $this->Product_model->getID_PSU($psu);
                $level_select = $select_psu[0]['level'];
                $level_adjust = $level_select - 2 ;

                if($this->checkLevel($level_adjust)){
                      $level_adjust = 1;
                                            
                  }
                $select_psu = $this->Product_model->getPSUByLevel($level_adjust);
                $length = count($select_psu);
                if($length > 1 ){
                  $rand = rand(0,$length-1);
                $psu_id = $select_psu[$rand]['id'];
                }else{
                $psu_id = $select_psu[0]['id'];
                }
                $this->session->set_userdata('psu',$psu_id);
                //hdd
                $select_hdd = $this->Product_model->getID_HDD($hdd);
                $level_select = $select_hdd[0]['level'];
                $level_adjust = $level_select - 2 ;

                if($this->checkLevel($level_adjust)){
                      $level_adjust = 1;
                                            
                  }
                $select_hdd = $this->Product_model->getHDDByLevel($level_adjust);
                $length = count($select_hdd);
                if($length > 1 ){
                  $rand = rand(0,$length-1);
                $hdd_id = $select_hdd[$rand]['id'];
                }else{
                $hdd_id = $select_hdd[0]['id'];
                }
                $this->session->set_userdata('hdd',$hdd_id);     

                       
                //var_dump($mainboard); exit();
                
                redirect('index.php/products_control/question4');
            }else if($type == '4'){
                $this->session->set_userdata('q3',$type);
                $m = 'movie';
                $this->session->set_userdata('type',$m);
                $select_cpu = $this->Product_model->getID_CPU($cpu);
                $level_select = $select_cpu[0]['level'];
                $level_adjust = $level_select - 1 ;
                if($this->checkLevel($level_adjust)){
                      $level_adjust = 1;
                                            
                  }
                //cpu
                $select_cpu = $this->Product_model->getCPUByLevel($level_adjust);
                $length = count($select_cpu);

                if($length > 1 ){
                  $rand = rand(0,$length-1);
                $cpu_id = $select_cpu[$rand]['id'];
                }else{
                $cpu_id = $select_cpu[0]['id'];
                }

                $this->session->set_userdata('cpu',$cpu_id);
                //gpu
                $select_gpu = $this->Product_model->getID_GPU($gpu);
                $level_select = $select_gpu[0]['level'];
                $level_adjust = $level_select - 1 ;
                if($this->checkLevel($level_adjust)){
                      $level_adjust = 1;
                                            
                  }
                $select_gpu = $this->Product_model->getGPUByLevel($level_adjust);
                $length = count($select_gpu);
                if($length > 1 ){
                  $rand = rand(0,$length-1);
                $gpu_id = $select_gpu[$rand]['id'];
                }else{
                $gpu_id = $select_gpu[0]['id'];
                }
                $this->session->set_userdata('gpu',$gpu_id);
                //ssd
                $select_ssd = $this->Product_model->getID_SSD($ssd);
                $level_select = $select_ssd[0]['level'];
                $level_adjust = $level_select + 1 ;
                if($this->checkLevel($level_adjust)){
                      $level_adjust = 5;
                                            
                  }
                $select_ssd = $this->Product_model->getSSDByLevel($level_adjust);
                $length = count($select_ssd);
                if($length > 1 ){
                  $rand = rand(0,$length-1);
                $ssd_id = $select_ssd[$rand]['id'];
                }else{
                $ssd_id = $select_ssd[0]['id'];
                }
                $this->session->set_userdata('ssd',$ssd_id);
                //hdd
                $select_hdd = $this->Product_model->getID_HDD($hdd);
                $level_select = $select_hdd[0]['level'];
                $level_adjust = $level_select + 2 ;
                if($this->checkLevel($level_adjust)){
                      $level_adjust = 5;
                                            
                  }
                $select_hdd = $this->Product_model->getHDDByLevel($level_adjust);
                $length = count($select_hdd);
                if($length > 1 ){
                  $rand = rand(0,$length-1);
                $hdd_id = $select_hdd[$rand]['id'];
                }else{
                $hdd_id = $select_hdd[0]['id'];
                }
                $this->session->set_userdata('hdd',$hdd_id);     
            }

            $level = $this->session->userdata['level'];
            
            //$cpu = $this->Product_model->getCPUByLevel($level);
            //$mainboard = $this->Product_model->getMBByLevel($level);
            
            //echo '<pre> CPU'; var_dump($cpu);
           


            //echo '<pre> Select CPU'; var_dump($select_cpu); exit();


    
            $this->session->set_userdata('level',$level);
      
            
            
            echo '<pre> cpu '; echo $this->session->userdata['cpu'];
            echo '<pre> Mainboard'; echo $this->session->userdata['mainboard'];
            echo '<br> gpu ' ; echo $this->session->userdata['gpu'];
            echo '<br> hdd ' ;echo $this->session->userdata['hdd'];
            echo '<br> ssd ' ;echo $this->session->userdata['ssd'];
            echo '<br> monitor ' ;echo $this->session->userdata['monitor'];
            echo '<br> psu ' ;echo $this->session->userdata['psu'];
            echo '<br> ram ' ;echo $this->session->userdata['ram'];
            echo '<br> cooler ';echo $this->session->userdata['cooler'];

            //echo $this->session->userdata['gpu'];
            //echo '<pre>'; var_dump($gpu_id); exit();

            redirect('index.php/products_control/question4');

          }
      }

      public function actionquestion3_1(){

          $this->form_validation->set_rules('game', 'game', 'required');
          if($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message1','Plese Select Choice<br>');   
            
            redirect('index.php/products_control/question3_1');
            
          } else 
            {
                                    $game = $this->input->post('game');

                                    $m = "gaming";
                                    $this->session->set_userdata('type',$m);


                                    $level = $this->session->userdata['level'];
                                    $socket = $this->session->userdata['socket'];
                                    $cpu = $this->session->userdata['cpu'];
                                    $gpu = $this->session->userdata['gpu'];
                                    $hdd = $this->session->userdata['hdd'];
                                    $ssd = $this->session->userdata['ssd'];
                                    $monitor = $this->session->userdata['monitor'];
                                    $psu = $this->session->userdata['psu'];
                                    $ram = $this->session->userdata['ram'];


                                if($game == '1'){
                                    $select_cpu = $this->Product_model->getCPUBySocket($socket,$level);
                                    $select_mainboard = $this->Product_model->getMBBySocket($socket,$level);
                                    $select_gpu = $this->Product_model->getGPUByLevel($level);
                                    $select_ssd = $this->Product_model->getSSDByLevel($level);
                                    $select_hdd = $this->Product_model->getHDDByLevel($level);
                                    $select_psu = $this->Product_model->getPSUByLevel($level);
                                    $select_ram = $this->Product_model->getRAMByLevel(3);

                                    $this->session->set_userdata('q31',$game);
                                    
                               //uplevel

                                    //cpu
                                      $level_select = $select_cpu[0]['level'];
                                      $level_adjust = $level_select + 2 ;
                                      
                                      if($this->checkLevel($level_adjust)){
                                            $level_adjust = 5;
                                            
                                      }

                                      
                                      $select_cpu = $this->Product_model->getCPUBySocket($socket,$level_adjust);
                                      
                                      $length = count($select_cpu);

                                      if($length > 1 ){
                                        $rand = rand(0,$length-1);
                                      $cpu_id = $select_cpu[$rand]['id'];
                                      }else{
                                      $cpu_id = $select_cpu[0]['id'];
                                      }
                                      //echo '<pre>';var_dump($select_cpu); exit();
                                      $this->session->set_userdata('cpu',$cpu_id);
                                      //gpu
                                      $level_select = $select_gpu[0]['level'];
                                      $level_adjust = $level_select + 2 ;
                                      
                                      if($this->checkLevel($level_adjust)){
                                            $level_adjust = 5;
                                            
                                      }

                                      
                                      $select_gpu = $this->Product_model->getGPUByLevel($level_adjust);
                                      
                                      $length = count($select_gpu);
                                      //checkfunctiongpu
                                      $gpu_length = count($select_gpu);
                                        if($gpu_length > 1){
                                          $cwhile = 0;
                                          $temp = $select_gpu[$cwhile]['gaming'];

                                          while($temp!='YES'){
                                          $cwhile = $cwhile+1;
                                          $temp = $select_gpu[$cwhile]['gaming'];

                                          echo $cwhile;
                                          }

                                          $select_gpu = $select_gpu[$cwhile];
                                      }else{
                                          $select_gpu = $select_gpu[0];
                                      }
                                      $gpu_id = $select_gpu['id'];
                                      //echo '<pre>';var_dump($select_gpu); exit();
                                      $this->session->set_userdata('gpu',$gpu_id);
                                      $this->session->set_userdata('level',$level_adjust);

                                      //mainboard
                                      $level_select = $select_mainboard[0]['level'];
                                      $level_adjust = $level_select + 2 ;
                                      
                                      if($this->checkLevel($level_adjust)){
                                            $level_adjust = 5;
                                            
                                      }

                                      
                                      $select_mainboard = $this->Product_model->getMBBySocket($socket,$level_adjust);
                                      
                                      $length = count($select_mainboard);

                                      if($length > 1 ){
                                        $rand = rand(0,$length-1);
                                      $mainboard_id = $select_mainboard[$rand]['id'];
                                      }else{
                                      $mainboard_id = $select_mainboard[0]['id'];
                                      }
                                      //echo '<pre>';var_dump($select_mainboard); exit();
                                      $this->session->set_userdata('mainboard',$mainboard_id);
                                      $this->session->set_userdata('mb',$level_adjust);
                                      //ssd
                                      $level_select = $select_ssd[0]['level'];
                                      $level_adjust = $level_select + 1 ;
                                      
                                      if($this->checkLevel($level_adjust)){
                                            $level_adjust = 5;
                                            
                                      }

                                      
                                      $select_ssd = $this->Product_model->getSSDByLevel($level_adjust);
                                      
                                      $length = count($select_ssd);

                                      if($length > 1 ){
                                        $rand = rand(0,$length-1);
                                      $ssd_id = $select_ssd[$rand]['id'];
                                      }else{
                                      $ssd_id = $select_ssd[0]['id'];
                                      }
                                      //echo '<pre>';var_dump($select_ssd); exit();
                                      $this->session->set_userdata('ssd',$ssd_id);
                                   
                                      //hdd
                                      $level_select = $select_hdd[0]['level'];
                                      $level_adjust = $level_select + 1 ;
                                      
                                      if($this->checkLevel($level_adjust)){
                                            $level_adjust = 5;
                                            
                                      }

                                      
                                      $select_hdd = $this->Product_model->getHDDByLevel($level_adjust);
                                      
                                      $length = count($select_hdd);

                                      if($length > 1 ){
                                        $rand = rand(0,$length-1);
                                      $hdd_id = $select_hdd[$rand]['id'];
                                      }else{
                                      $hdd_id = $select_hdd[0]['id'];
                                      }
                                      //echo '<pre>';var_dump($select_hdd); exit();
                                      $this->session->set_userdata('hdd',$hdd_id);

                                      //ram
                                      //echo '<pre>';var_dump($select_ram); exit();
                                      $level_select = $select_ram[0]['level'];
                                      $level_adjust = $level_select + 1 ;
                                       
                                      if($this->checkLevel($level_adjust)){
                                            $level_adjust = 5;
                                            
                                      }

                                      
                                      $select_ram = $this->Product_model->getRAMByLevel($level_adjust);
                                      
                                      $length = count($select_ram);

                                      if($length > 1 ){
                                        $rand = rand(0,$length-1);
                                      $ram_id = $select_ram[$rand]['id'];
                                      }else{
                                      $ram_id = $select_ram[0]['id'];
                                      }
                                      //echo '<pre>';var_dump($select_ram); exit();
                                      $this->session->set_userdata('ram',$ram_id);

                                      //psu
                                      $level_select = $select_psu[0]['level'];
                                      $level_adjust = $level_select + 0 ;
                                      
                                      if($this->checkLevel($level_adjust)){
                                            $level_adjust = 5;
                                            
                                      }

                                      
                                      $select_psu = $this->Product_model->getPSUByLevel($level_adjust);
                                      
                                      $length = count($select_psu);

                                      if($length > 1 ){
                                        $rand = rand(0,$length-1);
                                      $psu_id = $select_psu[$rand]['id'];
                                      }else{
                                      $psu_id = $select_psu[0]['id'];
                                      }
                                      //echo '<pre>';var_dump($select_psu); exit();
                                      $this->session->set_userdata('psu',$psu_id);

                                      
                             
                            }else if($game == '2'){
                                $select_cpu = $this->Product_model->getCPUBySocket($socket,$level);
                                $select_mainboard = $this->Product_model->getMBBySocket($socket,$level);
                                $select_gpu = $this->Product_model->getGPUByLevel($level);
                                $select_ssd = $this->Product_model->getSSDByLevel($level);
                                $select_hdd = $this->Product_model->getHDDByLevel($level);
                                $select_psu = $this->Product_model->getPSUByLevel($level);
                                $select_ram = $this->Product_model->getRAMByLevel($level);

                                $this->session->set_userdata('q31',$game);
                                //checkfunctiongpu

                                

                                //uplevel

                                //cpu
                                  $level_select = $select_cpu[0]['level'];
                                  $level_adjust = $level_select + 1 ;
                                  
                                  if($this->checkLevel($level_adjust)){
                                        $level_adjust = 5;
                                        
                                  }

                                  
                                  $select_cpu = $this->Product_model->getCPUBySocket($socket,$level_adjust);
                                  
                                  $length = count($select_cpu);

                                  if($length > 1 ){
                                    $rand = rand(0,$length-1);
                                  $cpu_id = $select_cpu[$rand]['id'];
                                  }else{
                                  $cpu_id = $select_cpu[0]['id'];
                                  }
                                  //echo '<pre>';var_dump($select_cpu); exit();
                                  $this->session->set_userdata('cpu',$cpu_id);
                                  //gpu
                                  $level_select = $select_gpu[0]['level'];
                                  $level_adjust = $level_select + 1 ;
                                  
                                  if($this->checkLevel($level_adjust)){
                                        $level_adjust = 5;
                                        
                                  }

                                  
                                  $select_gpu = $this->Product_model->getGPUByLevel($level_adjust);
                                  
                                  $length = count($select_gpu);

                                  $gpu_length = count($select_gpu);
                                    if($gpu_length > 1){
                                      $cwhile = 0;
                                      $temp = $select_gpu[$cwhile]['gaming'];

                                      while($temp!='YES'){
                                      $cwhile = $cwhile+1;
                                      $temp = $select_gpu[$cwhile]['gaming'];

                                      echo $cwhile;
                                      }

                                      $select_gpu = $select_gpu[$cwhile];
                                    }else{
                                      $select_gpu = $select_gpu[0];
                                    }
                                  $gpu_id = $select_gpu['id'];
                                  //echo '<pre>';var_dump($select_gpu); exit();
                                  $this->session->set_userdata('gpu',$gpu_id);
                                  $this->session->set_userdata('level',$level_adjust);

                                  //mainboard
                                  $level_select = $select_mainboard[0]['level'];
                                  $level_adjust = $level_select;
                                  
                                  if($this->checkLevel($level_adjust)){
                                        $level_adjust = 5;
                                        
                                  }

                                  
                                  $select_mainboard = $this->Product_model->getMBBySocket($socket,$level_adjust);
                                  
                                  $length = count($select_mainboard);

                                  if($length > 1 ){
                                    $rand = rand(0,$length-1);
                                  $mainboard_id = $select_mainboard[$rand]['id'];
                                  }else{
                                  $mainboard_id = $select_mainboard[0]['id'];
                                  }
                                  //echo '<pre>';var_dump($select_mainboard); exit();
                                  $this->session->set_userdata('mainboard',$mainboard_id);
                                  $this->session->set_userdata('mb',$level_adjust);
                                  //ssd
                                  $level_select = $select_ssd[0]['level'];
                                  $level_adjust = $level_select ;
                                  
                                  if($this->checkLevel($level_adjust)){
                                        $level_adjust = 5;
                                        
                                  }

                                  
                                  $select_ssd = $this->Product_model->getSSDByLevel($level_adjust);
                                  
                                  $length = count($select_ssd);

                                  if($length > 1 ){
                                    $rand = rand(0,$length-1);
                                  $ssd_id = $select_ssd[$rand]['id'];
                                  }else{
                                  $ssd_id = $select_ssd[0]['id'];
                                  }
                                  //echo '<pre>';var_dump($select_ssd); exit();
                                  $this->session->set_userdata('ssd',$ssd_id);
                               
                                  //hdd
                                  $level_select = $select_hdd[0]['level'];
                                  $level_adjust = $level_select ;
                                  
                                  if($this->checkLevel($level_adjust)){
                                        $level_adjust = 5;
                                        
                                  }

                                  
                                  $select_hdd = $this->Product_model->getHDDByLevel($level_adjust);
                                  
                                  $length = count($select_hdd);

                                  if($length > 1 ){
                                    $rand = rand(0,$length-1);
                                  $hdd_id = $select_hdd[$rand]['id'];
                                  }else{
                                  $hdd_id = $select_hdd[0]['id'];
                                  }
                                  //echo '<pre>';var_dump($select_hdd); exit();
                                  $this->session->set_userdata('hdd',$hdd_id);

                                  //ram
                                  $level_select = $select_ram[0]['level'];
                                  $level_adjust = $level_select + 1 ;
                                  
                                  if($this->checkLevel($level_adjust)){
                                        $level_adjust = 5;
                                        
                                  }
                                  if($level_adjust<3){
                                        $level_adjust = 3;
                                  }

                                  
                                  $select_ram = $this->Product_model->getRAMByLevel($level_adjust);
                                  
                                  $length = count($select_ram);

                                  if($length > 1 ){
                                    $rand = rand(0,$length-1);
                                  $ram_id = $select_ram[$rand]['id'];
                                  }else{
                                  $ram_id = $select_ram[0]['id'];
                                  }
                                  //echo '<pre>';var_dump($select_ram); exit();
                                  $this->session->set_userdata('ram',$ram_id);

                                  //psu
                                  $level_select = $select_psu[0]['level'];
                                  $level_adjust = $level_select + 0 ;
                                  
                                  if($this->checkLevel($level_adjust)){
                                        $level_adjust = 5;
                                        
                                  }

                                  
                                  $select_psu = $this->Product_model->getPSUByLevel($level_adjust);
                                  
                                  $length = count($select_psu);

                                  if($length > 1 ){
                                    $rand = rand(0,$length-1);
                                  $psu_id = $select_psu[$rand]['id'];
                                  }else{
                                  $psu_id = $select_psu[0]['id'];
                                  }
                                  //echo '<pre>';var_dump($select_psu); exit();
                                  $this->session->set_userdata('psu',$psu_id);

                                  
                            }else if($game =='3'){
                                  
                                  $this->session->set_userdata('q31',$game);

                            }else if($game =='4'){
                                   $select_cpu = $this->Product_model->getCPUBySocket($socket,$level);
                                   $select_gpu = $this->Product_model->getGPUByLevel($level);

                                   //checkfunctiongpu
                                   $this->session->set_userdata('q31',$game);
                                

                                //uplevel

                                //cpu
                                  $level_select = $select_cpu[0]['level'];
                                  $level_adjust = $level_select + 1 ;
                                  
                                  if($this->checkLevel($level_adjust)){
                                        $level_adjust = 5;
                                        
                                  }

                                  
                                  $select_cpu = $this->Product_model->getCPUBySocket($socket,$level_adjust);
                                  
                                  $length = count($select_cpu);

                                  if($length > 1 ){
                                    $rand = rand(0,$length-1);
                                  $cpu_id = $select_cpu[$rand]['id'];
                                  }else{
                                  $cpu_id = $select_cpu[0]['id'];
                                  }
                                  //echo '<pre>';var_dump($select_cpu); exit();
                                  $this->session->set_userdata('cpu',$cpu_id);
                                  //gpu
                                  $level_select = $select_gpu[0]['level'];
                                  $level_adjust = $level_select + 1 ;
                                  
                                  if($this->checkLevel($level_adjust)){
                                        $level_adjust = 5;
                                        
                                  }

                                  
                                  $select_gpu = $this->Product_model->getGPUByLevel($level_adjust);
                                  
                                  $length = count($select_gpu);

                                  $gpu_length = count($select_gpu);
                                    if($gpu_length > 1){
                                      $cwhile = 0;
                                      $temp = $select_gpu[$cwhile]['gaming'];

                                      while($temp!='YES'){
                                      $cwhile = $cwhile+1;
                                      $temp = $select_gpu[$cwhile]['gaming'];

                                      echo $cwhile;
                                      }

                                      $select_gpu = $select_gpu[$cwhile];
                                    }else{
                                      $select_gpu = $select_gpu[0];
                                    }
                                    $gpu_id = $select_gpu['id'];
                                  //echo '<pre>';var_dump($select_gpu); exit();
                                  $this->session->set_userdata('gpu',$gpu_id);
                                  $this->session->set_userdata('level',$level_adjust);
                                  

                        }
                                    
                            
          }
            //echo '<pre>';var_dump($ram_id); exit();
            echo '<pre> cpu '; echo $this->session->userdata['cpu'];
            echo '<pre> Mainboard'; echo $this->session->userdata['mainboard'];
            echo '<br> gpu ' ; echo $this->session->userdata['gpu'];
            echo '<br> hdd ' ;echo $this->session->userdata['hdd'];
            echo '<br> ssd ' ;echo $this->session->userdata['ssd'];
            echo '<br> monitor ' ;echo $this->session->userdata['monitor'];
            echo '<br> psu ' ;echo $this->session->userdata['psu'];
            echo '<br> ram ' ;echo $this->session->userdata['ram'];
            echo '<br> cooler ';echo $this->session->userdata['cooler'];
           
            redirect('index.php/products_control/question4');

      }
      public function actionquestion3_2(){

          $this->form_validation->set_rules('multi', 'multi', 'required');
          if($this->form_validation->run() == FALSE) {
              $this->session->set_flashdata('message1','Plese Select Choice<br>');   
            
              redirect('index.php/products_control/question3_2');
          } else 
            {                       
                                    $m = "multimedia";
                                    $this->session->set_userdata('type',$m);
                                    
                                    
                                    $multi = $this->input->post('multi');

                                    $level = $this->session->userdata['level'];
                                    $socket = $this->session->userdata['socket'];
                                    $cpu = $this->session->userdata['cpu'];
                                    $gpu = $this->session->userdata['gpu'];
                                    $mainboard = $this->session->userdata['mainboard'];
                                    $hdd = $this->session->userdata['hdd'];
                                    $ssd = $this->session->userdata['ssd'];
                                    $monitor = $this->session->userdata['monitor'];
                                    $psu = $this->session->userdata['psu'];
                                    $ram = $this->session->userdata['ram'];


                                if($multi == '1'){
                                    $select_cpu = $this->Product_model->getCPUBySocket($socket,$level);
                                    $select_mainboard = $this->Product_model->getMBBySocket($socket,$level);
                                    $select_gpu = $this->Product_model->getGPUByLevel($level);
                                    $select_ssd = $this->Product_model->getSSDByLevel($level);
                                    $select_hdd = $this->Product_model->getHDDByLevel($level);
                                    $select_psu = $this->Product_model->getPSUByLevel($level);
                                    $select_ram = $this->Product_model->getRAMByLevel(3);


                                    $this->session->set_userdata('q32',$multi);
                                    

                                      $level_select = $select_cpu[0]['level'];
                                      $level_adjust = $level_select + 2 ;
                                      
                                      if($this->checkLevel($level_adjust)){
                                            $level_adjust = 5;
                                            
                                      }

                                      
                                      $select_cpu = $this->Product_model->getCPUBySocket($socket,$level_adjust);
                                      
                                      $length = count($select_cpu);

                                      if($length > 1 ){
                                        $rand = rand(0,$length-1);
                                      $cpu_id = $select_cpu[$rand]['id'];
                                      }else{
                                      $cpu_id = $select_cpu[0]['id'];
                                      }
                                      //echo '<pre>';var_dump($select_cpu); exit();
                                      $this->session->set_userdata('cpu',$cpu_id);
                                      //gpu
                                      $level_select = $select_gpu[0]['level'];
                                      $level_adjust = $level_select + 2 ;
                                      
                                      if($this->checkLevel($level_adjust)){
                                            $level_adjust = 5;
                                            
                                      }

                                      
                                      $select_gpu = $this->Product_model->getGPUByLevel($level_adjust);
                                      
                                      $length = count($select_gpu);
                                      //checkfunctiongpu
                                      $gpu_length = count($select_gpu);
                                        if($gpu_length > 1){
                                          $cwhile = 0;
                                          $temp = $select_gpu[$cwhile]['multimedia'];

                                          while($temp!='YES'){
                                          $cwhile = $cwhile+1;
                                          $temp = $select_gpu[$cwhile]['multimedia'];

                                          echo $cwhile;
                                          }

                                          $select_gpu = $select_gpu[$cwhile];

                                        }else{
                                          $select_gpu = $select_gpu[0];
                                        }
                                        $gpu_id = $select_gpu['id'];
                                      //echo '<pre>';var_dump($select_gpu); exit();
                                      $this->session->set_userdata('gpu',$gpu_id);
                                      $this->session->set_userdata('level',$level_adjust);

                                      //mainboard
                                      $level_select = $select_mainboard[0]['level'];
                                      $level_adjust = $level_select + 2 ;
                                      
                                      if($this->checkLevel($level_adjust)){
                                            $level_adjust = 5;
                                            
                                      }

                                      
                                      $select_mainboard = $this->Product_model->getMBBySocket($socket,$level_adjust);
                                      
                                      $length = count($select_mainboard);

                                      if($length > 1 ){
                                        $rand = rand(0,$length-1);
                                      $mainboard_id = $select_mainboard[$rand]['id'];
                                      }else{
                                      $mainboard_id = $select_mainboard[0]['id'];
                                      }
                                      //echo '<pre>';var_dump($select_mainboard); exit();
                                      $this->session->set_userdata('mainboard',$mainboard_id);
                                      $this->session->set_userdata('mb',$level_adjust);
                                      //ssd
                                      $level_select = $select_ssd[0]['level'];
                                      $level_adjust = $level_select + 2 ;
                                      
                                      if($this->checkLevel($level_adjust)){
                                            $level_adjust = 5;
                                            
                                      }

                                      
                                      $select_ssd = $this->Product_model->getSSDByLevel($level_adjust);
                                      
                                      $length = count($select_ssd);

                                      if($length > 1 ){
                                        $rand = rand(0,$length-1);
                                      $ssd_id = $select_ssd[$rand]['id'];
                                      }else{
                                      $ssd_id = $select_ssd[0]['id'];
                                      }
                                      //echo '<pre>';var_dump($select_ssd); exit();
                                      $this->session->set_userdata('ssd',$ssd_id);
                                   
                                      //hdd
                                      $level_select = $select_hdd[0]['level'];
                                      $level_adjust = $level_select + 1 ;
                                      
                                      if($this->checkLevel($level_adjust)){
                                            $level_adjust = 5;
                                            
                                      }

                                      
                                      $select_hdd = $this->Product_model->getHDDByLevel($level_adjust);
                                      
                                      $length = count($select_hdd);

                                      if($length > 1 ){
                                        $rand = rand(0,$length-1);
                                      $hdd_id = $select_hdd[$rand]['id'];
                                      }else{
                                      $hdd_id = $select_hdd[0]['id'];
                                      }
                                      //echo '<pre>';var_dump($select_hdd); exit();
                                      $this->session->set_userdata('hdd',$hdd_id);

                                      //ram
                                      $level_select = $select_ram[0]['level'];
                                      $level_adjust = $level_select + 2 ;
                                      
                                      if($this->checkLevel($level_adjust)){
                                            $level_adjust = 5;
                                            
                                      }

                                      
                                      $select_ram = $this->Product_model->getRAMByLevel($level_adjust);
                                      
                                      $length = count($select_ram);

                                      if($length > 1 ){
                                        $rand = rand(0,$length-1);
                                      $ram_id = $select_ram[$rand]['id'];
                                      }else{
                                      $ram_id = $select_ram[0]['id'];
                                      }
                                      //echo '<pre>';var_dump($select_ram); exit();
                                      $this->session->set_userdata('ram',$ram_id);

                                      //psu
                                      $level_select = $select_psu[0]['level'];
                                      $level_adjust = $level_select + 2 ;
                                      
                                      if($this->checkLevel($level_adjust)){
                                            $level_adjust = 5;
                                            
                                      }

                                      
                                      $select_psu = $this->Product_model->getPSUByLevel($level_adjust);
                                      
                                      $length = count($select_psu);

                                      if($length > 1 ){
                                        $rand = rand(0,$length-1);
                                      $psu_id = $select_psu[$rand]['id'];
                                      }else{
                                      $psu_id = $select_psu[0]['id'];
                                      }
                                      //echo '<pre>';var_dump($select_psu); exit();
                                      $this->session->set_userdata('psu',$psu_id);

                                      redirect('index.php/products_control/question4');
                             
                            }else if($multi == '2'){
                                $select_cpu = $this->Product_model->getCPUBySocket($socket,$level);
                                $select_mainboard = $this->Product_model->getMBBySocket($socket,$level);
                                $select_gpu = $this->Product_model->getGPUByLevel($level);
                                $select_ssd = $this->Product_model->getSSDByLevel($level);
                                $select_hdd = $this->Product_model->getHDDByLevel($level);
                                $select_psu = $this->Product_model->getPSUByLevel($level);
                                $select_ram = $this->Product_model->getRAMByLevel(3);

                                $this->session->set_userdata('q32',$multi);
                                //checkfunctiongpu

                                

                                //uplevel

                                //cpu
                                  $level_select = $select_cpu[0]['level'];
                                  $level_adjust = $level_select + 2 ;
                                  
                                  if($this->checkLevel($level_adjust)){
                                        $level_adjust = 5;
                                        
                                  }

                                  
                                  $select_cpu = $this->Product_model->getCPUBySocket($socket,$level_adjust);
                                  
                                  $length = count($select_cpu);

                                  if($length > 1 ){
                                    $rand = rand(0,$length-1);
                                  $cpu_id = $select_cpu[$rand]['id'];
                                  }else{
                                  $cpu_id = $select_cpu[0]['id'];
                                  }
                                  //echo '<pre>';var_dump($select_cpu); exit();
                                  $this->session->set_userdata('cpu',$cpu_id);
                                  //gpu
                                  $level_select = $select_gpu[0]['level'];
                                  $level_adjust = $level_select + 2 ;
                                  
                                  if($this->checkLevel($level_adjust)){
                                        $level_adjust = 5;
                                        
                                  }

                                  
                                  $select_gpu = $this->Product_model->getGPUByLevel($level_adjust);
                                  //echo '<pre>';var_dump($select_gpu); exit();
                                  $length = count($select_gpu);

                                  $gpu_length = count($select_gpu);
                                    if($gpu_length > 1){
                                      $cwhile = 0;
                                      $temp = $select_gpu[$cwhile]['multimedia'];

                                      while($temp!='YES'){
                                      $cwhile = $cwhile+1;
                                      $temp = $select_gpu[$cwhile]['multimedia'];

                                      echo $cwhile;
                                      }

                                      $select_gpu = $select_gpu[$cwhile];
                                      //echo '<pre>';var_dump($select_gpu); exit();
                                    }else{
                                      $select_gpu = $select_gpu[0];
                                    }
                                    $gpu_id = $select_gpu['id'];
                                  //echo '<pre>';var_dump($select_gpu); exit();
                                  $this->session->set_userdata('gpu',$gpu_id);
                                  $this->session->set_userdata('level',$level_adjust);

                                  //mainboard
                                  $level_select = $select_mainboard[0]['level'];
                                  $level_adjust = $level_select + 1 ;
                                  
                                  if($this->checkLevel($level_adjust)){
                                        $level_adjust = 5;
                                        
                                  }

                                  
                                  $select_mainboard = $this->Product_model->getMBBySocket($socket,$level_adjust);
                                  
                                  $length = count($select_mainboard);

                                  if($length > 1 ){
                                    $rand = rand(0,$length-1);
                                  $mainboard_id = $select_mainboard[$rand]['id'];
                                  }else{
                                  $mainboard_id = $select_mainboard[0]['id'];
                                  }
                                  //echo '<pre>';var_dump($select_mainboard); exit();
                                  $this->session->set_userdata('mainboard',$mainboard_id);
                                  $this->session->set_userdata('mb',$level_adjust);
                                  //ssd
                                  $level_select = $select_ssd[0]['level'];
                                  $level_adjust = $level_select + 2 ;
                                  
                                  if($this->checkLevel($level_adjust)){
                                        $level_adjust = 5;
                                        
                                  }

                                  
                                  $select_ssd = $this->Product_model->getSSDByLevel($level_adjust);
                                  
                                  $length = count($select_ssd);

                                  if($length > 1 ){
                                    $rand = rand(0,$length-1);
                                  $ssd_id = $select_ssd[$rand]['id'];
                                  }else{
                                  $ssd_id = $select_ssd[0]['id'];
                                  }
                                  //echo '<pre>';var_dump($select_ssd); exit();
                                  $this->session->set_userdata('ssd',$ssd_id);
                               
                                  //hdd
                                  $level_select = $select_hdd[0]['level'];
                                  $level_adjust = $level_select + 2 ;
                                  
                                  if($this->checkLevel($level_adjust)){
                                        $level_adjust = 5;
                                        
                                  }

                                  
                                  $select_hdd = $this->Product_model->getHDDByLevel($level_adjust);
                                  
                                  $length = count($select_hdd);

                                  if($length > 1 ){
                                    $rand = rand(0,$length-1);
                                  $hdd_id = $select_hdd[$rand]['id'];
                                  }else{
                                  $hdd_id = $select_hdd[0]['id'];
                                  }
                                  //echo '<pre>';var_dump($select_hdd); exit();
                                  $this->session->set_userdata('hdd',$hdd_id);

                                  //ram
                                  $level_select = $select_ram[0]['level'];
                                  $level_adjust = $level_select + 2 ;
                                  
                                  if($this->checkLevel($level_adjust)){
                                        $level_adjust = 5;
                                        
                                  }

                                  
                                  $select_ram = $this->Product_model->getRAMByLevel($level_adjust);
                                  
                                  $length = count($select_ram);

                                  if($length > 1 ){
                                    $rand = rand(0,$length-1);
                                  $ram_id = $select_ram[$rand]['id'];
                                  }else{
                                  $ram_id = $select_ram[0]['id'];
                                  }
                                  //echo '<pre>';var_dump($select_ram); exit();
                                  $this->session->set_userdata('ram',$ram_id);

                                  //psu
                                  $level_select = $select_psu[0]['level'];
                                  $level_adjust = $level_select + 1 ;
                                  
                                  if($this->checkLevel($level_adjust)){
                                        $level_adjust = 5;
                                        
                                  }

                                  
                                  $select_psu = $this->Product_model->getPSUByLevel($level_adjust);
                                  
                                  $length = count($select_psu);

                                  if($length > 1 ){
                                    $rand = rand(0,$length-1);
                                  $psu_id = $select_psu[$rand]['id'];
                                  }else{
                                  $psu_id = $select_psu[0]['id'];
                                  }
                                  //echo '<pre>';var_dump($select_psu); exit();
                                  $this->session->set_userdata('psu',$psu_id);

                                  redirect('index.php/products_control/question4');
                            }else if($multi =='3'){
                                  
                                $select_cpu = $this->Product_model->getCPUBySocket($socket,$level);
                                $select_mainboard = $this->Product_model->getMBBySocket($socket,$level);
                                $select_gpu = $this->Product_model->getGPUByLevel($level);
                                $select_ssd = $this->Product_model->getSSDByLevel($level);
                                $select_hdd = $this->Product_model->getHDDByLevel($level);
                                $select_psu = $this->Product_model->getPSUByLevel($level);
                                $select_ram = $this->Product_model->getRAMByLevel(3);

                                $this->session->set_userdata('q32',$multi);
                                //checkfunctiongpu

                                

                                //uplevel

                                //cpu
                                  $level_select = $select_cpu[0]['level'];
                                  $level_adjust = $level_select + 1 ;
                                  
                                  if($this->checkLevel($level_adjust)){
                                        $level_adjust = 5;
                                        
                                  }

                                  
                                  $select_cpu = $this->Product_model->getCPUBySocket($socket,$level_adjust);
                                  
                                  $length = count($select_cpu);

                                  if($length > 1 ){
                                    $rand = rand(0,$length-1);
                                  $cpu_id = $select_cpu[$rand]['id'];
                                  }else{
                                  $cpu_id = $select_cpu[0]['id'];
                                  }
                                  //echo '<pre>';var_dump($select_cpu); exit();
                                  $this->session->set_userdata('cpu',$cpu_id);
                                  //gpu
                                  $level_select = $select_gpu[0]['level'];
                                  $level_adjust = $level_select + 0 ;
                                  
                                  if($this->checkLevel($level_adjust)){
                                        $level_adjust = 5;
                                        
                                  }

                                  
                                  $select_gpu = $this->Product_model->getGPUByLevel($level_adjust);
                                  
                                  $length = count($select_gpu);
                                  //echo '<pre>';var_dump($select_gpu);
                                  $gpu_length = count($select_gpu);
                                    if($gpu_length > 1){
                                      $cwhile = 0;
                                      $temp = $select_gpu[$cwhile]['multimedia'];

                                      while($temp!='YES'){
                                      $cwhile = $cwhile+1;
                                      $temp = $select_gpu[$cwhile]['multimedia'];

                                      echo $cwhile;
                                      }
                                      $select_gpu = $select_gpu[$cwhile];
                                      
                                      
                                    }else{
                                      $select_gpu = $select_gpu[0];
                                    }
                                    
                                       
                                    $gpu_id = $select_gpu['id'];
                                  //echo '<pre> 2 ';var_dump($select_gpu); exit();
                                  $this->session->set_userdata('gpu',$gpu_id);
                                  $this->session->set_userdata('level',$level_adjust);

                                  //mainboard
                                  $level_select = $select_mainboard[0]['level'];
                                  $level_adjust = $level_select + 0 ;
                                  
                                  if($this->checkLevel($level_adjust)){
                                        $level_adjust = 5;
                                        
                                  }

                                  
                                  $select_mainboard = $this->Product_model->getMBBySocket($socket,$level_adjust);
                                  
                                  $length = count($select_mainboard);

                                  if($length > 1 ){
                                    $rand = rand(0,$length-1);
                                  $mainboard_id = $select_mainboard[$rand]['id'];
                                  }else{
                                  $mainboard_id = $select_mainboard[0]['id'];
                                  }
                                  //echo '<pre>';var_dump($select_mainboard); exit();
                                  $this->session->set_userdata('mainboard',$mainboard_id);
                                  $this->session->set_userdata('mb',$level_adjust);
                                  //ssd
                                  $level_select = $select_ssd[0]['level'];
                                  $level_adjust = $level_select + 1 ;
                                  
                                  if($this->checkLevel($level_adjust)){
                                        $level_adjust = 5;
                                        
                                  }

                                  
                                  $select_ssd = $this->Product_model->getSSDByLevel($level_adjust);
                                  
                                  $length = count($select_ssd);

                                  if($length > 1 ){
                                    $rand = rand(0,$length-1);
                                  $ssd_id = $select_ssd[$rand]['id'];
                                  }else{
                                  $ssd_id = $select_ssd[0]['id'];
                                  }
                                  //echo '<pre>';var_dump($select_ssd); exit();
                                  $this->session->set_userdata('ssd',$ssd_id);
                               
                                  //hdd
                                  $level_select = $select_hdd[0]['level'];
                                  $level_adjust = $level_select + 1 ;
                                  
                                  if($this->checkLevel($level_adjust)){
                                        $level_adjust = 5;
                                        
                                  }

                                  
                                  $select_hdd = $this->Product_model->getHDDByLevel($level_adjust);
                                  
                                  $length = count($select_hdd);

                                  if($length > 1 ){
                                    $rand = rand(0,$length-1);
                                  $hdd_id = $select_hdd[$rand]['id'];
                                  }else{
                                  $hdd_id = $select_hdd[0]['id'];
                                  }
                                  //echo '<pre>';var_dump($select_hdd); exit();
                                  $this->session->set_userdata('hdd',$hdd_id);

                                  //ram
                                  $level_select = $select_ram[0]['level'];
                                  $level_adjust = $level_select + 1 ;
                                  
                                  if($this->checkLevel($level_adjust)){
                                        $level_adjust = 5;
                                        
                                  }

                                  
                                  $select_ram = $this->Product_model->getRAMByLevel($level_adjust);
                                  
                                  $length = count($select_ram);

                                  if($length > 1 ){
                                    $rand = rand(0,$length-1);
                                  $ram_id = $select_ram[$rand]['id'];
                                  }else{
                                  $ram_id = $select_ram[0]['id'];
                                  }
                                  //echo '<pre>';var_dump($select_ram); exit();
                                  $this->session->set_userdata('ram',$ram_id);

                                  //psu
                                  $level_select = $select_psu[0]['level'];
                                  $level_adjust = $level_select + 0 ;
                                  
                                  if($this->checkLevel($level_adjust)){
                                        $level_adjust = 5;
                                        
                                  }

                                  
                                  $select_psu = $this->Product_model->getPSUByLevel($level_adjust);
                                  
                                  $length = count($select_psu);

                                  if($length > 1 ){
                                    $rand = rand(0,$length-1);
                                  $psu_id = $select_psu[$rand]['id'];
                                  }else{
                                  $psu_id = $select_psu[0]['id'];
                                  }
                                  //echo '<pre>';var_dump($select_psu); exit();
                                  $this->session->set_userdata('psu',$psu_id);

                                  redirect('index.php/products_control/question4');

                            }

              }
      }
      public function actionquestion4(){
          $this->form_validation->set_rules('air', 'air', 'required');
          if($this->form_validation->run() == FALSE) {
              $this->session->set_flashdata('message1','Plese Select Choice<br>');   
            
              redirect('index.php/products_control/question4');
          }else 
            {
                    $air = $this->input->post('air');

                    
                    $cooler = $this->session->userdata['cooler'];

                    $select_cooler = $this->Product_model->getCoolerByLevel($cooler);
                    if($air == '1'){
                        
                      $this->session->set_userdata('q4',$air);
                        //uplevel

                        //cpu
                                $level_select = $select_cooler[0]['level'];
                                $level_adjust = $level_select - 1 ;
                                
                                if($this->checkLevel($level_adjust)){
                                      $level_adjust = 1;
                                      
                                }

                                
                                $select_cooler = $this->Product_model->getCoolerByLevel($level_adjust);
                                
                                $length = count($select_cooler);

                                
                                $cooler_id = $select_cooler[0]['id'];
                                
                                //echo '<pre>';var_dump($select_cpu); exit();
                                $this->session->set_userdata('cooler',$cooler_id);
                                redirect('index.php/products_control/question5');
       
                    }else if($air == '2'){
                                $this->session->set_userdata('q4',$air);
                                $level_select = $select_cooler[0]['level'];
                                $level_adjust = $level_select + 2 ;
                                
                                if($this->checkLevel($level_adjust)){
                                      $level_adjust = 5;
                                      
                                }

                                
                                $select_cooler = $this->Product_model->getCoolerByLevel($level_adjust);
                                
                                $length = count($select_cooler);

                                
                                $cooler_id = $select_cooler[0]['id'];
                                
                                //echo '<pre>';var_dump($select_cpu); exit();
                                $this->session->set_userdata('cooler',$cooler_id);
                                redirect('index.php/products_control/question5');
                      }else if($air =='3'){
                          $this->session->set_userdata('q4',$air);
                           $level_select = $select_cooler[0]['level'];
                                $level_adjust = $level_select + 1 ;
                                
                                if($this->checkLevel($level_adjust)){
                                      $level_adjust = 5;
                                      
                                }

                                
                                $select_cooler = $this->Product_model->getCoolerByLevel($level_adjust);
                                
                                $length = count($select_cooler);

                                
                                $cooler_id = $select_cooler[0]['id'];
                                
                                //echo '<pre>';var_dump($select_cpu); exit();
                                $this->session->set_userdata('cooler',$cooler_id);
                                redirect('index.php/products_control/question5');
                      }
          }
      }
      public function actionquestion5(){
          $this->form_validation->set_rules('time', 'time', 'required');
          if($this->form_validation->run() == FALSE) {
                    $this->session->set_flashdata('message1','Plese Select Choice<br>');   
            
                    redirect('index.php/products_control/question5');
          } else 
            {
                  $time = $this->input->post('time');

                  $psu = $this->session->userdata['psu'];
                  $cooler = $this->session->userdata['cooler'];

                  $select_psu = $this->Product_model->getPSUByLevel($psu);
                  $select_cooler = $this->Product_model->getCoolerByLevel($cooler);

                  if($time == '1'){
                      $this->session->set_userdata('q5',$time);

                      //psu
                              
                      //cooler
                              $level_select = $select_cooler[0]['level'];
                              $level_adjust = $level_select - 1 ;
                              
                              if($this->checkLevel($level_adjust)){
                                    $level_adjust = 1;
                                    
                              }

                              
                              $select_cooler = $this->Product_model->getCoolerByLevel($level_adjust);
                              
                              $length = count($select_cooler);

                              
                              $cooler_id = $select_cooler[0]['id'];
                              
                              //echo '<pre>';var_dump($select_cpu); exit();
                              $this->session->set_userdata('cooler',$cooler_id);
                              redirect('index.php/products_control/question6');
               
                  }else if($time == '2'){
                              $this->session->set_userdata('q5',$time);
                              $level_select = $select_cooler[0]['level'];
                              $level_adjust = $level_select + 1 ;
                              
                              if($this->checkLevel($level_adjust)){
                                    $level_adjust = 5;
                                    
                              }

                              
                              $select_cooler = $this->Product_model->getCoolerByLevel($level_adjust);
                              
                              $length = count($select_cooler);

                              
                              $cooler_id = $select_cooler[0]['id'];
                              
                              //echo '<pre>';var_dump($select_cpu); exit();
                              $this->session->set_userdata('cooler',$cooler_id);
                              redirect('index.php/products_control/question6');
                    }else if($time =='3'){
                              $this->session->set_userdata('q5',$time);
                              //psu
                              $level_select = $select_psu[0]['level'];
                              $level_adjust = $level_select + 1 ;
                              
                              if($this->checkLevel($level_adjust)){
                                    $level_adjust = 5;
                                    
                              }
                             
                              $select_psu = $this->Product_model->getPSUByLevel($level_adjust);
                              
                              $length = count($select_psu);

                              
                              $psu_id = $select_psu[0]['id'];

                              $this->session->set_userdata('psu',$psu_id);
                              $level_select = $select_cooler[0]['level'];
                              $level_adjust = $level_select + 1 ;
                              
                              if($this->checkLevel($level_adjust)){
                                    $level_adjust = 5;
                                    
                              }

                              
                              $select_cooler = $this->Product_model->getCoolerByLevel($level_adjust);
                              
                              $length = count($select_cooler);

                              
                              $cooler_id = $select_cooler[0]['id'];

                              $this->session->set_userdata('cooler',$cooler_id);
                              redirect('index.php/products_control/question6');
                    }else if($time =='4'){
                              $this->session->set_userdata('q5',$time);
                              //psu
                              $level_select = $select_psu[0]['level'];
                              $level_adjust = $level_select + 1 ;
                              
                              if($this->checkLevel($level_adjust)){
                                    $level_adjust = 5;
                                    
                              }

                              
                              $select_psu = $this->Product_model->getPSUByLevel($level_adjust);
                              
                              $length = count($select_psu);

                              
                              $psu_id = $select_psu[0]['id'];
                              
                              //echo '<pre>';var_dump($select_psu); exit();
                              $this->session->set_userdata('psu',$psu_id);
                              $level_select = $select_cooler[0]['level'];
                              $level_adjust = $level_select + 2 ;
                              
                              if($this->checkLevel($level_adjust)){
                                    $level_adjust = 5;
                                    
                              }

                              
                              $select_cooler = $this->Product_model->getCoolerByLevel($level_adjust);
                              
                              $length = count($select_cooler);

                              
                              $cooler_id = $select_cooler[0]['id'];
                              
                              //echo '<pre>';var_dump($select_cooler); exit();
                              $this->session->set_userdata('cooler',$cooler_id);
                              redirect('index.php/products_control/question6');
                    }
            }
      }
      public function actionquestion6(){
          $this->form_validation->set_rules('monitor', 'monitor', 'required');
          if($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('message1','Plese Select Choice<br>');   
            
                redirect('index.php/products_control/question6');
          } else 
            {
                  $monitor = $this->input->post('monitor');
                  $gpu = $this->session->userdata('gpu');
                  $type = $this->session->userdata('type');
                  $level = $this->session->userdata('level');

                  $select_monitor = $this->Product_model->getMonitorByLevel($level);
                  $select_gpu = $this->Product_model->getID_GPU($gpu);

                  if($monitor == '1'){
                      $this->session->set_userdata('q6',$monitor);

                      //gpu
                                     
                                      if($type == 'office'){

                                          $select_monitor = $this->Product_model->getMonitorByLevel(1);
                                          $monitor_id = $select_monitor[0]['id'];

                                          
                                          $level = $this->session->userdata['level'];
                                          $socket = $this->session->userdata['socket'];
                                          $cpu = $this->session->userdata['cpu'];
                                          $gpu = $this->session->userdata['gpu'];
                                          $hdd = $this->session->userdata['hdd'];
                                          $ssd = $this->session->userdata['ssd'];
                                          $mainboard = $this->session->userdata['mainboard'];
                                          $monitor = $this->session->userdata['monitor'];
                                          $psu = $this->session->userdata['psu'];
                                          $ram = $this->session->userdata['ram'];
                                          $cooler = $this->session->userdata['cooler'];

                                          
                                          
                                          $type = $this->input->post('type');
                                          $select_cpu = $this->Product_model->getID_CPU($cpu);
                                          
                                          if($level > 3){
                                                $level_adjust = 3;
                                          }else{
                                                $level_adjust = $level;
                                          }
                 //cpu
                                          $select_cpu = $this->Product_model->getCPUBySocket($socket,$level_adjust);
                                          $length = count($select_cpu);

                                          if($length > 1 ){
                                            $rand = rand(0,$length-1);
                                          $cpu_id = $select_cpu[$rand]['id'];
                                          }else{
                                          $cpu_id = $select_cpu[0]['id'];
                                          }

                                          $this->session->set_userdata('cpu',$cpu_id);
                                          //gpu
                                          $select_gpu = $this->Product_model->getID_GPU($gpu);
                                          if($level > 2){
                                                $level_adjust = 2;
                                          }else{
                                                $level_adjust = $level;
                                          }

                                          $select_gpu = $this->Product_model->getGPUByLevel($level_adjust);
                                          $length = count($select_gpu);
                                          if($length > 1 ){
                                            $rand = rand(0,$length-1);
                                          $gpu_id = $select_gpu[$rand]['id'];
                                          }else{
                                          $gpu_id = $select_gpu[0]['id'];
                                          }
                                          $this->session->set_userdata('gpu',$gpu_id);
                                          //mainboard
                                          $select_mainboard = $this->Product_model->getID_MB($mainboard);
                                          if($level > 2){
                                                $level_adjust = 2;
                                          }else{
                                                $level_adjust = $level;
                                          }
                                          
                                          $select_mainboard = $this->Product_model->getMBBySocket($socket,$level_adjust);
                                          $length = count($select_mainboard);

                                          if($length > 1 ){
                                            $rand = rand(0,$length-1);
                                          $mainboard_id = $select_mainboard[$rand]['id'];
                                          }else{
                                          $mainboard_id = $select_mainboard[0]['id'];
                                          }

                                          $this->session->set_userdata('mainboard',$mainboard_id);
                                          //ssd
                                          $select_ssd = $this->Product_model->getID_SSD($ssd);
                                          if($level > 2){
                                                $level_adjust = 2;
                                          }else{
                                                $level_adjust = $level;
                                          }
                                          $select_ssd = $this->Product_model->getSSDByLevel($level_adjust);
                                          $length = count($select_ssd);
                                          if($length > 1 ){
                                            $rand = rand(0,$length-1);
                                          $ssd_id = $select_ssd[$rand]['id'];
                                          }else{
                                          $ssd_id = $select_ssd[0]['id'];
                                          }
                                          $this->session->set_userdata('ssd',$ssd_id);
                                          //psu
                                          $select_psu = $this->Product_model->getID_PSU($psu);
                                          if($level > 2){
                                                $level_adjust = 2;
                                          }else{
                                                $level_adjust = $level;
                                          }
                                          $select_psu = $this->Product_model->getPSUByLevel($level_adjust);
                                          $length = count($select_psu);
                                          if($length > 1 ){
                                            $rand = rand(0,$length-1);
                                          $psu_id = $select_psu[$rand]['id'];
                                          }else{
                                          $psu_id = $select_psu[0]['id'];
                                          }
                                          $this->session->set_userdata('psu',$psu_id);
                                          //hdd
                                          $select_hdd = $this->Product_model->getID_HDD($hdd);
                                          if($level > 2){
                                                $level_adjust = 2;
                                          }else{
                                                $level_adjust = $level;
                                          }
                                          $select_hdd = $this->Product_model->getHDDByLevel($level_adjust);
                                          $length = count($select_hdd);
                                          if($length > 1 ){
                                            $rand = rand(0,$length-1);
                                          $hdd_id = $select_hdd[$rand]['id'];
                                          }else{
                                          $hdd_id = $select_hdd[0]['id'];
                                          }
                                          $this->session->set_userdata('hdd',$hdd_id);

                                          $select_ram = $this->Product_model->getID_RAM($ram);
                                          if($level > 3){
                                                $level_adjust = 3;
                                          }else{
                                                $level_adjust = 3;
                                          }

                                          $select_ram = $this->Product_model->getRAMByLevel($level_adjust);
                                          $length = count($select_ram);
                                          if($length > 1 ){
                                            $rand = rand(0,$length-1);
                                          $ram_id = $select_ram[$rand]['id'];
                                          }else{
                                          $ram_id = $select_ram[0]['id'];
                                          }
                                          $this->session->set_userdata('ram',$ram_id);

                                          $select_cooler = $this->Product_model->getID_Cooler($cooler);
                                          if($level > 2){
                                                $level_adjust = 2;
                                          }else{
                                                $level_adjust = $level;
                                          }

                                          $select_cooler = $this->Product_model->getCoolerByLevel($level_adjust);
                                          $length = count($select_cooler);
                                          if($length > 1 ){
                                            $rand = rand(0,$length-1);
                                          $cooler_id = $select_cooler[$rand]['id'];
                                          }else{
                                          $cooler_id = $select_cooler[0]['id'];
                                          }
                                          $this->session->set_userdata('cooler',$cooler_id);

                                          
                                      }else{
                                          $length = count($select_monitor);
                                      //checkfunctionmonitor
                                          $monitor_length = count($select_monitor);
                                          //echo '<pre>';var_dump($select_monitor); exit();
                                              if($monitor_length > 1){
                                                  $cwhile = 0;
                                                  $temp = $select_monitor[$cwhile][$type];
                                                  //var_dump($temp); exit();
                                                  while($temp!='YES'){
                                                  $cwhile = $cwhile+1;
                                                  $temp = $select_monitor[$cwhile][$type];

                                                  echo $cwhile; 
                                                  }

                                                  $select_monitor = $select_monitor[$cwhile];

                                                  $monitor_id = $select_monitor['id'];
                                                  //echo '<pre>';var_dump($monitor_id); exit();
                                              }else{
                                                  //
                                                  $monitor_id = $select_monitor[0]['id'];
                                                  //echo '<pre>';var_dump($monitor_id); exit();
                                              }
                                        

                                      }
                                      
                                      
                                      //echo '<pre>';var_dump($ram_id); exit();
                                      $this->session->set_userdata('monitor',$monitor_id);
                                      
                                      //var_dump($this->session->userdata('monitor')); exit();
                              
                              redirect('index.php/products_control/question7');
                        

                  }else if($monitor == '2'){
                              $this->session->set_userdata('q6',$monitor);
                              $n = 'NO';
                              $this->session->set_userdata('nomonitor',$n);
                              redirect('index.php/products_control/question7');
                    }
            }
      }
      public function actionquestion7(){
          $this->form_validation->set_rules('wifi', 'wifi', 'required');
          if($this->form_validation->run() == FALSE) {
                  $this->session->set_flashdata('message1','Plese Select Choice<br>');   
            
                  redirect('index.php/products_control/question7');
          } else 
            {
                  $wifi = $this->input->post('wifi');

                  $mainboard = $this->session->userdata('mainboard');

                  var_dump($mainboard);
                  $level = $this->session->userdata('mb');
                  $socket = $this->session->userdata('socket');

                  
                  $select_mainboard = $this->Product_model->getID_MB($mainboard);

                  if($wifi == '1'){
                      $this->session->set_userdata('q7',$wifi);

                      //mainboard
                                      
                                      //checkmainboardwifi
                                      
                                        if($select_mainboard[0]['WIFI']=='YES'){
                                            redirect('index.php/products_control/receipt');
                                        }else{

                                            $select_mainboard = $this->Product_model->getMBBySocket($socket,$level);
                                            $mb_length = count($select_mainboard);

                                            $temp = $select_mainboard[0]['WIFI'];
                                            while($temp!='YES'){

                                                      for($i=0;$i<$mb_length;$i++){

                                                          $temp = $select_mainboard[$i]['WIFI'];
                                                          if($temp=='YES'){
                                                            $select_mainboard = $select_mainboard[$i];
                                                            break;
                                                          }

                                                      }

                                                      if($temp != 'YES'){
                                                        $level = $level + 1;
                                                        $select_mainboard = $this->Product_model->getMBBySocket($socket,$level);
                                                        $mb_length = count($select_mainboard);
                                                      }

                                            }
                                            $mainboard = $select_mainboard['id'];


                                      
                                    }

                              $this->session->set_userdata('mainboard',$mainboard);
                              redirect('index.php/products_control/receipt');
                        

                  }else if($wifi == '2'){
                              $this->session->set_userdata('q7',$wifi);
                              redirect('index.php/products_control/receipt');
                    }
            }
      }
      public function question1(){
          $this->session->unset_userdata('level');
          $this->session->unset_userdata('type');
          $this->session->unset_userdata('cpu');
          $this->session->unset_userdata('gpu');
          $this->session->unset_userdata('mainboard');
          $this->session->unset_userdata('hdd');
          $this->session->unset_userdata('monitor');
          $this->session->unset_userdata('gpu');
          $this->session->unset_userdata('psu');
          $this->session->unset_userdata('ram');
          $this->session->unset_userdata('ssd');
          $this->session->unset_userdata('cooler');
          $this->session->unset_userdata('nomonitor');

          $this->session->unset_userdata('q1');
          $this->session->unset_userdata('q2');
          $this->session->unset_userdata('q3');
          $this->session->unset_userdata('q31');
          $this->session->unset_userdata('q32');
          $this->session->unset_userdata('q4');
          $this->session->unset_userdata('q5');
          $this->session->unset_userdata('q6');
          $this->session->unset_userdata('q7');
          
        $this->load->view('question/question1');
      }
      public function question2(){
        $this->load->view('question/question2');
      }
      public function question3(){
        $this->load->view('question/question3');  
      }
      public function question3_1(){
        $this->load->view('question/question3_1');  
      }
      public function question3_2(){
        $this->load->view('question/question3_2');  
      }
      public function question4(){
        $this->load->view('question/question4');
      }
      public function question5(){
        $this->load->view('question/question5');
      }
      public function question6(){
        $this->load->view('question/question6');
      }
      public function question7(){
        $this->load->view('question/question7');
      }
      public function result(){


          if(!isset($this->session->userdata['level'])){
              $this->session->set_flashdata('message1','Unable to go backward');
              $this->load->view('question/question1');
          }else{
                  $cpu = $this->session->userdata['cpu'];
                  $arr['cpu']= $this->Product_model->getID_CPU($cpu);

                  $price_cpu = $arr['cpu'][0]['price'];

                  //var_dump($price_cpu); exit();
                  $gpu = $this->session->userdata['gpu'];
                  $arr['gpu']= $this->Product_model->getID_GPU($gpu);

                  $price_gpu = $arr['gpu'][0]['price'];

                  $hdd = $this->session->userdata['hdd'];
                  $arr['hdd']= $this->Product_model->getID_HDD($hdd);

                  $price_hdd = $arr['hdd'][0]['price'];

                  $mainboard = $this->session->userdata['mainboard'];
                  $arr['mainboard']= $this->Product_model->getID_MB($mainboard);

                  $price_mainboard = $arr['mainboard'][0]['price'];

                  $ssd = $this->session->userdata['ssd'];
                  $arr['ssd']= $this->Product_model->getID_SSD($ssd);

                  $price_ssd = $arr['ssd'][0]['price'];

                  $monitor = $this->session->userdata['monitor'];
                  $arr['monitor']= $this->Product_model->getID_Monitor($monitor);

                  $price_monitor = $arr['monitor'][0]['price'];

                  $psu = $this->session->userdata['psu'];
                  $arr['psu']= $this->Product_model->getID_PSU($psu);

                  $price_psu = $arr['psu'][0]['price'];

                  $ram = $this->session->userdata['ram'];
                  $arr['ram']= $this->Product_model->getID_RAM($ram);

                  $price_ram = $arr['ram'][0]['price'];

                  $cooler = $this->session->userdata['cooler'];
                  $arr['cooler']= $this->Product_model->getID_Cooler($cooler);

                  $price_cooler = $arr['cooler'][0]['price'];

                  $total = $price_cpu + $price_gpu + $price_hdd + $price_mainboard + $price_ssd + $price_monitor + $price_psu + $price_ram + $price_cooler;
                  $arr['result'] = $total;

                  //echo '<pre>' ;var_dump($arr); exit();

                  $this->load->view('question/result',$arr);
          }
         
      }
      public function tutorial(){
          $this->load->view('question/tutorial');
      }
      public function sessiontest(){
          $this->load->view('footer');
      }
      public function updatecpu(){          
              $id = $this->input->post('id');
                          $this->form_validation->set_rules('name', 'name', 'trim|required|min_length[2]|max_length[32]');
                          $this->form_validation->set_rules('socket', 'socket', 'trim|required|min_length[3]|max_length[32]');
                          $this->form_validation->set_rules('core', 'core', 'trim|required|min_length[1]|max_length[2]');
                          $this->form_validation->set_rules('thread', 'thread', 'trim|required|min_length[1]|max_length[2]');
                          $this->form_validation->set_rules('frequency', 'frequency', 'trim|required|min_length[1]|max_length[32]');
                          $this->form_validation->set_rules('level', 'level', 'trim|required|min_length[1]|max_length[32]');
                          $this->form_validation->set_rules('price', 'price', 'trim|required|min_length[4]|max_length[10]');
                          if($this->form_validation->run() == FALSE) {            
                          $cpu = $this->Product_model->getID_CPU($id);
                          $arr['cpu'] = $cpu;
                          $this->load->view('edit/editcpu',$arr);
                         } else {
                            $name = $this->input->post('name');
                            $socket = $this->input->post('socket');
                            $core = $this->input->post('core');
                            $thread = $this->input->post('thread');
                            $frequency = $this->input->post('frequency');
                            $level = $this->input->post('level');
                            $price = $this->input->post('price');
                            $gaming = $this->input->post('gaming');
                            $multimedia = $this->input->post('multimedia');
                            $office = $this->input->post('office');
                            //print_r($password); exit();

                            if($gaming == 'gaming'){
                               $gaming = 'YES';
                            }else{
                              $gaming = 'NO';
                            }
                            if($multimedia == 'multimedia'){
                              $multimedia = 'YES';
                            }else{
                              $multimedia = 'NO';
                            }
                            if($office == 'office'){
                              $office = 'YES';
                            }else{
                              $office = 'NO';
                            }                    
                                    $data = array(
                                      'id' => $id,
                                      'name' => $name,
                                      'socket' => $socket,
                                      'core' => $core,
                                      'thread' => $thread,
                                      'frequency' => $frequency,
                                      'level' => $level,
                                      'price' => $price,
                                      'gaming' => $gaming,
                                      'multimedia' => $multimedia,
                                      'office' => $office,
                                    );
                              $this->Product_model->update_cpu($data);    
                              $cpu = $this->Product_model->getCPU();              
                              $arr['cpu'] = $cpu;                            
                  redirect('index.php/products_control/showcpu'); 
                }
                
                    
      }
      public function updategpu(){
          
              $id = $this->input->post('id');

                          $this->form_validation->set_rules('name', 'name', 'trim|required|min_length[2]|max_length[32]');
                          $this->form_validation->set_rules('model', 'model', 'trim|required|min_length[3]|max_length[32]');
                          $this->form_validation->set_rules('powerusage', 'powerusage', 'trim|required|min_length[3]|max_length[4]');
                          
                          $this->form_validation->set_rules('level', 'level', 'trim|required|min_length[1]|max_length[32]');
                          $this->form_validation->set_rules('price', 'price', 'trim|required|min_length[4]|max_length[10]');
                          $this->form_validation->set_rules('HDMI', 'HDMI', 'trim|min_length[1]|max_length[4]');
                          $this->form_validation->set_rules('DP', 'DP', 'trim|min_length[1]|max_length[2]');
                          $this->form_validation->set_rules('DVI', 'DVI', 'trim|min_length[1]|max_length[3]');
                          $this->form_validation->set_rules('VGA', 'VGA', 'trim|min_length[1]|max_length[3]');
                         
                          
                               

                          if($this->form_validation->run() == FALSE) {

                           
                          $gpu = $this->Product_model->getID_GPU($id);
                          $arr['gpu'] = $gpu;

                          $this->load->view('edit/editgpu',$arr);
                           //redirect('index.php/showall/edit/'.$id);


                         } else {

                            $name = $this->input->post('name');
                            $model = $this->input->post('model');
                            $powerusage = $this->input->post('powerusage');
                           
                            $level = $this->input->post('level');
                            $price = $this->input->post('price');
                            $gaming = $this->input->post('gaming');
                            $multimedia = $this->input->post('multimedia');
                            $office = $this->input->post('office');
                            $HDMI = $this->input->post('HDMI');
                            $DP = $this->input->post('DP');
                            $DVI = $this->input->post('DVI');
                            $VGA = $this->input->post('VGA');

                            //print_r($password); exit();

                            if($gaming == 'gaming'){
                               $gaming = 'YES';
                            }else{
                              $gaming = 'NO';
                            }
                            if($multimedia == 'multimedia'){
                              $multimedia = 'YES';
                            }else{
                              $multimedia = 'NO';
                            }
                            if($office == 'office'){
                              $office = 'YES';
                            }else{
                              $office = 'NO';
                            }
                            if($HDMI == 'HDMI'){
                               $HDMI = 'YES';
                            }else{
                              $HDMI = 'NO';
                            }
                            if($DP == 'DP'){
                              $DP = 'YES';
                            }else{
                              $DP = 'NO';
                            }
                            if($DVI == 'DVI'){
                              $DVI = 'YES';
                            }else{
                              $DVI = 'NO';
                            }
                            if($VGA == 'VGA'){
                              $VGA = 'YES';
                            }else{
                              $VGA = 'NO';
                            }
                           
                            //var_dump($HDMI); exit();

                                    $data = array(
                                      'id' => $id,
                                      'name' => $name,
                                      'model' => $model,
                                      'powerusage' => $powerusage,         
                                      'level' => $level,
                                      'price' => $price,
                                      'gaming' => $gaming,
                                      'multimedia' => $multimedia,
                                      'office' => $office,
                                      'HDMI' => $HDMI,
                                      'DP' => $DP,
                                      'DVI' => $DVI,
                                      'VGA' => $VGA,
                                    );

                              $this->Product_model->update_gpu($data);
                              
                              $gpu = $this->Product_model->getGPU();
                             
                  
                  redirect('index.php/products_control/showgpu');
                  
                }
                
          
      }
      public function updatemainboard(){
          
              $id = $this->input->post('id');

                          $this->form_validation->set_rules('name', 'name', 'trim|required|min_length[2]|max_length[32]');
                          $this->form_validation->set_rules('socket', 'socket', 'trim|required|min_length[3]|max_length[32]');
                          $this->form_validation->set_rules('model', 'model', 'trim|required|min_length[1]|max_length[32]');
                          $this->form_validation->set_rules('chipset', 'chipset', 'trim|required|min_length[1]|max_length[32]');
                          $this->form_validation->set_rules('ram', 'ram', 'trim|required|min_length[1]|max_length[32]');
                          $this->form_validation->set_rules('level', 'level', 'trim|required|min_length[1]|max_length[32]');
                          $this->form_validation->set_rules('price', 'price', 'trim|required|min_length[4]|max_length[10]');
                          $this->form_validation->set_rules('WIFI', 'WIFI', 'required|min_length[1]|max_length[10]');
                              
                          
                          if($this->form_validation->run() == FALSE) {

                           
                          $mainboard = $this->Product_model->getID_MB($id);
                          $arr['mainboard'] = $mainboard;

                          $this->load->view('edit/editmainboard',$arr);
                           //redirect('index.php/showall/edit/'.$id);


                         } else {

                            $name = $this->input->post('name');
                            $socket = $this->input->post('socket');
                            $model = $this->input->post('model');
                            $chipset = $this->input->post('chipset');
                            $ram = $this->input->post('ram');
                            $level = $this->input->post('level');
                            $price = $this->input->post('price');
                            $gaming = $this->input->post('gaming');
                            $multimedia = $this->input->post('multimedia');
                            $office = $this->input->post('office');
                            $WIFI = $this->input->post('WIFI');
                            

                            if($gaming == 'gaming'){
                               $gaming = 'YES';
                            }else{
                              $gaming = 'NO';
                            }
                            if($multimedia == 'multimedia'){
                              $multimedia = 'YES';
                            }else{
                              $multimedia = 'NO';
                            }
                            if($office == 'office'){
                              $office = 'YES';
                            }else{
                              $office = 'NO';
                            }
                           


                                    $data = array(
                                      'id' => $id,
                                      'name' => $name,
                                      'socket' => $socket,
                                      'model' => $model,
                                      'chipset' => $chipset,
                                      'ram' => $ram,
                                      'level' => $level,
                                      'price' => $price,
                                      'gaming' => $gaming,
                                      'multimedia' => $multimedia,
                                      'office' => $office,
                                      'WIFI' => $WIFI,
                                    );

                              $this->Product_model->update_mainboard($data);
                              
                              $mainboard = $this->Product_model->getMB();
                              
                              $arr['mainboard'] = $mainboard;
                              
                  
                  redirect('index.php/products_control/showmainboard');
                  
                }
                
                    
      }
      public function updatehdd(){
          
              $id = $this->input->post('id');

                          $this->form_validation->set_rules('name', 'name', 'trim|required|min_length[2]|max_length[32]');
                          $this->form_validation->set_rules('type', 'type', 'trim|required|min_length[3]|max_length[32]');
                          $this->form_validation->set_rules('capacity', 'capacity', 'trim|required|min_length[1]|max_length[5]');
                          
                          $this->form_validation->set_rules('level', 'level', 'trim|required|min_length[1]|max_length[32]');
                          $this->form_validation->set_rules('price', 'price', 'trim|required|min_length[4]|max_length[10]');
                          
                               

                          if($this->form_validation->run() == FALSE) {

                           
                          $hdd = $this->Product_model->getID_HDD($id);
                          $arr['hdd'] = $hdd;

                          $this->load->view('edit/edithdd',$arr);
                           //redirect('index.php/showall/edit/'.$id);


                         } else {

                            $name = $this->input->post('name');
                            $type = $this->input->post('type');
                            $capacity = $this->input->post('capacity');
                            
                            $level = $this->input->post('level');
                            $price = $this->input->post('price');
                            $gaming = $this->input->post('gaming');
                            $multimedia = $this->input->post('multimedia');
                            $office = $this->input->post('office');
                            //print_r($password); exit();

                            if($gaming == 'gaming'){
                               $gaming = 'YES';
                            }else{
                              $gaming = 'NO';
                            }
                            if($multimedia == 'multimedia'){
                              $multimedia = 'YES';
                            }else{
                              $multimedia = 'NO';
                            }
                            if($office == 'office'){
                              $office = 'YES';
                            }else{
                              $office = 'NO';
                            }
                           


                                    $data = array(
                                      'id' => $id,
                                      'name' => $name,
                                      'type' => $type,
                                      'capacity' => $capacity,
                                      
                                      'level' => $level,
                                      'price' => $price,
                                      'gaming' => $gaming,
                                      'multimedia' => $multimedia,
                                      'office' => $office,
                                    );

                              $this->Product_model->update_hdd($data);
                              
                              $hdd = $this->Product_model->getHDD();
                              
                              $arr['hdd'] = $hdd;
                            
                  
                  redirect('index.php/products_control/showhdd');
                  
                }
                
                 
      }
     
      public function updatessd(){
          
              $id = $this->input->post('id');

                          $this->form_validation->set_rules('name', 'name', 'trim|required|min_length[2]|max_length[32]');
                          $this->form_validation->set_rules('type', 'type', 'trim|required|min_length[3]|max_length[32]');
                          $this->form_validation->set_rules('capacity', 'capacity', 'trim|required|min_length[1]|max_length[5]');
                          
                          $this->form_validation->set_rules('level', 'level', 'trim|required|min_length[1]|max_length[32]');
                          $this->form_validation->set_rules('price', 'price', 'trim|required|min_length[4]|max_length[10]');
                          
                               

                          if($this->form_validation->run() == FALSE) {

                           
                          $ssd = $this->Product_model->getID_SSD($id);
                          $arr['ssd'] = $ssd;

                          $this->load->view('edit/editssd',$arr);
                           //redirect('index.php/showall/edit/'.$id);


                         } else {

                            $name = $this->input->post('name');
                            $type = $this->input->post('type');
                            $capacity = $this->input->post('capacity');
                            
                            $level = $this->input->post('level');
                            $price = $this->input->post('price');
                            $gaming = $this->input->post('gaming');
                            $multimedia = $this->input->post('multimedia');
                            $office = $this->input->post('office');
                            //print_r($password); exit();

                            if($gaming == 'gaming'){
                               $gaming = 'YES';
                            }else{
                              $gaming = 'NO';
                            }
                            if($multimedia == 'multimedia'){
                              $multimedia = 'YES';
                            }else{
                              $multimedia = 'NO';
                            }
                            if($office == 'office'){
                              $office = 'YES';
                            }else{
                              $office = 'NO';
                            }
                           


                                    $data = array(
                                      'id' => $id,
                                      'name' => $name,
                                      'type' => $type,
                                      'capacity' => $capacity,
                                      
                                      'level' => $level,
                                      'price' => $price,
                                      'gaming' => $gaming,
                                      'multimedia' => $multimedia,
                                      'office' => $office,
                                    );

                              $this->Product_model->update_ssd($data);
                              
                              $ssd = $this->Product_model->getSSD();
                              
                              $arr['ssd'] = $ssd;
                            
                  
                  redirect('index.php/products_control/showssd');
                  
                }
                
                    
      }
      public function updateram(){
          
              $id = $this->input->post('id');

                          $this->form_validation->set_rules('name', 'name', 'trim|required|min_length[2]|max_length[32]');
                          $this->form_validation->set_rules('type', 'type', 'trim|required|min_length[4]|max_length[32]');
                          $this->form_validation->set_rules('capacity', 'capacity', 'trim|required|min_length[1]|max_length[2]');
                          $this->form_validation->set_rules('bus', 'bus', 'trim|required|min_length[4]|max_length[5]');
                          
                          $this->form_validation->set_rules('level', 'level', 'trim|required|min_length[1]|max_length[32]');
                          $this->form_validation->set_rules('price', 'price', 'trim|required|min_length[4]|max_length[10]');
                          
                               

                          if($this->form_validation->run() == FALSE) {

                           
                          $ram = $this->Product_model->getID_RAM($id);
                          $arr['ram'] = $ram;

                          $this->load->view('edit/editram',$arr);
                           //redirect('index.php/showall/edit/'.$id);


                         } else {

                            $name = $this->input->post('name');
                            $type = $this->input->post('type');
                            $capacity = $this->input->post('capacity');
                            $bus = $this->input->post('bus');
                            
                            $level = $this->input->post('level');
                            $price = $this->input->post('price');
                            $gaming = $this->input->post('gaming');
                            $multimedia = $this->input->post('multimedia');
                            $office = $this->input->post('office');
                            //print_r($password); exit();

                            if($gaming == 'gaming'){
                               $gaming = 'YES';
                            }else{
                              $gaming = 'NO';
                            }
                            if($multimedia == 'multimedia'){
                              $multimedia = 'YES';
                            }else{
                              $multimedia = 'NO';
                            }
                            if($office == 'office'){
                              $office = 'YES';
                            }else{
                              $office = 'NO';
                            }
                           


                                    $data = array(
                                      'id' => $id,
                                      'name' => $name,
                                      'type' => $type,
                                      'capacity' => $capacity,
                                      'bus' => $bus,
                                      
                                      'level' => $level,
                                      'price' => $price,
                                      'gaming' => $gaming,
                                      'multimedia' => $multimedia,
                                      'office' => $office,
                                    );

                              $this->Product_model->update_ram($data);
                              
                              $ram = $this->Product_model->getram();
                              
                  
                  redirect('index.php/products_control/showram');
                  
                }
                
                      
      }
      public function updatemonitor(){
          
              $id = $this->input->post('id');

                          $this->form_validation->set_rules('name', 'name', 'trim|required|min_length[2]|max_length[32]');
                          $this->form_validation->set_rules('size', 'size', 'trim|required|min_length[2]|max_length[2]');
                          $this->form_validation->set_rules('panel', 'panel', 'trim|required|min_length[2]|max_length[5]');
                          $this->form_validation->set_rules('refreshrate', 'refreshrate', 'trim|required|min_length[2]|max_length[3]');
                          $this->form_validation->set_rules('resolution', 'resolution', 'trim|required|min_length[1]|max_length[32]');
                          $this->form_validation->set_rules('level', 'level', 'trim|required|min_length[1]|max_length[32]');
                          $this->form_validation->set_rules('price', 'price', 'trim|required|min_length[4]|max_length[10]');
                          
                               

                          if($this->form_validation->run() == FALSE) {

                           
                          $monitor = $this->Product_model->getID_Monitor($id);
                          $arr['monitor'] = $monitor;

                          $this->load->view('edit/editmonitor',$arr);
                           //redirect('index.php/showall/edit/'.$id);


                         } else {

                            $name = $this->input->post('name');
                            $size = $this->input->post('size');
                            $panel = $this->input->post('panel');
                            $refreshrate = $this->input->post('refreshrate');
                            $resolution = $this->input->post('resolution');
                            $level = $this->input->post('level');
                            $price = $this->input->post('price');
                            $gaming = $this->input->post('gaming');
                            $multimedia = $this->input->post('multimedia');
                            $office = $this->input->post('office');
                            //print_r($password); exit();

                            if($gaming == 'gaming'){
                               $gaming = 'YES';
                            }else{
                              $gaming = 'NO';
                            }
                            if($multimedia == 'multimedia'){
                              $multimedia = 'YES';
                            }else{
                              $multimedia = 'NO';
                            }
                            if($office == 'office'){
                              $office = 'YES';
                            }else{
                              $office = 'NO';
                            }
                           
                            if($HDMI == 'HDMI'){
                               $HDMI = 'YES';
                            }else{
                              $HDMI = 'NO';
                            }
                            if($DP == 'DP'){
                              $DP = 'YES';
                            }else{
                              $DP = 'NO';
                            }
                            if($DVI == 'DVI'){
                              $DVI = 'YES';
                            }else{
                              $DVI = 'NO';
                            }
                            if($VGA == 'VGA'){
                              $VGA = 'YES';
                            }else{
                              $VGA = 'NO';
                            }


                                    $data = array(
                                      'id' => $id,
                                      'name' => $name,
                                      'size' => $size,
                                      'panel' => $panel,
                                      'refreshrate' => $refreshrate,
                                      'resolution' => $resolution,
                                      'HDMI' => $HDMI,
                                      'DP' => $DP,
                                      'DVI' => $DVI,
                                      'VGA' => $VGA,
                                      'price' => $price,
                                      'gaming' => $gaming,
                                      'multimedia' => $multimedia,
                                      'office' => $office,
                                    );

                              $this->Product_model->update_monitor($data);
                              
                              $monitor = $this->Product_model->getMonitor();
                            
                  
                  redirect('index.php/products_control/showmonitor');
                  
                }
                
                      
      }
      public function updatepsu(){
          
              $id = $this->input->post('id');

                          $this->form_validation->set_rules('name', 'name', 'trim|required|min_length[2]|max_length[32]');
                          $this->form_validation->set_rules('power', 'power', 'trim|required|min_length[3]|max_length[32]');
                          
                          $this->form_validation->set_rules('level', 'level', 'trim|required|min_length[1]|max_length[32]');
                          $this->form_validation->set_rules('price', 'price', 'trim|required|min_length[4]|max_length[10]');
                          
                               

                          if($this->form_validation->run() == FALSE) {

                           
                          $cpu = $this->Product_model->getID_PSU($id);
                          $arr['cpu'] = $cpu;

                          $this->load->view('edit/editpsu',$arr);
                           //redirect('index.php/showall/edit/'.$id);


                         } else {

                            $name = $this->input->post('name');
                            $power = $this->input->post('power');
                            $level = $this->input->post('level');
                            $price = $this->input->post('price');
                            $gaming = $this->input->post('gaming');
                            $multimedia = $this->input->post('multimedia');
                            $office = $this->input->post('office');
                            //print_r($password); exit();

                            if($gaming == 'gaming'){
                               $gaming = 'YES';
                            }else{
                              $gaming = 'NO';
                            }
                            if($multimedia == 'multimedia'){
                              $multimedia = 'YES';
                            }else{
                              $multimedia = 'NO';
                            }
                            if($office == 'office'){
                              $office = 'YES';
                            }else{
                              $office = 'NO';
                            }
                           


                                    $data = array(
                                      'id' => $id,
                                      'name' => $name,
                                      'power' => $power,
                                      'level' => $level,
                                      'price' => $price,
                                      'gaming' => $gaming,
                                      'multimedia' => $multimedia,
                                      'office' => $office,
                                    );

                              $this->Product_model->update_psu($data);
                              
                              $psu = $this->Product_model->getPSU();
                              
                  
                  redirect('index.php/products_control/showpsu');
                  
                }
                
                      
      }
      public function updatecooler(){
          
              $id = $this->input->post('id');

                          $this->form_validation->set_rules('name', 'name', 'trim|required|min_length[2]|max_length[32]');
                          $this->form_validation->set_rules('type', 'type', 'trim|required|min_length[3]|max_length[32]');
                          
                          $this->form_validation->set_rules('level', 'level', 'trim|required|min_length[1]|max_length[32]');
                          $this->form_validation->set_rules('price', 'price', 'trim|required|min_length[4]|max_length[10]');
                          
                               

                          if($this->form_validation->run() == FALSE) {

                           
                          $cooler = $this->Product_model->getID_Cooler($id);
                          $arr['cooler'] = $cooler;

                          $this->load->view('edit/editcooler',$arr);
                           //redirect('index.php/showall/edit/'.$id);


                         } else {

                            $name = $this->input->post('name');
                            
                            $type = $this->input->post('type');
                            $level = $this->input->post('level');
                            $price = $this->input->post('price');
                           
                            //print_r($password); exit();
                           
                           


                                    $data = array(
                                      'id' => $id,
                                      'name' => $name,
                                      'type' => $type,
                                      'level' => $level,
                                      'price' => $price,
                                      
                                    );

                              $this->Product_model->update_cooler($data);
                              
                              $cooler = $this->Product_model->getCooler();
                              
                              $arr['cooler'] = $cooler;
                             
                  
                  redirect('index.php/products_control/showcooler');
                  
                }
                
                     
      }
      public function check_email_exists($email){
      $query = $this->db->get_where('useraccount', array('email' => $email));
      if(empty($query->row_array())){
        return true;
      } else {
        $this->session->set_flashdata('message1','Email has been used');
        $this->form_validation->set_message(__FUNCTION__, 'Your <b>email</b> has been used.');

        redirect('index.php/products_control/register');
        return false;
      }
    }
  
    public function check_username_exists($username){
        $query = $this->db->get_where('useraccount', array('username' => $username));
        if(empty($query->row_array())){
          return true;
        } else {
          $this->session->set_flashdata('message2','Username has been used');
          $this->form_validation->set_message(__FUNCTION__, 'Your <b>Username</b> has been used.');

          redirect('index.php/products_control/register');
          return false;
        }
    }
      public function actionRegister(){
          $this->load->library('form_validation');
          $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_check_username_exists|min_length[4]|max_length[20]');
          $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
          $this->form_validation->set_rules('email', 'Your Email', 'required|callback_check_email_exists');
          $this->form_validation->set_rules('firstname', 'FirstName', 'trim|required|min_length[2]|max_length[32]');
          $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required|min_length[2]|max_length[32]');
          $this->form_validation->set_rules('tel', 'Telephone', 'trim|required|min_length[4]|max_length[10]');
          $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[4]|max_length[64]');



          if($this->form_validation->run() == FALSE) {
            $this->register();
            
          } else {

          $username = $this->input->post('username');
          $password = $this->input->post('password');
          $email = $this->input->post('email');
          $firstname = $this->input->post('firstname');
          $lastname = $this->input->post('lastname');
          $tel = $this->input->post('tel');
          $address = $this->input->post('address');


         

            $data = array(
              'username' => $username,
              'password' => MD5($password),
              'email' => $email,
              'firstname' => $firstname,
              'lastname' => $lastname,
              'tel' => $tel,
              'address' => $address,
             
            );

            // insert values in database

            $this->Product_model->createUser($data);
            

            $this->load->view('login');
            redirect('index.php/products_control/login');
              }
            }

}
?>

