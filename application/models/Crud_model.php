<?php 

defined('BASEPATH') OR exit ('No direct script acess allowed');

class Crud_model extends CI_Model{	

	function __construct(){

		parent::__construct();

		$this->load->database();

	}
	
	public function verificar($email){


		$this->db->select('*');
		$this->db->where('email', $email);
		return $this->db->get('tb_adm')->result();


	}

	public function insert($dados, $tabela){

		return $this->db->insert($tabela, $dados);
	}


	public function buscarTudo(){

		$this->db->select("*");
		$this->db->where('stat', 1);
		$this->db->order_by('idusuario', 'DESC');

		$resultado = $this->db->get('tb_adm')->result();

		return $resultado;

	}


	public function update($dados,$tabela,$condicao){


		$this->db->where('idusuario', $condicao);
		return $this->db->update($tabela, $dados);
		

	}

	public function delete($tabela,$condicao){


			//$this->db->where('idusuario', $condicao);
			//return $this->db->update($tabela, $dados);

		$this->db->set('stat', 0);
		$this->db->where('idusuario', $condicao);
		return $this->db->update($tabela);
		

	}

	


}