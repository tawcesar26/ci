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
			'page' => "home",
			'descricao' => "Painel Administrativo"
		);
		$this->template->views('home', $dados);

	}

////CADASTRAR ADM/////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function cadastrarAdm(){


		$retorno['msg'] = "";
		$sinal=false;

		$dados['nome'] = $this->input->post("nomeCadastrar");
		$dados['email'] = $this->input->post("emailCadastrar");
		$dados['senha'] = $this->input->post("senhaCadastrar");
		$repetirSenha['senha2'] = $this->input->post("senha2Cadastrar");
		$dados['stat'] = $this->input->post("statCadastrar");


		if(empty($dados['nome'])){

			$retorno['ret'] = false;
			$retorno['msg'] = 'O NOME deve ser preenchido';
			$sinal = true;

		}
		if(empty($dados['email'])){

			$retorno['ret'] = false;
			$retorno['msg'] .= 'O E-MAIL deve ser preenchido';
			$sinal = true;

		}else{

			$email = $dados['email'];

			$emailExiste = $this->crud->verificar($email);

			if($emailExiste){

				$retorno['ret'] = false;
				$retorno['msg'] .= 'O E-mail já está sendo utilizado';
				$sinal = true;
			}
		}
		if(empty($dados['senha'])){

			$retorno['ret'] = false;
			$retorno['msg'] .= 'A SENHA deve ser preenchido';
			$sinal = true;

		}
		if($dados['senha'] != $repetirSenha['senha2']){

			$retorno['ret'] = false;
			$retorno['msg'] .= 'As senhas digitadas não correspondem';
			$sinal = true;

		}


		if($sinal){

			echo json_encode($retorno);
			exit;
		}

		$tabela = 'tb_adm';

		$resultado = $this->crud->insert($dados, $tabela);

		if($resultado){

			$retorno['ret'] = true;
			$retorno['msg'] = 'Cadastro realizado com sucesso!!<br>';
			echo json_encode($retorno);


		}else{

			$retorno['ret'] = false;
			$retorno['msg'] = 'Não foi possível realizar o cadastro!!<br>';
			echo json_encode($retorno);

		}




	}

/////LISTAR ADM///////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function listaAdmin(){

		$dados = array(
			'titulo' => 'CRUD &raquo; Listagem',
			'page' => "listar",
			'descricao' => "Administradores",
			);
		$this->template->views('telas/adminLista',$dados);

	}

	public function listaAluno(){

		$dados = array(
			'titulo' => 'CRUD &raquo; Listagem',
			'page' => "listar2",
			'descricao' => "Alunos",
			);
		$this->template->views('telas/alunoLista',$dados);

	}

	public function listaProfessor(){

		$dados = array(
			'titulo' => 'CRUD &raquo; Listagem',
			'page' => "listar3",
			'descricao' => "Professores",
			);
		$this->template->views('telas/professorLista',$dados);

	}

	public function listarUsuarios(){

		$id = 'tb_adm';

		$resultado = $this->crud->selectAll($id);

		echo json_encode($resultado);

		
	}

	public function listarAluno(){

		$id = 'tb_aluno';

		$resultado = $this->crud->selectAll($id);

		echo json_encode($resultado);

		
	}

/////EDITAR ADM///////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function editarAdm(){


		$retorno['msg'] = "";
		$sinal=false;

		$dados['idusuario'] = $this->input->post('idEditar');
		$dados['nome'] = $this->input->post("nomeEditar");
		$dados['email'] = $this->input->post("emailEditar");
		$dados['senha'] = $this->input->post("senhaEditar");
		$repetirSenha['senha2'] = $this->input->post("senha2Editar");
		$dados['stat'] = $this->input->post("statEditar");


		if(empty($dados['nome'])){

			$retorno['ret'] = false;
			$retorno['msg'] = 'O NOME deve ser preenchido | ';
			$sinal = true;

		}
		if(empty($dados['email'])){

			$retorno['ret'] = false;
			$retorno['msg'] .= 'O E-MAIL deve ser preenchido | ';
			$sinal = true;

		}
		if(empty($dados['senha'])){

			$retorno['ret'] = false;
			$retorno['msg'] .= 'A SENHA deve ser preenchido | ';
			$sinal = true;

		}
		if($dados['senha'] != $repetirSenha['senha2']){

			$retorno['ret'] = false;
			$retorno['msg'] .= 'As senhas digitadas não correspondem | ';
			$sinal = true;

		}


		if($sinal){

			echo json_encode($retorno);
			exit;
		}

		$tabela = 'tb_adm';

		$id = $dados['idusuario'];

		$resultado = $this->crud->update($dados, $tabela, $id);

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

/////DESABILITAR ADM///////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function desabilitarAdm(){


		$retorno['msg'] = "";
		$sinal=false;
		
		$id = $this->input->post('idDesativar');

		$dados['stat'] = $this->input->post("statDesativar");

		if($dados['stat'] === 0){

			$retorno['ret'] = false;
			$retorno['msg'] .= 'Usuário já foi desativado';
			$sinal = true;

		}


		if($sinal){

			echo json_encode($retorno);
			exit;
		}

		$tabela = 'tb_adm';

		$resultado = $this->crud->delete($tabela,$id);

		if($resultado){

			$retorno['ret'] = true;
			$retorno['msg'] = 'Usuário desabilitado com sucesso!!<br>';
			echo json_encode($retorno);


		}else{

			$retorno['ret'] = false;
			$retorno['msg'] = 'Não foi possível desabilitar o usuário!!<br>';
			echo json_encode($retorno);

		}




	}

}

 ?>