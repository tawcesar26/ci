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


		public function buscarTudo($dados){

			$objeto = (object)$dados;

			$this->db->select($objeto->coluna);
			$this->db->order_by($objeto->coluna_where, $objeto->orderBy);

			$resultado = $this->db->get($objeto->tabela)->result();

			return json_encode($resultado);

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