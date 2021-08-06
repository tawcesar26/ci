<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<?php

		
		if ($this->session->flashdata('cadastrook')):
			echo '<div class="alert alert-success" role="alert">'.$this->session->flashdata('cadastrook').'</div>';
		endif;
		
		?>
	</div>

	<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">

		
		<h3 style="display:block; text-align:center;">Tela de Cadastro</h3>

		<form action="<?= base_url('Crud/validaCadastro') ?>" method="post">

			<div class="form-group">
				<label for="nome">Nome</label>
				<input type="text" class="form-control" id="nome" autofocus name="nome" required>
			</div>
			<div class="form-group">
				<label for="email">E-mail</label>
				<input type="email" class="form-control" id="email" name="email"  required>
			</div>
			<div class="form-group">
				<label for="login">Login</label>
				<input type="text" class="form-control" id="login" name="login"  required>
			</div>
			<div class="form-group">
				<label for="email">Senha</label>
				<input type="password" class="form-control" id="senha" name="senha" required>
			</div>
			<div class="form-group">
				<label for="senha2">Digite a Senha novamente</label>
				<input type="password" class="form-control" id="senha2" name="senha2" required>
			</div>
			<div class="form-group">
				<label for="stat">Status do Usuário: </label>
				<input type="radio"   name="stat" value="1" required checked> Ativo
				<input type="radio" name="stat" value="0" required> Inativo
			</div>
			

			<div class="form-group">
				<div class="col-md-12">
					<button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Cadastrar</button>
				</div>
			</div>
		</form>
	</div>

</div>