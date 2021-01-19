<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    
    public function createUser($data) {

        $this->db->insert('useraccount', $data);
        return $this->db->insert_id();
    }
    public function createCPU($data) {

          $this->db->insert('cpu', $data);
          return $this->db->insert_id();
      }
    public function createGPU($data) {

          $this->db->insert('gpu', $data);
          return $this->db->insert_id();
      }

    public function createHDD($data) {

          $this->db->insert('hdd', $data);
          return $this->db->insert_id();
      }
    public function createMainboard($data) {

          $this->db->insert('mainboard', $data);
          return $this->db->insert_id();
      }

    public function createMonitor($data) {

          $this->db->insert('monitor', $data);
          return $this->db->insert_id();
      }
    public function createPSU($data) {

          $this->db->insert('psu', $data);
          return $this->db->insert_id();
      }
    public function createRAM($data) {

          $this->db->insert('ram', $data);
          return $this->db->insert_id();
      }
    public function createSSD($data) {

          $this->db->insert('ssd', $data);
          return $this->db->insert_id();
      }
    public function createCooler($data) {

          $this->db->insert('cooler', $data);
          return $this->db->insert_id();
      }  
	public function getCPU(){
        $this->db->select("*");
        $this->db->from('cpu');
        $query = $this->db->get();
        return $query->result_array();
    }
    	public function getGPU(){
        $this->db->select("*");
        $this->db->from('gpu');
        $query = $this->db->get();
        return $query->result_array();
    }
    	public function getMB(){
        $this->db->select("*");
        $this->db->from('mainboard');
        $query = $this->db->get();
        return $query->result_array();
    }
    	public function getMonitor(){
        $this->db->select("*");
        $this->db->from('monitor');
        $query = $this->db->get();
        return $query->result_array();
    }
    	public function getPSU(){
        $this->db->select("*");
        $this->db->from('psu');
        $query = $this->db->get();
        return $query->result_array();
    }
    	public function getRAM(){
        $this->db->select("*");
        $this->db->from('ram');
        $query = $this->db->get();
        return $query->result_array();
    }
    	public function getSSD(){
        $this->db->select("*");
        $this->db->from('ssd');
        $query = $this->db->get();
        return $query->result_array();
    }
    	public function getHDD(){
        $this->db->select("*");
        $this->db->from('hdd');
        $query = $this->db->get();
        return $query->result_array();
    }
      public function getCooler(){
        $this->db->select("*");
        $this->db->from('cooler');
        $query = $this->db->get();
        return $query->result_array();
    }
      public function getID_CPU($id){
        $this->db->select("*");
        $this->db->from('cpu');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
      public function getID_GPU($id){
        $this->db->select("*");
        $this->db->from('gpu');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
      public function getID_MB($id){
        $this->db->select("*");
        $this->db->from('mainboard');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
      public function getID_Monitor($id){
        $this->db->select("*");
        $this->db->from('monitor');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
      public function getID_PSU($id){
        $this->db->select("*");
        $this->db->from('psu');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
      public function getID_RAM($id){
        $this->db->select("*");
        $this->db->from('ram');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
      public function getID_SSD($id){
        $this->db->select("*");
        $this->db->from('ssd');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
      public function getID_HDD($id){
        $this->db->select("*");
        $this->db->from('hdd');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getID_Cooler($id){
        $this->db->select("*");
        $this->db->from('cooler');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getPostsUsers(){
      $this->db->select("id,email,firstname,lastname,tel,address,images");
      $this->db->from('useraccount');
      $query = $this->db->get();
      return $query->result_array();
    }
    public function getCPUByLevel($level){
     $this->db->select('*');
     $this->db->from('cpu');
     $this->db->where('level', $level);
     $query = $this->db->get();
     return $query->result_array();
    }
    public function getGPUByLevel($level){
     $this->db->select('*');
     $this->db->from('gpu');
     $this->db->where('level', $level);
     $query = $this->db->get();
     return $query->result_array();
    }
    public function getHDDByLevel($level){
     $this->db->select('*');
     $this->db->from('hdd');
     $this->db->where('level', $level);
     $query = $this->db->get();
     return $query->result_array();
    }
    public function getSSDByLevel($level){
     $this->db->select('*');
     $this->db->from('ssd');
     $this->db->where('level', $level);
     $query = $this->db->get();
     return $query->result_array();
    }
    public function getMBByLevel($level){
     $this->db->select('*');
     $this->db->from('mainboard');
     $this->db->where('level', $level);
     $query = $this->db->get();
     return $query->result_array();
    }
    public function getPSUByLevel($level){
     $this->db->select('*');
     $this->db->from('psu');
     $this->db->where('level', $level);
     $query = $this->db->get();
     return $query->result_array();
    }
    public function getMonitorByLevel($level){
     $this->db->select('*');
     $this->db->from('monitor');
     $this->db->where('level', $level);
     $query = $this->db->get();
     return $query->result_array();
    }
    public function getRAMByLevel($level){
     $this->db->select('*');
     $this->db->from('ram');  
     $this->db->where('level', $level);
     $query = $this->db->get();
     return $query->result_array();
    }
    public function getCoolerByLevel($level){
     $this->db->select('*');
     $this->db->from('cooler');  
     $this->db->where('level', $level);
     $query = $this->db->get();
     return $query->result_array();
    }
    public function getCPUBySocket($socket,$level){
     $this->db->select('*');
     $this->db->from('cpu');
     $this->db->where('socket',$socket);
     $this->db->where('level',$level);
     $query = $this->db->get();
     return $query->result_array();
    }
    public function getMBBySocket($socket,$level){
     $this->db->select('*');
     $this->db->from('mainboard');
     $this->db->where('socket',$socket);
     $this->db->where('level',$level);
     $query = $this->db->get();
     return $query->result_array();
    }


    public function getUserByUsername($username){
      $this->db->select('*');
      $this->db->from('useraccount');
      $this->db->where('username', $username);
      $query = $this->db->get();
      return $query->result_array();
    }
    public function login_user($username,$password){

        $user = $username;
        $pass = MD5($password);
        //echo "<pre>";print_r($user); exit();
        $this->db->where('username',$user);
        $this->db->where('password',$pass);
        $query = $this->db->get('useraccount');
        //echo "<pre>";print_r($query); exit();
        if($query->num_rows() == 1){
          return true;
        }
        else{
          return false;
        }
    }
     public function update_cpu($data){
        $id = $data['id'];
       
        
        $name = $data['name'];
        $socket = $data['socket'];
        $core = $data['core'];
        $thread = $data['thread'];
        $frequency = $data['frequency'];
        $level = $data['level'];
        $price = $data['price'];
        $gaming = $data['gaming'];
        $multimedia = $data['multimedia'];
        $office = $data['office'];
        
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
                                 //print_r($data); exit();
                                 $this->db->where('id',$id);
                                 return $this->db->update('cpu',$data);

    }
    public function update_gpu($data){
        $id = $data['id'];
       
        
        $name = $data['name'];
        $model = $data['model'];
        $powerusage = $data['powerusage'];
        
        $level = $data['level'];
        $price = $data['price'];
        $gaming = $data['gaming'];
        $multimedia = $data['multimedia'];
        $office = $data['office'];
        $HDMI = $data['HDMI'];
        $DP = $data['DP'];
        $DVI = $data['DVI'];
        $VGA = $data['VGA'];

        
         
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
                                      'DisplayPort' => $DP,
                                      'DVI' => $DVI,
                                      'VGA' => $VGA,
                                    );
                                 //print_r($data); exit();
                                 $this->db->where('id',$id);
                                 return $this->db->update('gpu',$data);

    }
    public function update_mainboard($data){
        $id = $data['id'];
       
        
        $name = $data['name'];
        $model = $data['model'];
        $chipset = $data['chipset'];
        $socket = $data['socket'];
        $ram = $data['ram'];
        $level = $data['level'];
        $price = $data['price'];
        $gaming = $data['gaming'];
        $multimedia = $data['multimedia'];
        $office = $data['office'];
        
        $WIFI = $data['WIFI'];
        

        
         
                       $data = array(
                                      'id' => $id,
                                      'name' => $name,
                                      'model' => $model,
                                      'chipset' => $chipset,
                                      'socket' => $socket,
                                      'ram' => $ram,
                                      'level' => $level,
                                      'price' => $price,
                                      'gaming' => $gaming,
                                      'multimedia' => $multimedia,
                                      'office' => $office,
                                      
                                      'WIFI' => $WIFI,
                                      
                                    );
                                 //print_r($data); exit();
                                 $this->db->where('id',$id);
                                 return $this->db->update('mainboard',$data);

    }
    public function update_hdd($data){
        $id = $data['id'];
       
        
        $name = $data['name'];
        $type = $data['type'];
        $capacity = $data['capacity'];
        $level = $data['level'];
        $price = $data['price'];
        $gaming = $data['gaming'];
        $multimedia = $data['multimedia'];
        $office = $data['office'];
        
        

        
         
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
                                 //print_r($data); exit();
                                 $this->db->where('id',$id);
                                 return $this->db->update('hdd',$data);

    }
    public function update_ssd($data){
        $id = $data['id'];
       
        
        $name = $data['name'];
        $type = $data['type'];
        $capacity = $data['capacity'];
        $level = $data['level'];
        $price = $data['price'];
        $gaming = $data['gaming'];
        $multimedia = $data['multimedia'];
        $office = $data['office'];
        
        

        
         
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
                                 //print_r($data); exit();
                                 $this->db->where('id',$id);
                                 return $this->db->update('ssd',$data);

    }
    public function update_ram($data){
        $id = $data['id'];
       
        
        $name = $data['name'];
        $type = $data['type'];
        $capacity = $data['capacity'];
        $level = $data['level'];
        $price = $data['price'];
        $gaming = $data['gaming'];
        $multimedia = $data['multimedia'];
        $office = $data['office'];
        $bus = $data['bus'];
        $multimedia = $data['multimedia'];
        $office = $data['office'];
        

        
         
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
                                 //print_r($data); exit();
                                 $this->db->where('id',$id);
                                 return $this->db->update('ram',$data);

    }
    public function update_monitor($data){
        $id = $data['id'];
       
        
        $name = $data['name'];
        $size = $data['size'];
        $panel = $data['panel'];
        $level = $data['level'];
        $price = $data['price'];
        $gaming = $data['gaming'];
        $multimedia = $data['multimedia'];
        $office = $data['office'];
        $resolution = $data['resolution'];
        $HDMI = $data['HDMI'];
        $DP = $data['DP'];
        $DVI = $data['DVI'];
        $VGA = $data['VGA'];
        

        
         
                       $data = array(
                                      'id' => $id,
                                      'name' => $name,
                                      'size' => $size,
                                      'panel' => $panel,
                                      'resolution' => $resolution,
                                      'level' => $level,
                                      'price' => $price,
                                      'gaming' => $gaming,
                                      'multimedia' => $multimedia,
                                      'office' => $office,
                                      'HDMI' => $HDMI,
                                      'DisplayPort' => $DP,
                                      'DVI' => $DVI,
                                      'VGA' => $VGA,
                                      
                                      
                                    );
                                 //print_r($data); exit();
                                 $this->db->where('id',$id);
                                 return $this->db->update('monitor',$data);

    }
    public function update_psu($data){
        $id = $data['id'];
       
        
        $name = $data['name'];
        $power = $data['power'];
        
        $level = $data['level'];
        $price = $data['price'];
        $gaming = $data['gaming'];
        $multimedia = $data['multimedia'];
        $office = $data['office'];
       
        

        
         
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
                                 //print_r($data); exit();
                                 $this->db->where('id',$id);
                                 return $this->db->update('psu',$data);

    }
    public function update_cooler($data){
        $id = $data['id'];
       
        
        $name = $data['name'];
        $type = $data['type'];
        
        $level = $data['level'];
        $price = $data['price'];
        
       
        

        
         
                       $data = array(
                                      'id' => $id,
                                      'name' => $name,
                                      'type' => $type,
                                      
                                      'level' => $level,
                                      'price' => $price,                                      
                                      
                                    );
                                 //print_r($data); exit();
                                 $this->db->where('id',$id);
                                 return $this->db->update('cooler',$data);

    }
  public function delete_cpu($id){
               $this->db->where('id',$id);
               $this->db->delete('cpu');
               return true;
    }
  public function delete_gpu($id){
               $this->db->where('id',$id);
               $this->db->delete('gpu');
               return true;
    }
  public function delete_ram($id){
               $this->db->where('id',$id);
               $this->db->delete('ram');
               return true;
    }
  public function delete_mainboard($id){
               $this->db->where('id',$id);
               $this->db->delete('mainboard');
               return true;
    }
  public function delete_ssd($id){
               $this->db->where('id',$id);
               $this->db->delete('ssd');
               return true;
    }
  public function delete_hdd($id){
               $this->db->where('id',$id);
               $this->db->delete('hdd');
               return true;
    }
  public function delete_psu($id){
               $this->db->where('id',$id);
               $this->db->delete('psu');
               return true;
    }
  public function delete_monitor($id){
               $this->db->where('id',$id);
               $this->db->delete('monitor');
               return true;
    }
  public function delete_cooler($id){
               $this->db->where('id',$id);
               $this->db->delete('cooler');
               return true;
    }

}

?>