<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {


    public function createUser($data) {

        $this->db->insert('useraccount', $data);
        return $this->db->insert_id();
    }
    public function createProducts($data){
        $this->db->insert('products',$data);
        return $this->db->insert_id();
    }

    public function getPosts(){
        $this->db->select("*");
        $this->db->from('useraccount');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getPostsUsers(){
      $this->db->select("id,email,firstname,lastname,tel,address,images");
      $this->db->from('useraccount');
      $query = $this->db->get();
      return $query->result_array();
    }
    public function getUserById($id){
     $this->db->select('*');
     $this->db->from('useraccount');
     $this->db->where('id', $id);
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
    public function getProducts(){
      $this->db->select('*');
      $this->db->from('products');
      $query = $this->db->get();
      return $query->result_array();
    }
    public function getProductsById($id){
      $this->db->select('*');
      $this->db->from('products');
      $this->db->where('id', $id);
      $query = $this->db->get();
      return $query->result_array();
    }

    public function updateNewPassword($email,$newpass){
      $this->db->select('*');
      $this->db->from('useraccount');
      //print_r($email); print_r($newpass); exit();
      $this->db->where('email',$email);
      $password = MD5($newpass);
      $data = array(
        'password' => $password,
      );

      $this->db->update('useraccount',$data);
    }
    public function update_data($data){
        $id = $data['id'];
        $old_password  = $this->User_model->getUserById($id);
        //print_r('outsideif');print_r($data); exit();
        $username = $data['username'];
        $password = $data['password'];
        $email = $data['email'];
        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $tel = $data['tel'];
        $address = $data['address'];
        $images = $data['images'];

        print_r('outsideif');

        if($password != $old_password[0]['password']){
          print_r('insideif');
                      if($images=='noimage.jpg'){
                        print_r('if noimages') ;
                        $data = array(
                                 'username' => $username,
                                 'password' => $password,
                                 'email' => $email,
                                 'firstname' => $firstname,
                                 'lastname' => $lastname,
                                 'tel' => $tel,
                                 'address' => $address,

                                 );
                                 //print_r($data); exit();
                                 $this->db->where('id',$id);
                                 return $this->db->update('useraccount',$data);

                      }
                      else {
                        print_r('else noimages') ; exit();
                        $data = array(
                                 'username' => $username,
                                 'password' => $password,
                                 'email' => $email,
                                 'firstname' => $firstname,
                                 'lastname' => $lastname,
                                 'tel' => $tel,
                                 'address' => $address,
                                 'images' => $images,
                                 );
                                 //print_r($data); exit();
                                 $this->db->where('id',$id);
                                 return $this->db->update('useraccount',$data);
                      }

              }else{
                print_r('insideif');
                      if($images=='noimage.jpg'){
                        $data = array(
                                 'username' => $username,
                                 'email' => $email,
                                 'firstname' => $firstname,
                                 'lastname' => $lastname,
                                 'tel' => $tel,
                                 'address' => $address,
                                 );
                                 //echo "<pre>";  var_dump($data); exit();
                                 $this->db->where('id',$id);
                                 return $this->db->update('useraccount',$data);

                      }
                      else {
                        $data = array(
                                 'username' => $username,
                                 'email' => $email,
                                 'firstname' => $firstname,
                                 'lastname' => $lastname,
                                 'tel' => $tel,
                                 'address' => $address,
                                 'images' => $images,
                                 );
                                 //print_r($data); exit();
                                 $this->db->where('id',$id);
                                 return $this->db->update('useraccount',$data);
                      }

                    }


                  }

    public function delete_data($id){
               $this->db->where('id',$id);
               $this->db->delete('useraccount');
               return true;
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

    public function getImageById($id){
        $this->db->select('images');
        $this->db->from('useraccount');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function delete_images($id){

          $nopic = 'noimage.jpg';
          $data = array(

                   'images' => $nopic,

                   );
                   $this->db->where('id',$id);
                   return $this->db->update('useraccount',$data);
    }

}

?>
