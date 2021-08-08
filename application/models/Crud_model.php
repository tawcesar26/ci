<?php 

defined('BASEPATH') OR exit ('No direct script acess allowed');

class Crud_model extends CI_Model{	

	function __construct(){

		$this->load->database();

	}
		// FUNÇÃO RESPONSAVEL POR INSERIR O REGISTRO NA BASE
		public function do_insert($dados=NULL){

			if ($dados!=NULL){

				$this->db->insert('tb_adm',$dados);	
				$this->session->set_flashdata('cadastrook', 'Cadastro efetuado com sucesso');
				redirect('Crud/validaCadastro');
			}
			
		}

		public function get_all(){

			$id = $this->session->userdata('id');

			return $this->db->query('SELECT * FROM tb_adm WHERE idusuario != '.$id.'');

		}

		public function get_byid($id=NULL){

			if ($id!=NULL){

				$this->db->where('idusuario',$id);
				$this->db->limit(1); 
				return $this->db->get('tb_usuarios');

			}else{

				return FALSE;
			}
		}

		// FUNÇÃO RESPONSAVEL POR ATUALIZAR O REGISTRO NA BASE
		public function do_update($dados=NULL,$condicao=NULL){

				if ($dados!=NULL && condicao!=NULL):
				
				$this->db->update('tb_usuarios',$dados,$condicao);	
				$this->session->set_flashdata('edicaook', 'Cadastro alterado com sucesso');
				redirect(current_url());

				endif;
		}	
}