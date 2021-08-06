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
        
        $usuario = $this->input->post("login");
        $senha = $this->input->post("senha");

        $data = $this->Login_model->loginAdministrador($usuario,$senha);

            if ($data==true) {
                $session = array(
                    'id' => $data[0] ->idusuario,
                    'nome' => $data[0] ->nome,
                    'logado' => 1
                    );
                $this->session->set_userdata($session);
                redirect('Crud');
            } else {
                $dados['erro'] = "Dados incorretos!";
                $this->load->view("login", $dados);
            }



    }

    public function logout(){
        $this->session->unset_userdata("logado");
        redirect(base_url());
        
    }   
}