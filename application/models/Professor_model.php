<?php 

defined('BASEPATH') OR exit ('No direct script acess allowed');

class Professor_model extends CI_Model{

	function __construct(){

		parent::__construct();

		$this->load->database();


	}

	public function selectAllClasses($id){


		$dados = $this->db->query('

			SELECT * FROM tb_classe
			INNER JOIN tb_professor ON tb_professor.tb_classe_id_classe = tb_classe.id_classe
			INNER JOIN tb_disciplina ON tb_disciplina.id_disciplina = tb_professor.tb_disciplina_id_disciplina
			WHERE id_usuario = '.$id.';')->result();


		return $dados;

	}


}

 ?>