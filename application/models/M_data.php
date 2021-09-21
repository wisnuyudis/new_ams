<?php
class M_data extends CI_Model{

  function tampil_data(){
      $this->db->order_by('tgl_upload','desc');
  		return $this->db->get('dokumen');
    }
    function input_data($data,$table){
		$this->db->insert($table,$data);
    }

    function tampil_data_edaran(){
      $this->db->order_by('tgl_publish','desc');
  		return $this->db->get('edaran');
    }

    function tampil_data_memo(){
      $this->db->order_by('tgl_publish','desc');
  		return $this->db->get('memo');
    }

    function tampil_data_rabul(){
      $this->db->order_by('tgl_publish','desc');
  		return $this->db->get('rabul');
    }

    function tampil_data_user(){
      $this->db->order_by('id','asc');
  		return $this->db->get('user');
    }

    function tampil_data_bidang(){
      //$this->db->order_by('sasaran','desc');
  		return $this->db->get('tb_bidang');
    }

    function tampil_data_jenis_surat(){
     // $this->db->order_by('tgl_publish','desc');
  		return $this->db->get('tb_jenis_surat');
    }

    function update_data($data,$table){
      $this->db->where('id', $data['id']);
      $this->db->update($table, $data);
    }

    function get_jenis_dokumen()
	  {
    	$query = $this->db->get('tb_jenis_surat');
        return $query;
    }
    function get_bidang()
	  {
    	$query = $this->db->get('tb_bidang');
        return $query;
    }
    function get_unit()
	  {
    	$query = $this->db->get('tb_unit');
        return $query;
    }

    function hapus_data($where,$table){
      $this->db->where($where);
      $this->db->delete($table);
    }
}
