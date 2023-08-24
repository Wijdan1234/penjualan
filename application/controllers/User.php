<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->model('auth_model');
        $this->load->library('form_validation');
		
		// Check Session Login
		if(!isset($_SESSION['logged_in'])){
			redirect(site_url('auth/login'));
		}
	}
	
	public function index(){
		if(isset($_GET['search'])){
			$filter = array();
			if(!empty($_GET['value']) && $_GET['value'] != ''){
				$filter[$_GET['search_by'].' LIKE'] = "%".$_GET['value']."%";
			}

			$total_row = $this->auth_model->count_total_filter($filter);
			$data['users'] = $this->auth_model->get_filter($filter,url_param());
		}else{
			$total_row = $this->auth_model->count_total();
			$data['users'] = $this->auth_model->get_all(url_param());
		}
		$data['paggination'] = get_paggination($total_row,get_search());

		$this->load->view('user/index',$data);
	}
	
	public function create(){
		// $code_supplier = $this->auth_model->get_last_id();
		// if($code_supplier){
		// 	$id = $code_supplier[0]->id;
		// 	$data['code_supplier'] = generate_code('SUP',$id);
		// }else{
		// 	$data['code_supplier'] = 'SUP001';
		// }
		$data = [];
		$this->load->view('user/form',$data);
	}

	public function edit($id = ''){
		$check_id = $this->auth_model->get_by_id($id);
		if($check_id){
			$data['user'] = $check_id[0];
			$this->load->view('user/form',$data);
		}else{
			redirect(site_url('user'));
		}
	}

	public function save($id = ''){
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('name', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        if($id == ''){
            $this->form_validation->set_rules('password', 'Password', 'required');
        }

		$data['username'] = escape($this->input->post('username'));
		$data['name'] = escape($this->input->post('name'));
		$data['email'] = escape($this->input->post('email'));
		$data['jabatan'] = escape($this->input->post('jabatan'));
        if($this->input->post('password') != ''){
            $data['password'] = md5(escape($this->input->post('password')));
        }

		if ($this->form_validation->run() != FALSE && !empty($id)) {
			// EDIT
			$check_id = $this->auth_model->get_by_id($id);
			if($check_id){
				unset($data['id']);
				$this->auth_model->update($id,$data);
			}
		}elseif($this->form_validation->run() != FALSE && empty($id)){
			// INSERT NEW
			$this->auth_model->insert($data);
		}else{
			$this->session->set_flashdata('form_false', 'Harap periksa form anda.');
			redirect(site_url('user/create'));
		}
		redirect(site_url('user'));
	}
	public function delete($id){
		$check_id = $this->supplier_model->get_by_id($id);
		if($check_id){
			$this->supplier_model->delete($id);
		}
		redirect(site_url('supplier'));
	}
	public function export_csv(){
		$filter = false;
		if(isset($_GET['search'])) {
			$filter = array();
			if (!empty($_GET['value']) && $_GET['value'] != '') {
				$filter[$_GET['search_by'] . ' LIKE'] = "%" . $_GET['value'] . "%";
			}
		}
		$data = $this->supplier_model->get_all_array($filter);
		$this->csv_library->export('supplier.csv',$data);
	}
}
