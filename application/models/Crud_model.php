<?php 

defined('BASEPATH') OR exit ('No direct script acess allowed');

class Crud_model extends CI_Model{	

	function __construct(){

		parent::__construct();

		$this->load->database();

	}

	public function dadosHomePage($tabela){

		$this->db->select('*');
		$this->db->where('status !=', 0);

		$resultado = count($this->db->get($tabela)->result());

		return $resultado;

	}
	
	public function verificar($email,$tabela,$coluna){


		$this->db->select('*');
		$this->db->where($coluna, $email);
		return $this->db->get($tabela)->result();


	}

	public function insert($dados, $tabela){

		return $this->db->insert($tabela, $dados);
	}


	public function selectAll($tabela){

		$id = $this->session->userdata('id');

		$this->db->select("*");
		$this->db->where('status', 1);
		$this->db->where('idusuario !=', $id);

		$this->db->order_by('idusuario', 'DESC');
		
		$resultado = $this->db->get($tabela)->result();

		return $resultado;

	}

	function selectExport(){

		
		$dados = $this->db->query('select * from tb_adm where stat = 1;')->result();

		return $dados;


	}

	public function selectAllAlunos(){


		$dados = $this->db->query('select * from tb_aluno as a join tb_classe as c on a.tb_classe_id_classe = id_classe where status = 1;')->result();


		return $dados;

	}

	public function selectAllProfessores(){


		$dados = $this->db->query('select * from tb_professor where status = 1;')->result();


		return $dados;

	}

	public function update($dados,$tabela,$condicao,$coluna){


		$this->db->where($coluna, $condicao);
		return $this->db->update($tabela, $dados);
		

	}

	public function delete($tabela,$condicao,$coluna){


		$this->db->set('status', 0);
		$this->db->where($coluna, $condicao);
		return $this->db->update($tabela);
		

	}

	


}