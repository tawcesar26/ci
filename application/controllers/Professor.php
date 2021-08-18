<?php

defined('BASEPATH') OR exit ('No direct script acess allowed');

class Professor extends MY_ControllerProfessor{

	function __construct(){

		parent::__construct();
		$this->load->model('Professor_model','crud');		


	}

	public function index(){

	$dados = array(
			'titulo' =>'CRUD CODEIGNITER',
			'page' => "home",
			'descricao' => "Painel do Professor",

		);

		$this->template->view_professor('telas/homeProfessor', $dados);

	}

	public function listaClassesProfessor(){

		$dados = array(
			'titulo' => 'CRUD &raquo; Listagem',
			'page' => "listaClasses",
			'descricao' => "Minhas Classes",
		);

		$this->template->view_professor('telas/classesLista',$dados);

	}
	public function listaAlunosProfessor(){

		$dados = array(
			'titulo' => 'CRUD &raquo; Listagem',
			'page' => "listaClasses",
			'descricao' => "Meus Alunos",
		);

		$this->template->view_professor('telas/gerenciarAlunos',$dados);

	}

	public function tabelaClasses(){

		$id = $this->session->userdata('id');

		$resultado = $this->crud->selectAllClasses($id);

		echo json_encode($resultado);



	}
	public function tabelaAlunos(){

		$id = $this->session->userdata('id');

		$resultado = $this->crud->selectAllAlunos($id);
		
		echo json_encode($resultado);

	}


}