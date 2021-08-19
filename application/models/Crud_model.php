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

		if($tabela === 'tb_aluno'){

			$result = $this->db->insert($tabela, $dados);

			$id = $this->db->insert_id();

			$dadosNota = array(

				'id_aluno_nota'=> $id,
				'nota1'=>0.0,
				'nota2'=>0.0,
				'nota3'=>0.0,
				'nota4'=>0.0,
			);

			$this->db->insert('tb_nota',$dadosNota);

			return $result;

		}else{

			return $this->db->insert($tabela, $dados);
		}

	}


	public function selectAll(){

		$id = $this->session->userdata('id');

		$this->db->select("*");
		$this->db->where('status', 1);
		$this->db->where('idusuario !=', $id);

		$this->db->order_by('idusuario', 'DESC');
		
		$resultado = $this->db->get('tb_adm')->result();

		return $resultado;

	}

	function selectExport(){

		
		$dados = $this->db->query('SELECT * FROM tb_adm WHERE status = 1;')->result();

		return $dados;


	}

	public function selectAllAlunos(){


		$dados = $this->db->query('SELECT * FROM tb_aluno AS a JOIN tb_classe AS c on a.tb_classe_id_classe = id_classe WHERE a.status = 1 ORDER BY id_aluno DESC;')->result();


		return $dados;

	}

	public function selectAllProfessores(){


		$dados = $this->db->query('
			SELECT * FROM tb_professor
			INNER JOIN tb_classe ON tb_classe.id_classe = tb_professor.tb_classe_id_classe
			INNER JOIN tb_disciplina ON tb_disciplina.id_disciplina = tb_professor.tb_disciplina_id_disciplina
			WHERE tb_professor.status =1
			ORDER BY id_classe ASC;')->result();


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

	public function selectAllClasses(){

		$this->db->select('*');
		$this->db->where('status !=', 0);
		return $this->db->get('tb_classe')->result();
	}
	public function selectAllDisciplinas(){

		$this->db->select('*');
		$this->db->where('status !=', 0);
		$this->db->order_by('nome_disciplina', 'ASC');
		return $this->db->get('tb_disciplina')->result();
	}

	public function insertDisciplinas($dados){

			return $this->db->insert('tb_disciplina', $dados);	

	}
	public function updateDisciplinas($dados,$id){

			$this->db->where('id_disciplina', $id);
			return $this->db->update('tb_disciplina', $dados);	

	}
	public function insertClasses($dados){

			return $this->db->insert('tb_classe', $dados);	

	}
	public function updateClasses($dados,$id){

			$this->db->where('id_classe', $id);
			return $this->db->update('tb_classe', $dados);	

	}

	


}