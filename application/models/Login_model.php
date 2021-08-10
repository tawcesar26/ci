<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {


	public function loginAdministrador($login, $senha) {

		$status = 1;
		
		$this->db->where('email', $login);
		$this->db->where('senha', $senha);
		$this->db->where('stat', $status);


		$data = $this->db->get('tb_adm')->result();

		if (count($data) == 1) {
			return $data;
		} else {
			return false;
		}
	}

	 public function logado(){

        $logado = $this->session->userdata('logado');

        if(!isset($logado) || $logado != TRUE){

            redirect('Login');

       }
   }

   public function logout(){
		$this->session->unset_userdata("logado");
		redirect(base_url());
		
	}



	
}