<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index()
	{
		$this->load->library('form_validation');
		$user_details = $this->session->all_userdata();
		$this->load->view('login_view',$user_details);
	}
	
	public function alpha_dash_space($str)
	{
	    return ( ! preg_match("/^([-a-z_ ])+$/i", $str)) ? FALSE : TRUE;
	} 
	public function register()
	{

		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required|callback__alpha_dash_space');
		$this->form_validation->set_rules('password', 'password', 'required|min_length[8]');
		$this->form_validation->set_rules('confirm_password', 'confirm', 'required|matches[password]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

		if ($this->form_validation->run() === FALSE) 
		{
			$errors = validation_errors();
			$this->session->set_flashdata('errors', $errors);
			redirect('welcome/index');
		}
		else
		{
			$user_in = $this->input->post();
			$this->load->model('User');
			$email_check = $this->User->get_user_by_email($user_in['email']);
			//var_dump( $email_check);
			if(empty($email_check))
			{
				$user_in['user_id']=$this->User->add_user($user_in);
				$user_in['name']=$this->input->post('name');
				unset($user_in['password']);
				unset($user_in['confirm_password']);
				$this->session->set_userdata($user_in);
				redirect('quotes');
			}
			else
			{
				$this->session->set_flashdata('errors', "User with that email already exists");
				redirect('welcome');
			}
		}
	}
	
	public function login()
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("email", "email", "required|valid_email");
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() === FALSE) 
		{
			$errors = validation_errors();
			$this->session->set_flashdata('errors', $errors);
			redirect('welcome/index');
		}
		
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$this->load->model('User');
			$user_lookup = $this->User->get_user_by_email($email);
			if ($user_lookup && $user_lookup['password'] == $password) 
			{
				$user_record = array(
						'user_id' => $user_lookup['user_id'],
						'name' => $user_lookup['name'],
						'is_logged_in' => true
				);
				$this->session->set_userdata($user_record);
				redirect('quotes');
			}
			else
			{
				$this->session->set_flashdata('errors', "Invalid email or password!");
				redirect('welcome');

			}
	}


	public function logout()
	{
		$this->session->sess_destroy();
		redirect("/welcome/index");
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */