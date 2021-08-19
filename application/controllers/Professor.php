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

		$this->template->view_professor('telas/professor/homeProfessor', $dados);

	}

	public function listaClassesProfessor(){

		$dados = array(
			'titulo' => 'CRUD &raquo; Listagem',
			'page' => "listaClasses",
			'descricao' => "Minhas Classes",
		);

		$this->template->view_professor('telas/professor/classesLista',$dados);

	}
	public function listaAlunosProfessor(){

		$dados = array(
			'titulo' => 'CRUD &raquo; Listagem',
			'page' => "listaClasses",
			'descricao' => "Boletins",
		);

		$this->template->view_professor('telas/professor/gerenciarAlunos',$dados);

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

	public function atualizarNotas(){

		$retorno['msg'] = "";
		$sinal = false;

		$id = $this->input->post('idAluno');
		$dados['id_disciplina_nota'] = $this->input->post('disciplinaAluno');
		$dados['nota1'] = $this->input->post('nota1');
		$dados['nota2'] = $this->input->post('nota2');
		$dados['nota3'] = $this->input->post('nota3');
		$dados['nota4'] = $this->input->post('nota4');

		if($dados['nota1'] > 10 || $dados['nota1'] < 0){

			$retorno['ret'] = false;
			$retorno['msg'] = 'A nota informada deve ter valor entre 0 e 10';
			$sinal = true;

		}
		else if($dados['nota2'] > 10 || $dados['nota1'] < 0){

			$retorno['ret'] = false;
			$retorno['msg'] = 'A nota informada deve ter valor entre 0 e 10';
			$sinal = true;

		}
		else if($dados['nota3'] > 10 || $dados['nota1'] < 0){

			$retorno['ret'] = false;
			$retorno['msg'] = 'A nota informada deve ter valor entre 0 e 10';
			$sinal = true;

		}
		else if($dados['nota4'] > 10 || $dados['nota1'] < 0){

			$retorno['ret'] = false;
			$retorno['msg'] = 'A nota informada deve ter valor entre 0 e 10';
			$sinal = true;

		}

		if($sinal){

			echo json_encode($retorno);
			exit;
		}

		$resultado = $this->crud->update($dados,$id);

		if($resultado){

			$retorno['ret'] = true;
			$retorno['msg'] = 'Edição realizada com sucesso!!<br>';
			echo json_encode($retorno);


		}else{

			$retorno['ret'] = false;
			$retorno['msg'] = 'Não foi possível realizar a edição!!<br>';
			echo json_encode($retorno);

		}





	}


}