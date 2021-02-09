<?php

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
		//$this->load->library('session/session');

    }
    public function layout_users($data) {
	$temp['data'] = $data;
        $temp['title'] = $data['title'];
        $temp['page']=$data['page'];
        $this->load->view('users/layout/layout', $temp);
    }
   
	public function layout_admin($data) {
        if($this->session->userdata('ADMIN_ID')!=null){
        $temp['data'] = $data;
        $temp['title'] = $data['title'];
		 $temp['page']=$data['page'];
        $this->load->view('admin/layout/layout', $temp);
		}
	  else
		{
		  redirect('admin-login');
		}
	}
	
}
