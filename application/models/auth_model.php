<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
	function __construct(){
        parent::__construct();
	}
	
	public function check_login($username,$password){
		$query = $this->db->get_where("user",array("username" => $username, "password" => $password) );
		return $query->result();
	}
	public function get_profile($user_id){
		$query = $this->db->get_where("user",array("id" => $user_id) );
		return $query->result();
	}
	public function set_session($id,$username){
		$newdata = array(
			'id'		=> $id,
			'username'  => $username,
			'logged_in' => TRUE
		);
		$this->session->set_userdata($newdata);
	}
	public function unset_session(){
		session_destroy();
	}
	public function set_cookie_remember($username){
		setcookie('remember_me',$username, time() + (86400 * 30), "/");
	}	
	public function unset_cookie_remember(){
		setcookie('remember_me','',0,'/');
	}

	public function get_all($limit_offset = array()){
		if(!empty($limit_offset)){
			$query = $this->db->get("user",$limit_offset['limit'],$limit_offset['offset']);
		}else{
			$query = $this->db->get("user");
		}
		return $query->result();
	}
	public function count_total(){
		$query = $this->db->get("user");
		return $query->num_rows();
	}
	public function get_all_array($filter = ''){
		if(!empty($filter)) {
			$query = $this->db->get_where("user",$filter);
		}else{
			$query = $this->db->get_where("user");
		}
		return $query->result_array();
	}
	public function get_last_id(){
		$this->db->order_by('id', 'DESC');

		$query = $this->db->get("user",1,0);
		return $query->result();
	}
	public function insert($data){
		$this->db->insert('user', $data);
	}
	public function update($id,$data){
		$this->db->where('id', $id);
		$this->db->update('user', $data);
	}
	public function get_by_id($id){
		$response = false;
		$query = $this->db->get_where('user',array('id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result_array();
		}
		return $response;
	}
	public function delete($id){
		$this->db->delete('user', array('id' => $id));
	}
	public function get_filter($filter = '',$limit_offset = array()){
		if(!empty($filter)){
			$query = $this->db->get_where("user",$filter,$limit_offset['limit'],$limit_offset['offset']);
		}else{
			$query = $this->db->get("user",$limit_offset['limit'],$limit_offset['offset']);
		}
		return $query->result();
	}
	public function count_total_filter($filter = array()){
		if(!empty($filter)){
			$query = $this->db->get_where("user",$filter);
		}else{
			$query = $this->db->get("user");
		}
		return $query->num_rows();
	}
}