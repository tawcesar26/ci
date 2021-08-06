<div class="row">
	<div class="col-md-12 col-md-offset-3">
		
		<div class="well">
		<h4>Usuarios Cadastrados</h4><br>
		</div>
		
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
					anchor("Crud/update/$linha->idusuario",'<button type="button" class="btn btn-warning">Editar</button>'). ' ' .anchor("Crud/delete/$linha->idusuario",'<button type="button" class="btn btn-danger">Deletar</button>')

				);
			}
			echo $this->table->generate();
		?>
	</div>
</div>