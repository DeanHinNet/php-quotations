<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quotes extends CI_Controller {

	public function index()
	{
		$user_id = $this->session->userdata('user_id');
		$this->load->model('Quote');
		$view_data['quotes'] = $this->Quote->get_all();
		$view_data['favorite_quotes'] = $this->Quote->get_favorite_quotes($user_id);
		$view_data['name']=$this->session->userdata('name');
		$this->load->view('quote_view', $view_data);
	}

	public function add()
	{
		$new=$this->input->post();
		$new['user_id']=$this->session->userdata['user_id'];
		$this->load->model('Quote');
		$quote_id=$this->Quote->add_quote($new);
		redirect('quotes');
	}

	public function favorite()
	{
		$favorite=$this->input->post();
		$this->load->model('Quote');
		$favorite['user_id']=$this->session->userdata('user_id');
		$this->Quote->favorite($favorite);
		redirect('quotes');
	}
	public function remove_favorite()
	{
		$remove=$this->input->post();
		$this->load->model('Quote');
		$remove['user_id']=$this->session->userdata('user_id');
		$this->Quote->remove_quote($remove);
		redirect('quotes');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */