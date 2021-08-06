<?php 

defined('BASEPATH') OR exit ('No direct script acess allowed');

class Crud extends CI_Controller{

	function __construct(){

		parent::__construct();
		$this->load->model('Crud_model','crud');


	}

	public function index(){

		$dados = array(
			'titulo' =>'CRUD CODEIGNITER',
			'tela' => '',
		);

		$this->load->view('home',$dados);

	}

	public function validaCadastro(){

		$this->form_validation->set_rules('nome', 'NOME', 'trim|required');
		$this->form_validation->set_message('is_unique','Este %s está cadastrado no sistema');
		$this->form_validation->set_rules('email', 'EMAIL', 'trim|required|valid_email');
		$this->form_validation->set_rules('login', 'LOGIN', 'trim|required');
		$this->form_validation->set_rules('senha', 'SENHA', 'trim|required');
		$this->form_validation->set_message('matches','O campo %s está diferente do campo %s');
		$this->form_validation->set_rules('senha2', 'REPITA SENHA', 'trim|required|matches[senha]');

		if($this->form_validation->run()==TRUE):
			$dados = elements(array(
				'nome',
				'login',
				'email',
				'senha',
				'status',
			),
			$this->input->post());
			$this->crud->do_insert($dados);
		
		endif;

		$dados = array(
				'titulo' => 'CRUD &raquo; Cadastro',
				'tela' => 'cadastrar',
			);
			$this->load->view('home',$dados);
		}	

	

	public function select(){

		$dados = array(
			'titulo' => 'CRUD &raquo; Listagem',
			'tela' => 'listar',
			'usuarios' => $this->crud->get_all()->result(),
			);
		$this->load->view('home',$dados);



	}

	//CARREGANDO A VIEW UPDATE, REALIZANDO A VALIDAÇÃO DO FORMULARIO, E ATUALIZANDO NO BANCO CHAMANDO A FUNCTION 'DO_UPDATE' QUE ESTÁ NO MODEL
	public function update(){
			$this->form_validation->set_rules('nome', 'NOME', 'trim|required');
			$this->form_validation->set_rules('senha', 'SENHA', 'trim|required');
			$this->form_validation->set_message('matches','O campo %s está diferente do campo %s');
			$this->form_validation->set_rules('senha2', 'REPITA SENHA', 'trim|required|strtolower|matches[senha]');

			if($this->form_validation->run()==TRUE):
				$dados = elements(array('nome','senha'),$this->input->post());
				$this->crud->do_update($dados, array(

					'idusuario'=>$this->input->post('idusuario'))
			);
			endif;	

			$dados = array(
				'titulo' => 'CRUD &raquo; Atualizar',
				'tela' => 'atualizar',
			);
			$this->load->view('home',$dados);
	}

	public function delete(){



	}



}
 ?>