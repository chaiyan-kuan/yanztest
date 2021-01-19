<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Welcome extends CI_Controller {


  /**
    * Get All Data from this method.
    *
    * @return Response
   */
   public function index()
   {
	$this->load->view('welcome_message');
   }

}