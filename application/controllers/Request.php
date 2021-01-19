<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model', 'user');
    }
  // Dashboard
    public function index()
    {
          $posts = $this->User_model->getPosts();
          $arr['posts'] = $posts;
          $this->load->view('index',$arr);
    }
    // Register
    public function register(){
          $posts = $this->User_model->getPosts();
          $arr['posts'] = $posts;
          $this->load->view('register',$arr);
    }
  	public function check_email_exists($email){
  		$query = $this->db->get_where('useraccount', array('email' => $email));
  		if(empty($query->row_array())){
  			return true;
  		} else {
        $this->session->set_flashdata('message1','Email has been used');
  			$this->form_validation->set_message(__FUNCTION__, 'Your <b>email</b> has been used.');

        redirect('index.php/request/register');
  			return false;
  		}
    }
    public function check_email_edit($email){
        $query = $this->db->get_where('useraccount', array('email' => $email));
        $id = ($this->session->userdata['logged_in']['id']);
        if(empty($query->row_array())){
          return true;
        } else {
          $this->session->set_flashdata('message1','Email has been used');
          $this->form_validation->set_message(__FUNCTION__, 'Your <b>email</b> has been used.');

          redirect('index.php/showall/edit/'.$id);
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

          redirect('index.php/request/register');
    			return false;
    		}
  	}
    public function check_old_password($old_password){
        $id = ($this->session->userdata['logged_in']['id']);
        $query = $this->db->get_where('useraccount',array('id' => $id,'password' => MD5($old_password)));
        if($query->row_array()){
          return true;
        }else{
          $this->session->set_flashdata('message2','Old Password not match!');
    			$this->form_validation->set_message(__FUNCTION__, 'Your <b>Old Password</b> not match.');
          redirect('index.php/showall/edit/'.$id);
          return false;
        }
      }
  // Action Register
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
            //redirect('index.php/request/register');
          } else {

          $username = $this->input->post('username');
          $password = $this->input->post('password');
          $email = $this->input->post('email');
          $firstname = $this->input->post('firstname');
          $lastname = $this->input->post('lastname');
          $tel = $this->input->post('tel');
          $address = $this->input->post('address');


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
              'username' => $username,
              'password' => MD5($password),
              'email' => $email,
              'firstname' => $firstname,
              'lastname' => $lastname,
              'tel' => $tel,
              'address' => $address,
              'images' => $post_image,
            );

            // insert values in database

            $this->user->createUser($data);
            $this->sendemail($email,$username,$password);
          //  $this->User_model->update_data($post_image);

            $this->load->view('login');
            redirect('index.php/request/login');
              }
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

          $result = $this->User_model->login_user($username,$password);
          //echo "<pre>";print_r($result); exit();
            if($result){
              $result =$this->User_model->getUserByUsername($username);
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
                $posts = $this->User_model->getUserbyUsername($username);
                //print_r($posts); exit();
                $arr['posts'] = $posts;
                $this->load->view('index',$arr);
              }

            } else {
              $this->session->set_flashdata('message','Invalid Username or Password');
                //echo "<pre>";print_r($data); exit();
                redirect('index.php/request/login');
              //$this->load->view('login');

              }
            }
          }
      public function logout() {

        // Removing session data
          $this->session->set_flashdata('message','Successfully Logout');
          $this->session->unset_userdata('logged_in', $sess_array);
          // $data['message_display'] = 'Successfully Logout';
          // $this->load->view('login', $data);
          redirect('index.php/request/login');
      }
      public function login(){
         $this->load->view('login');
      }
      public function forgetform(){
        $this->load->view('forgetpassword');
      }
      public function forgetpassword(){
          $email = $this->input->post('email');
          $newpass = intval( "0" . rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) );
          $result = $this->User_model->getDataByEmail($email);
          //print_r($result); exit();


          if($result != false){
              $username = $result[0]['username'];
          //  print_r($result); print_r($newpass); exit();

              $this->sendnewpass($email,$username,$newpass);
              $data = array(
                'error_message' => 'New Password Send to your email!'
              );
              $this->User_model->updateNewPassword($email,$newpass);
              $this->load->view('login',$data);
          }else{
            $data = array(
              'error_message' => 'This email not found!'
            );
            $this->load->view('forgetpassword',$data);
          }

      }
      public function update(){

        if($this->session->userdata['logged_in']['role']=='admin'){
          $id = $this->input->post('id');
          $newpass = $this->input->post('newpassword');
          $password = MD5($newpass);
          $result = $this->User_model->getUserbyId($id);
          $old_db_password = $result[0]['password'];
          $oldmail = $result[0]['email'];
          //print_r($oldmail); exit();
          $newmail = $this->input->post('email');
          if(!empty($newpass)){
            //print_r('oldpass'); exit();
            $this->form_validation->set_rules('newpassword','New Password','trim|min_length[4]|max_length[32]|required');
            $this->form_validation->set_rules('email', 'Your Email', 'required|valid_email');
          }else if(empty($newpass)){
              $this->form_validation->set_rules('newpassword','New Password','trim|min_length[4]|max_length[32]');

              $password = $old_db_password;
              if($oldmail != $newmail){

              $this->form_validation->set_rules('email', 'Your Email', 'required|valid_email|callback_check_email_edit');

              }
              else{
              $this->form_validation->set_rules('email', 'Your Email', 'required|valid_email');
              }
          }
          $this->form_validation->set_rules('firstname', 'FirstName', 'trim|required|min_length[2]|max_length[32]');
          $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required|min_length[2]|max_length[32]');
          $this->form_validation->set_rules('tel', 'Telephone', 'trim|required|min_length[4]|max_length[10]');
          $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[4]|max_length[64]');


                      if($this->form_validation->run() == FALSE) {

                       $id = $this->session->userdata['logged_in']['id'];
                       $posts = $this->User_model->getUserById($id);
                       $arr['posts'] = $posts;
                       $this->load->view('edit',$arr);
                       //redirect('index.php/showall/edit/'.$id);
                     } else {
                        $username = $this->input->post('username');
                        $email = $this->input->post('email');
                        $firstname = $this->input->post('firstname');
                        $lastname = $this->input->post('lastname');
                        $tel = $this->input->post('tel');
                        $address = $this->input->post('address');
                        //print_r($password); exit();

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
                                  'id' => $id,
                                  'username' => $username,
                                  'password' => $password,
                                  'email' => $email,
                                  'firstname' => $firstname,
                                  'lastname' => $lastname,
                                  'tel' => $tel,
                                  'address' => $address,
                                  'images' => $post_image,
                                );

                          $this->User_model->update_data($data);
                          $posts = $this->User_model->getPostsUsers();

                          $arr['posts'] = $posts;
                          $this->load->view('ShowAllViews',$arr);
                          redirect('index.php/showall');

                        }
        }
          else{
              $id = $this->input->post('id');

              $oldpass = $this->input->post('oldpassword');
              $newpass = $this->input->post('newpassword');
              $password = MD5($newpass);
              $result = $this->User_model->getUserbyId($id);
              $old_db_password = $result[0]['password'];
              $oldmail = $result[0]['email'];
              //print_r($oldmail); exit();
              $newmail = $this->input->post('email');
              if(!empty($oldpass)){
                //print_r('oldpass'); exit();
                $this->form_validation->set_rules('oldpassword', 'Old Password', 'trim|min_length[4]|max_length[32]|callback_check_old_password|required');
                $this->form_validation->set_rules('newpassword','New Password','trim|min_length[4]|max_length[32]|required');
                $this->form_validation->set_rules('confirmpassword','Password Confirmation','trim|min_length[4]|max_length[32]|matches[newpassword]|required');
                $this->form_validation->set_rules('email', 'Your Email', 'required|valid_email');
              }else if(!empty($newpass && empty($oldpass))){
                //print_r('newpass'); exit();
                $this->form_validation->set_rules('oldpassword', 'Old Password', 'trim|min_length[4]|max_length[32]|required');
                $this->form_validation->set_rules('newpassword','New Password','trim|min_length[4]|max_length[32]|required');
                $this->form_validation->set_rules('confirmpassword','Password Confirmation','trim|min_length[4]|max_length[32]|matches[newpassword]|required');



              }else if(empty($oldpass) && empty($newpass)){
                  $this->form_validation->set_rules('oldpassword', 'Old Password', 'trim|min_length[4]|max_length[32]');
                  $this->form_validation->set_rules('newpassword','New Password','trim|min_length[4]|max_length[32]');
                  $this->form_validation->set_rules('confirmpassword','Password Confirmation','trim|min_length[4]|max_length[32]|matches[newpassword]');
                  $password = $old_db_password;
                  if($oldmail != $newmail){

                  $this->form_validation->set_rules('email', 'Your Email', 'required|valid_email|callback_check_email_edit');

                  }
                  else{
                  $this->form_validation->set_rules('email', 'Your Email', 'required|valid_email');
                  }
              }
              $this->form_validation->set_rules('firstname', 'FirstName', 'trim|required|min_length[2]|max_length[32]');
              $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required|min_length[2]|max_length[32]');
              $this->form_validation->set_rules('tel', 'Telephone', 'trim|required|min_length[4]|max_length[10]');
              $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[4]|max_length[64]');


                          if($this->form_validation->run() == FALSE) {

                           $id = $this->session->userdata['logged_in']['id'];
                           $posts = $this->User_model->getUserById($id);
                           $arr['posts'] = $posts;
                           $this->load->view('edit',$arr);
                           //redirect('index.php/showall/edit/'.$id);


                         } else {

                            $username = $this->input->post('username');
                            $email = $this->input->post('email');
                            $firstname = $this->input->post('firstname');
                            $lastname = $this->input->post('lastname');
                            $tel = $this->input->post('tel');
                            $address = $this->input->post('address');
                            //print_r($password); exit();

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
                                      'id' => $id,
                                      'username' => $username,
                                      'password' => $password,
                                      'email' => $email,
                                      'firstname' => $firstname,
                                      'lastname' => $lastname,
                                      'tel' => $tel,
                                      'address' => $address,
                                      'images' => $post_image,
                                    );

                              $this->User_model->update_data($data);
                              $posts = $this->User_model->getPostsUsers();

                              $arr['posts'] = $posts;
                              $this->load->view('Showlist',$arr);
                              redirect('index.php/showall');
                          }
                }

          }
        public function showprofile($id){
              $posts = $this->User_model->getUserbyId($id);
              //print_r($posts); exit();
              $arr['posts'] = $posts;
              $this->load->view('profile',$arr);
            }
        public function sendnewpass($email,$username,$newpass){

              //echo print_r($arr['posts']['username']); exit();
              $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'aspmx.l.google.com',
                'smtp_port' => 25,
                'smtp_user' => 'chaiyan.kuan@gmail.com',
                'smtp_pass' => 'Yan032354213',
                'mailtype'  => 'html',
                'charset'   => 'iso-8859-1',
                );
                $config['newline'] = "\r\n";
              $this->load->library('email',$config);

              $this->email->from('chaiyan.kuan@gmail.com', 'CI_TEST');
              $this->email->to($email);


              $this->email->subject('This your New Password');
              $this->email->message('<html>
              <head>

              </head>
              <body>


                      <div style="width: 30rem;
                      font-family: Georgia;
                      word-wrap: break-word;
                      margin: auto;
                      background-color: #ffffff;
                      background-clip: border-box;
                      border: 1px solid rgba(0, 0, 0, 0.125);
                      padding: 2rem 5rem;
                      border-radius: 0.25rem;">
                          <label style="font-size:1rem;
                          display: block;
                          width: 100%;
                          height: calc(1.5em + 0.75rem + 2px);
                          ">Welcome to my website</label>
                          <h2><label style="font-size:1rem;
                          display: block;
                          width: 70%;
                          height: calc(1.5em + 0.75rem + 2px);
                          " >Email : '.$email.'</label>
                          <label style="font-size:1rem;
                          display: block;
                          width: 70%;
                          height: calc(1.5em + 0.75rem + 2px);
                          " >Username : '.$username.'</label>

                          <label style="font-size:1rem;
                          display: block;
                          width: 70%;
                          height: calc(1.5em + 0.75rem + 2px);
                          " >New Password : '.$newpass.'</label>
                          <hr>

                          <a href="http://[::1]/CI_Test/index.php/request/login" style="color: #fff;

                          text-decoration: none;
                          background-color: #dc3545;
                          border-color: #dc3545;
                          padding: 0.375rem 0.75rem;
                          border-radius: 0.50rem;
                          line-height: 1.5;
                          border: 1px solid transparent;
                          " >Go to Login</a>
                          </div>
              </body>
              <html>'


              );



              if($this->email->send())
              {

              }else{
                var_dump($this->email->print_debugger(array('headers')));
              }

              //$this->email->print_debugger(array('headers'));
            }
        public function sendemail($email,$username,$password){

              //echo print_r($arr['posts']['username']); exit();
              $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'aspmx.l.google.com',
                'smtp_port' => 25,
                'smtp_user' => 'chaiyan.kuan@gmail.com',
                'smtp_pass' => 'Yan032354213',
                'mailtype'  => 'html',
                'charset'   => 'iso-8859-1',
                );
                $config['newline'] = "\r\n";
              $this->load->library('email',$config);

              $this->email->from('chaiyan.kuan@gmail.com', 'CI_TEST');
              $this->email->to($email);


              $this->email->subject('Welcome to my site');
              $this->email->message('<html>
              <head>

              </head>
              <body>


                      <div style="width: 30rem;
                      font-family: Georgia;
                      word-wrap: break-word;
                      margin: auto;
                      background-color: #ffffff;
                      background-clip: border-box;
                      border: 1px solid rgba(0, 0, 0, 0.125);
                      padding: 2rem 5rem;
                      border-radius: 0.25rem;">
                          <label style="font-size:1rem;
                          display: block;
                          width: 100%;
                          height: calc(1.5em + 0.75rem + 2px);
                          ">Welcome to my website</label>
                          <h2><label style="font-size:1rem;
                          display: block;
                          width: 70%;
                          height: calc(1.5em + 0.75rem + 2px);
                          " >Email : '.$email.'</label>
                          <label style="font-size:1rem;
                          display: block;
                          width: 70%;
                          height: calc(1.5em + 0.75rem + 2px);
                          " >Username : '.$username.'</label>

                          <label style="font-size:1rem;
                          display: block;
                          width: 70%;
                          height: calc(1.5em + 0.75rem + 2px);
                          " >Password : '.$password.'</label>
                          <hr>

                          <a href="http://[::1]/CI_Test/index.php/request/login" style="color: #fff;

                          text-decoration: none;
                          background-color: #dc3545;
                          border-color: #dc3545;
                          padding: 0.375rem 0.75rem;
                          border-radius: 0.50rem;
                          line-height: 1.5;
                          border: 1px solid transparent;
                          " >Go to Login</a>
                          </div>
              </body>
              <html>'


              );



              if($this->email->send())
              {

              }else{
                var_dump($this->email->print_debugger(array('headers')));
              }

              //$this->email->print_debugger(array('headers'));
            }



}
?>
