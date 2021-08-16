<?php

defined('BASEPATH') OR exit ('No direct script acess allowed');

class Professor extends MY_Controller{

	function __construct(){

		parent::__construct();
		//$this->load->model('Professor_model','crud');		


	}

	public function index(){

	$dados = array(
			'titulo' =>'CRUD CODEIGNITER',
			'page' => "home",
			'descricao' => "Painel do Professor",

		);

		$this->template->view_professor('telas/homeProfessor', $dados);

	}

}