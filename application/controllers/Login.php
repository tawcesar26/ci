<?php

defined('BASEPATH') OR exit ('No direct script acess allowed');

class Login extends CI_Controller {

    function __construct() {

        parent::__construct();
        $this->load->model('Login_model');

    }

    public function index()
    {

        $this->load->view('login');

    }

    public function logar(){

        $usuario = $this->input->post("email");
        $senha = $this->input->post("senha");
        $id = $this->input->post('nivel');
        $data = false;

        //Login de Administrador///////////////////////////////////////////
        if($id == 1){

            $data = $this->Login_model->loginAdministrador($usuario,$senha);

        }
        //Login de Administrador///////////////////////////////////////////
        /*if($id == 2){

            $data = $this->Login_model->loginAluno($usuario,$senha);

        }
        //Login de Administrador///////////////////////////////////////////
        if($id == 3){

            $data = $this->Login_model->loginProfessor($usuario,$senha);

        }*/

        if ($data==true) {
            $session = array(
                'id' => $data[0] ->idusuario,
                'nome' => $data[0] ->nome,
                'logado' => 1
            );
            $this->session->set_userdata($session);
            redirect('Crud');
        } else {
            $dados['erro'] = "Usuário e/ou Senha incorretos!";
            $this->load->view("login", $dados);
        }

        ////////////////////////////////////////////////////////////////
        


    }

    public function logout(){
        $this->session->unset_userdata("logado");
        redirect(base_url());
        
    }   
}