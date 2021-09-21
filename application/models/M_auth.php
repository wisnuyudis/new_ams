<?php

class M_auth extends CI_Model{
	function cek_login($username,$password){
		$this->db->where("username", $username);
        $this->db->where("password", $password);
        //$this->db->join('user_roles', 'role_id=user_role', 'left');
        return $this->db->get("user")->row_array();
		//return $this->db->get_where($table,$where);
	}
}
