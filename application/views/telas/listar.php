<div class="col-md-4 offset-md-4">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#divMain">Novo cadastro</button>

</div>

	<div class="row">
	<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
		
		<?php 
		if ($this->session->flashdata('excluirok')):
			echo '<p>'.$this->session->flashdata('excluirok').'</p>';
		endif;
		$template = array(
			'table_open' => '<table class="table table-striped">'
		);
		$this->table->set_template($template);

		$this->table->set_heading('ID','Nome','Email','Login','Ações');


		foreach ($usuarios as $linha){
			$this->table->add_row(
				$linha->idusuario, 
				$linha->nome, 
				$linha->email,
				$linha->login, 
				'<button type="button" class="btn btn-warning" data-toggle="modal" data-target="">Editar</button>'. ' ' .'<button type="button" class="btn btn-danger">Deletar</button>'

			);
		}
		echo $this->table->generate();
		?>
	</div>
</div>


<div id="divMain" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">

		<div class="mt-2 fixed-top" style="position: absolute !important; z-index: 999999999;"><br>
		<div id="erroMsg"></div>
		</div>


		<div class="modal-content">
			<br>
			<div class="col-md-12" style="text-align: right;">
				<button type="button" class="btn btn-default" data-dismiss="modal">X</button>
				
			</div><br>
			<h3 style="display:block; text-align:center;">Cadastro</h3>

			<div class="modal-body">
				<form id="formCadastrar">
					<div class="form-group">
						<label for="nomeCadastrar">Nome</label>
						<input type="text" class="form-control" id="nomeCadastrar" autofocus name="nomeCadastrar" autocomplete="off">
					</div>
					<div class="form-group">
						<label for="emailCadastrar">E-mail</label>
						<input type="email" class="form-control" id="emailCadastrar" name="emailCadastrar" autocomplete="off" >
					</div>
					<div class="form-group">
						<label for="loginCadastrar">Login</label>
						<input type="text" class="form-control" id="loginCadastrar" name="loginCadastrar" autocomplete="off" >
					</div>
					<div class="form-group">
						<label for="senhaCadastrar">Senha</label>
						<input type="password" class="form-control" id="senhaCadastrar" name="senhaCadastrar" autocomplete="off">
					</div>
					<div class="form-group">
						<label for="senha2Cadastrar">Digite a Senha novamente</label>
						<input type="password" class="form-control" id="senha2Cadastrar" name="senha2Cadastrar" autocomplete="off">
					</div>
					<div class="form-group">
						<label for="statCadastrar">Status do Usuário: </label>
						<input type="radio"   name="statCadastrar" value="1"  checked> Ativo
						<input type="radio" name="statCadastrar" value="0" > Inativo
					</div>
					<div class="form-group">
						<div class="col-md-12">
							<button id="botaoCadastrar" type="submit" class="form-control btn btn-primary"> Cadastrar</button>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				
			</div>
		</div>
	</div>

</div>
