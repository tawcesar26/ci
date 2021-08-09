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
				'<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#divMain">Editar</button>'. ' ' .'<button type="button" class="btn btn-danger">Deletar</button>'

			);
		}
		echo $this->table->generate();
		?>
	</div>
</div>


<div id="divMain" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<br>
			<div class="col-md-12" style="text-align: right;">
				<button type="button" class="btn btn-default" data-dismiss="modal">X</button>
				
			</div><br>
			<h3 style="display:block; text-align:center;">Editar Dados</h3>

			<div class="modal-body">
				<form name="formAjax" onsubmit="return false;">
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
							<button id="btnEnviar" class="form-control btn btn-primary" onclick="ajaxPost('<?= base_url('Crud/validaCadastro') ?>', '#divDestino'"> <i class="glyphicon glyphicon-ok"></i> Cadastrar</button>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				
			</div>
		</div>
	</div>

</div>
