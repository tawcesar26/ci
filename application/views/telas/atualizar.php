<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<?php 
		echo '<div class="well">';
		echo '<h1>Alteração de Usuários</h1>';
		echo '</div>';
		$iduser = $this->uri->segment(3);
		if ($iduser==NULL) redirect ('crud/retrieve');
		$query = $this->crud->get_byid($iduser)->row();
		echo form_open("crud/update/$iduser");
		echo validation_errors('<div class="alert alert-danger" role="alert">','</div>');
		if ($this->session->flashdata('edicaook')):
			echo '<div class="alert alert-success" role="alert">'.$this->session->flashdata('edicaook').'</div>';
		endif;
		echo '<div class="form-group">';
		echo form_label('Nome completo: ');
		echo form_input(array('name' => 'nome','class' => 'form-control'), set_value('nome',$query->nome),'autofocus');
		echo form_label('Email: ');
		echo form_input(array('name' => 'email','class' => 'form-control'), set_value('email', $query->email), 'disabled="disabled"');
		echo form_label('Login: ');
		echo form_input(array('name' => 'login','class' => 'form-control'), set_value('login',$query->login), 'disabled="disabled"');
		echo form_label('Senha: ');
		echo form_password(array('name' => 'senha','class' => 'form-control'), set_value('senha'));
		echo form_label('Repita-senha: ');
		echo form_password(array('name' => 'senha2','class' => 'form-control'), set_value('senha2'));
		echo '</div>';
		echo form_submit(array('name' => 'alterar','class' => 'btn btn-primary'), 'Alterar Dados');
		echo form_hidden('idusuario',$query->idusuario); //campo oculto com id de usuario para usar na condição do controller
		echo form_close();
		?>
	</div>
</div>