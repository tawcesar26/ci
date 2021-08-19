<?php 

defined('BASEPATH') OR exit ('No direct script acess allowed');

class Professor_model extends CI_Model{

	function __construct(){

		parent::__construct();

		$this->load->database();


	}

	public function selectAllClasses($id){


		$this->db->select('*');
		$this->db->from('tb_classe');
		$this->db->join('tb_professor', 'tb_professor.tb_classe_id_classe = tb_classe.id_classe');
		$this->db->join('tb_disciplina', 'tb_disciplina.id_disciplina = tb_professor.tb_disciplina_id_disciplina');
		$this->db->where('tb_professor.id_usuario', $id);

		return $this->db->get()->result();


	}

	public function selectAllAlunos($id){


		$this->db->select('id_aluno,nome_aluno,nome_classe,nome_disciplina,id_disciplina,id_nota,id_disciplina_nota,nota1,nota2,nota3,nota4');
		$this->db->from('tb_aluno');
		$this->db->join('tb_professor', 'tb_professor.tb_classe_id_classe = tb_aluno.tb_classe_id_classe');
		$this->db->join('tb_classe', 'tb_classe.id_classe = tb_professor.tb_classe_id_classe');

		$this->db->join('tb_disciplina', 'tb_disciplina.id_disciplina = tb_professor.tb_disciplina_id_disciplina');
		$this->db->where('tb_professor.id_usuario', $id);

		return $this->db->get()->result();

	

	}

	public function update($dados,$id){

		$this->db->where('id_aluno_nota', $id );
		return $this->db->update('tb_nota', $dados);

	}


}

 ?>