<div class="row">
	<div class="col-md-6 col-md-offset-3">
	<?php

	echo '<div class="well">';
	echo '<h1>Cadastro de Usuários</h1>';
	echo '</div>';
	echo form_open('Crud/validaCadastro');
	echo validation_errors('<div class="alert alert-danger" role="alert">','</div>');
	if ($this->session->flashdata('cadastrook')):
	echo '<div class="alert alert-success" role="alert">'.$this->session->flashdata('cadastrook').'</div>';
	endif;
	echo '<div class="form-group">';
	echo form_label('Nome completo: ');
	echo form_input(array('name' => 'nome','class' => 'form-control', 'placeholder' => 'Seu nome'), set_value('nome'),'autofocus');
	echo form_label('Email: ');
	echo form_input(array('name' => 'email','class' => 'form-control', 'placeholder' => 'Seu email'), set_value('email'));
	echo form_label('Login: ');
	echo form_input(array('name' => 'login','class' => 'form-control', 'placeholder' => 'Seu login'), set_value('login'));
	echo form_label('Senha: ');
	echo form_password(array('name' => 'senha','class' => 'form-control', 'placeholder' => 'Sua senha'), set_value('senha'));
	echo form_label('Repita-senha: ');
	echo form_password(array('name' => 'senha2','class' => 'form-control', 'placeholder' => 'Sua senha novamente'), set_value('senha2'));
	echo '</div>';
	echo form_submit(array('name' => 'cadastrar','class' => 'btn btn-primary'), 'Cadastrar');
	echo form_close();
		?>
	</div>

	<!--<form action="<?php //echo base_url('validaCadastro') ?>" method="post" accept-charset="utf-8">
		<div class="form-group">
			<label>Nome completo: </label>
			<input type="text" name="nome" value="" class="form-control" placeholder="Seu nome" autofocus  />
			<label>Email: </label>
			<input type="text" name="email" value="" class="form-control" placeholder="Seu email"  />
			<label>Login: </label>
			<input type="text" name="login" value="" class="form-control" placeholder="Seu login"  />
			<label>Senha: </label>
			<input type="password" name="senha" value="" class="form-control" placeholder="Sua senha"  />
			<label>Repita-senha: </label>
			<input type="password" name="senha2" value="" class="form-control" placeholder="Sua senha novamente"  />
		</div>
		<input type="submit" name="cadastrar" value="Cadastrar" class="btn btn-primary"  />
	</form>-->

</div>