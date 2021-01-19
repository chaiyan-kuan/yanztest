<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ShowAll extends CI_Controller {

	public function index()
	{
		if($this->session->userdata['logged_in']['role']=='admin'){
			$posts = $this->User_model->getPosts();
			//print_r($this->session->userdata['logged_in']['role']) ;exit();
			$arr['posts'] = $posts;
			$this->load->view('ShowAllViews',$arr);
		}else{
			$posts = $this->User_model->getProducts();
			//print_r($posts) ;exit();
			$arr['posts'] = $posts;
			$this->load->view('Showlist',$arr);
	}
		}
		public function show($id){
			$posts = $this->User_model->getProductsById($id);
			$arr['posts'] = $posts;
			$this->load->view('showitem',$arr);
   }
	 public function edit($id){
 				$posts = $this->User_model->getUserById($id);
				$arr['posts'] = $posts;
 				$this->load->view('edit',$arr);
 		}

			public function delete($id){
						 $this->User_model->delete_data($id);
						 $posts = $this->User_model->getPosts();
						 $arr['posts'] = $posts;
						 $this->load->view('ShowAllViews',$arr);
					}
			public function deleteImage($id){
						$images = $this->User_model->getImageById($id);
						//echo print_r($images[0]['images']); exit();
						$this->User_model->delete_images($id);
						$posts = $this->User_model->getPosts();
						$arr['posts'] = $posts;
						$this->load->view('ShowAllViews',$arr);
			}
			public function testpage(){
								$posts = $this->User_model->getPosts();
								$arr['posts'] = $posts;
								$this->load->view('test2',$arr);

			}
			public function testpage2(){
				      $posts = $this->User_model->getPosts();
							$arr['posts'] = $posts;
							$this->load->view('testpage2',$arr);
			}
			public function emailformat(){
								$id = '1';
								$posts = $this->User_model->getUserById($id);
								$arr['posts'] = $posts;
								//echo print_r($arr['posts']); exit();
								$this->load->view('emailformat',$arr);

			}
			public function editadmin($id){
				$posts = $this->User_model->getUserById($id);
				$arr['posts'] = $posts;
 				$this->load->view('editadmin',$arr);
			}
		}
