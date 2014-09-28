<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$view_data['errors']=$this->session->flashdata('errors');
		$this->load->view('login_view', $view_data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('welcome');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */