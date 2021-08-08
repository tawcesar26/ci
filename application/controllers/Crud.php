<?php 

defined('BASEPATH') OR exit ('No direct script acess allowed');

class Crud extends CI_Controller{

	function __construct(){

		parent::__construct();
		$this->load->model('Crud_model','crud');
		$this->load->model('Login_model','validar_login');
		$this->validar_login->logado();


	}

	public function index(){

		$dados = array(
			'titulo' =>'CRUD CODEIGNITER',
			'tela' => '',
			'page' => "home",
			'descricao' => "Painel Administrativo"
		);
		$this->template->views('home', $dados);
		//$this->load->view('home',$dados);

	}

	public function validaCadastro(){

		$this->form_validation->set_rules('nome', 'NOME', 'trim|required');
		$this->form_validation->set_message('is_unique','Este %s está cadastrado no sistema');
		$this->form_validation->set_rules('email', 'EMAIL', 'trim|required|valid_email');
		$this->form_validation->set_rules('login', 'LOGIN', 'trim|required');
		$this->form_validation->set_rules('senha', 'SENHA', 'trim|required');
		$this->form_validation->set_message('matches','O campo %s está diferente do campo %s');
		$this->form_validation->set_rules('senha2', 'REPITA SENHA', 'trim|required|matches[senha]');


		$nome= $this->input->post("nome");
		$email = $this->input->post("email");
		$login = $this->input->post("login");
		$senha = $this->input->post("senha");
		$stat = $this->input->post("stat");


		if($this->form_validation->run()==TRUE):
			$dados = elements(array(
				'nome',
				'email',
				'login',
				'senha',
				'stat',
			),
			$this->input->post());
			$this->crud->do_insert($dados);
		
		endif;

		

		$dados = array(
			'titulo' =>'CRUD &raquo; Cadastro',
			'page' => "cadastrar",
			'descricao' => "Painel Administrativo"
		);

		$this->template->views('telas/cadastrar', $dados);

	
}
	public function select(){

		$dados = array(
			'titulo' => 'CRUD &raquo; Listagem',
			'tela' => 'listar',
			'page' => "listar",
			'descricao' => "",
			'usuarios' => $this->crud->get_all()->result()
			);
		$this->template->views('telas/listar',$dados);



	}

	public function update(){
			$this->form_validation->set_rules('nome', 'NOME', 'trim|required');
			$this->form_validation->set_rules('senha', 'SENHA', 'trim|required');
			$this->form_validation->set_message('matches','O campo %s está diferente do campo %s');
			$this->form_validation->set_rules('senha2', 'REPITA SENHA', 'trim|required|strtolower|matches[senha]');

			if($this->form_validation->run()==TRUE):
				$dados = elements(array('nome','senha'),
				$this->input->post());
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