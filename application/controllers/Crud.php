<?php 

defined('BASEPATH') OR exit ('No direct script acess allowed');

class Crud extends MY_Controller{

	function __construct(){

		parent::__construct();
		$this->load->model('Crud_model','crud');		


	}

	public function index(){

		$totalAdm = $this->crud->dadosHomePage('tb_adm');
		$totalAluno = $this->crud->dadosHomePage('tb_aluno');
		$totalProfessor = $this->crud->dadosHomePage('tb_professor');
		$totalUsuarios = $totalAluno + $totalAdm + $totalProfessor;

		$dados = array(
			'titulo' =>'CRUD CODEIGNITER',
			'page' => "home",
			'descricao' => "Painel Administrativo",
			'totalAdm' => $totalAdm,
			'totalAluno' => $totalAluno,
			'totalProfessor' => $totalProfessor,
			'totalUsuarios' => $totalUsuarios
		);

		$this->template->views1('home', $dados);

	}
///TELAS /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function listaAdmin(){

		$dados = array(
			'titulo' => 'CRUD &raquo; Listagem',
			'page' => "listar",
			'descricao' => "Administradores",
		);

		$this->template->views1('telas/adminLista',$dados);

	}

	public function listaAluno(){

		$dados = array(
			'titulo' => 'CRUD &raquo; Listagem',
			'page' => "listar2",
			'descricao' => "Alunos",
		);
		$this->template->views2('telas/alunoLista',$dados);

	}

	public function listaProfessor(){

		$dados = array(
			'titulo' => 'CRUD &raquo; Listagem',
			'page' => "listar3",
			'descricao' => "Professores",
		);
		$this->template->views3('telas/professorLista',$dados);

	}



/////LISTAR///////////////////////////////////////////////////////////////////////////////////////////////////////////


	public function listarUsuarios(){

		$tabela = 'tb_adm';

		$resultado = $this->crud->selectAll($tabela);

		echo json_encode($resultado);

		
	}

	public function listarAlunos(){

		$id = 'tb_aluno';

		$resultado = $this->crud->selectAllAlunos($id);

		echo json_encode($resultado);

		
	}

	public function listarProfessor(){

		$id = 'tb_professor';

		$resultado = $this->crud->selectAllProfessores($id);

		echo json_encode($resultado);

		
	}

	public function listarClasses(){

		
		$resultado = $this->crud->selectAllClasses();

		echo json_encode($resultado);	
	
			
	}

	public function listarDisciplinas(){

		$resultado = $this->crud->selectAllDisciplinas();

		echo json_encode($resultado);
	}



////CADASTRAR ADM/////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function cadastrarAdm(){


		$retorno['msg'] = "";
		$sinal=false;

		$dados['nome'] = $this->input->post("nomeCadastrar");
		$dados['email'] = $this->input->post("emailCadastrar");
		$dados['senha'] = $this->input->post("senhaCadastrar");
		$repetirSenha['senha2'] = $this->input->post("senha2Cadastrar");
		$dados['status'] = $this->input->post("statCadastrar");

		$email = $dados['email'];
		$tabela = "tb_adm";
		$coluna = 'email';

		$emailExiste = $this->crud->verificar($email,$tabela,$coluna);

		if($emailExiste){

			$retorno['ret'] = false;
			$retorno['msg'] .= '| O E-mail já está sendo utilizado |';
			$sinal = true;
		}

		if($dados['senha'] != $repetirSenha['senha2']){

			$retorno['ret'] = false;
			$retorno['msg'] .= '| As senhas digitadas não correspondem |';
			$sinal = true;

		}

		if($sinal){

			echo json_encode($retorno);
			exit;
		}

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

/////EDITAR ADM///////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function editarAdm(){


		$retorno['msg'] = "";
		$sinal=false;

		$dados['idusuario'] = $this->input->post('idEditar');
		$dados['nome'] = $this->input->post("nomeEditar");
		$dados['email'] = $this->input->post("emailEditar");
		$dados['senha'] = $this->input->post("senhaEditar");
		$repetirSenha['senha2'] = $this->input->post("senha2Editar");
		$dados['status'] = $this->input->post("statEditar");


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
		$condicao = $dados['idusuario'];
		$coluna = 'idusuario';

		$resultado = $this->crud->update($dados, $tabela, $condicao,$coluna);

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

/////DESABILITAR ADM//////////////////////////////////////////////////////////////////////////////////////////////////////
	public function desabilitarAdm(){


		$retorno['msg'] = "";
		$sinal=false;

		$dados['status'] = $this->input->post("statDesativar");

		if($dados['status'] === 0){

			$retorno['ret'] = false;
			$retorno['msg'] .= 'Usuário já foi desativado';
			$sinal = true;

		}


		if($sinal){

			echo json_encode($retorno);
			exit;
		}


		$condicao = $this->input->post('idDesativar');
		$tabela = 'tb_adm';
		$coluna = 'idusuario';

		$resultado = $this->crud->delete($tabela,$condicao,$coluna);

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



////CADASTRO ALUNO ///////////////////////////////////////////////////////////////////////////////////////////////////////

	public function cadastrarAluno(){


		$retorno['msg'] = "";
		$sinal=false;

		$dados['nome_aluno'] = $this->input->post("nomeCadastrar");
		$dados['email_aluno'] = $this->input->post("emailCadastrar");
		$dados['tb_classe_id_classe'] = $this->input->post("classeCadastrar");
		$dados['senha_aluno'] = $this->input->post("senhaCadastrar");
		$repetirSenha['senha2'] = $this->input->post("senha2Cadastrar");
		$dados['status'] = $this->input->post("statCadastrar");

		$email = $dados['email_aluno'];
		$tabela = 'tb_aluno';
		$coluna = 'email_aluno';

		$emailExiste = $this->crud->verificar($email,$tabela,$coluna);

		if($emailExiste){

			$retorno['ret'] = false;
			$retorno['msg'] .= '| O E-mail já está sendo utilizado |';
			$sinal = true;
		}

		if($dados['senha_aluno'] != $repetirSenha['senha2']){

			$retorno['ret'] = false;
			$retorno['msg'] .= '| As senhas digitadas não correspondem |';
			$sinal = true;

		}

		if($sinal){

			echo json_encode($retorno);
			exit;
		}

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

/////EDITAR ALUNO///////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function editarAluno(){


		$retorno['msg'] = "";
		$sinal=false;

		$dados['id_usuario'] = $this->input->post('idEditar');
		$dados['nome_aluno'] = $this->input->post("nomeEditar");
		$dados['email_aluno'] = $this->input->post("emailEditar");
		$dados['tb_classe_id_classe'] = $this->input->post("classeEditar");
		$dados['senha_aluno'] = $this->input->post("senhaEditar");
		$repetirSenha['senha2'] = $this->input->post("senha2Editar");
		$dados['status'] = $this->input->post("statEditar");


		if($dados['senha_aluno'] != $repetirSenha['senha2']){

			$retorno['ret'] = false;
			$retorno['msg'] .= 'As senhas digitadas não correspondem | ';
			$sinal = true;

		}


		if($sinal){

			echo json_encode($retorno);
			exit;
		}

		$tabela = 'tb_aluno';
		$condicao = $dados['id_usuario'];
		$coluna = 'id_usuario';

		$resultado = $this->crud->update($dados, $tabela, $condicao,$coluna);

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

////DESABILITAR ALUNO//////////////////////////////////////////////////////////////////////////////////////////////////////
	
	public function desabilitarAluno(){


		$retorno['msg'] = "";
		$sinal=false;
		
		

		$dados['status'] = $this->input->post("statDesativar");

		if($dados['status'] === 0){

			$retorno['ret'] = false;
			$retorno['msg'] .= 'Usuário já foi desativado';
			$sinal = true;

		}


		if($sinal){

			echo json_encode($retorno);
			exit;
		}

		$condicao = $this->input->post('idDesativar');
		$tabela = 'tb_aluno';
		$coluna = 'id_usuario';

		$resultado = $this->crud->delete($tabela,$condicao,$coluna);

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



///METODOS PARA EXPORTAR///////////////////////////////////////////////////////////////////////////////////////////////////

	public function exportarAdm(){


		$dados = array(
			'resultado' => $this->crud->selectAll()
		);

		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=administradores.xls');
		$this->load->view('exportar/exportAdm', $dados);


	}
	public function exportarAluno(){


		$dados = array(
			'resultado' => $this->crud->selectAllAlunos()
		);

		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=alunos.xls');
		$this->load->view('exportar/exportAluno', $dados);

	}
	public function exportarProfessor(){


		$dados = array(
			'resultado' => $this->crud->selectAllProfessores()
		);

		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=professores.xls');
		$this->load->view('exportar/exportProfessor', $dados);


	}



////CADASTRAR PROFESSOR //////////////////////////////////////////////////////////////////////////////////////////////////
	public function cadastrarProfessor(){


		$retorno['msg'] = "";
		$sinal=false;

		$dados['nome_professor'] = $this->input->post("nomeCadastrar");
		$dados['email_professor'] = $this->input->post("emailCadastrar");
		$dados['tb_classe_id_classe'] = $this->input->post("selectClasse");
		$dados['tb_disciplina_id_disciplina'] = $this->input->post("selectDisc");
		$dados['senha_professor'] = $this->input->post("senhaCadastrar");
		$repetirSenha['senha2'] = $this->input->post("senha2Cadastrar");
		$dados['status'] = $this->input->post("statCadastrar");

		$email = $dados['email_professor'];
		$tabela = 'tb_professor';
		$coluna = 'email_professor';

		$emailExiste = $this->crud->verificar($email,$tabela,$coluna);

		if($emailExiste){

			$retorno['ret'] = false;
			$retorno['msg'] .= '| O E-mail já está sendo utilizado |';
			$sinal = true;
		}

		if($dados['senha_professor'] != $repetirSenha['senha2']){

			$retorno['ret'] = false;
			$retorno['msg'] .= '| As senhas digitadas não correspondem |';
			$sinal = true;

		}

		if($sinal){

			echo json_encode($retorno);
			exit;
		}

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

/////EDITAR PROFESSOR///////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function editarProfessor(){


		$retorno['msg'] = "";
		$sinal=false;

		$dados['id_usuario'] = $this->input->post('idEditar');
		$dados['nome_professor'] = $this->input->post("nomeEditar");
		$dados['email_professor'] = $this->input->post("emailEditar");
		$dados['tb_disciplina_id_disciplina'] = $this->input->post("selectDiscEditar");
		$dados['tb_classe_id_classe'] = $this->input->post("selectClasseEditar");
		$dados['senha_professor'] = $this->input->post("senhaEditar");
		$repetirSenha['senha2'] = $this->input->post("senha2Editar");
		$dados['status'] = $this->input->post("statEditar");



		if($dados['senha_professor'] != $repetirSenha['senha2']){

			$retorno['ret'] = false;
			$retorno['msg'] .= 'As senhas digitadas não correspondem | ';
			$sinal = true;

		}


		if($sinal){

			echo json_encode($retorno);
			exit;
		}

		$tabela = 'tb_professor';
		$condicao = $dados['id_usuario'];
		$coluna = 'id_usuario';

		$resultado = $this->crud->update($dados, $tabela, $condicao,$coluna);

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

////DESABILITAR PROFESSOR//////////////////////////////////////////////////////////////////////////////////////////////////////
	
	public function desabilitarProfessor(){


		$retorno['msg'] = "";
		$sinal=false;
		
		

		$dados['status'] = $this->input->post("statDesativar");

		if($dados['status'] === 0){

			$retorno['ret'] = false;
			$retorno['msg'] .= 'Usuário já foi desativado';
			$sinal = true;

		}


		if($sinal){

			echo json_encode($retorno);
			exit;
		}

		$condicao = $this->input->post('idDesativar');
		$tabela = 'tb_professor';
		$coluna = 'id_usuario';

		$resultado = $this->crud->delete($tabela,$condicao,$coluna);

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