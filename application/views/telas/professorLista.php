<!------Alerta de Sucesso-------------->

<div id="sucessoMsg" class="row" style="width: 80% ;position: absolute !important; z-index: 999999999;"></div>

<!------Botão Cadastrar-------------->

<div class="row" style="width: 80%;margin-left: 10px">
	<button type="button" onclick="javascript:modalCadastrarProfessor();" class="btn btn-sm btn-success mr-2"> Novo cadastro</button>
	<a href="<?php echo base_url('exportarProfessor'); ?>"> <button type="button" class="btn btn-sm btn-info mr-2"> Exportar Excel</button></a>


</div>

<!------Tabela de Listagem-------------->
<br>
<table class="table mt-4 table-bordered table-hover table-striped">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nome</th>
			<th>Curso</th>
			<th>E-mail</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody id="tabelaProfessor">


	</tbody>	
</table>


<!----------------------INICIO DO MODAL CADASTRAR----------------------------------->

<div id="modalCadastrarProfessor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">

		<div class="modal-content">
			<!-- MODAL HEADER ------------------------------------- -->
			<div class="modal-header">

				<div class="col-md-12" style="text-align: right;">
					<button type="button" class="btn btn-default" data-dismiss="modal">X</button>

				</div>

				<h3 style="display:block; text-align:center;">Cadastro Professor</h3>
			</div>

			<form id="formCadastrarProfessor">
				<div id="erroMsgCadastrar"></div>
				<!-- MODAL BODY ------------------------------------- -->
				<div class="modal-body">
	
					<div class="form-group">
						<label for="nomeCadastrar">Nome</label>
						<input type="text" class="form-control" id="nomeCadastrar" autofocus name="nomeCadastrar" autocomplete="off" required>
					</div>
					<div class="form-group">
						<label for="emailCadastrar">E-mail</label>
						<input type="email" class="form-control" id="emailCadastrar" name="emailCadastrar" autocomplete="off" required>
					</div>
					<div class="form-group">
						<label for="classeCadastrar">Classe</label>
						<select class="form-control" id="classeCadastrar" name="classeCadastrar" required>
							<option value="" >Selecionar a classe:</option>
							<option value="1" >1º Ano Médio</option>
							<option value="2" >2º Ano Médio</option>
							<option value="3" >3º Ano Médio</option>
						</select>
					</div>
					<div class="form-group">
						<label for="discCadastrar">Disciplina</label>
						<select class="form-control" id="discCadastrar" name="discCadastrar" required>
							<option value="" >Selecionar a disciplina:</option>
							<option value="101" >Matematica</option>
							<option value="102" >Português</option>
						</select>
					</div>
					<div class="form-group">
						<label for="senhaCadastrar">Senha</label>
						<input type="password" class="form-control" id="senhaCadastrar" name="senhaCadastrar" autocomplete="off" required>
					</div>
					<div class="form-group">
						<label for="senha2Cadastrar">Digite a Senha novamente</label>
						<input type="password" class="form-control" id="senha2Cadastrar" name="senha2Cadastrar" autocomplete="off" required>
					</div>

						<input type="hidden" name="statCadastrar" id="statCadastrar" value="1" />

					
				</div>
				<!-- MODAL FOOTER ------------------------------------- -->
				<div class="modal-footer">
					<button type="submit" id="botaoCadastrar" class="form-control btn btn-primary"> Cadastrar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!----------------------FIM DO MODAL CADASTRAR----------------------------------->


<!----------------------INICIO DO MODAL EDITAR----------------------------------->

<div id="modalEditarProfessor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">


		<div class="modal-content">
			<!-- MODAL HEADER ------------------------------------- -->
			<div class="modal-header">

				<div class="col-md-12" style="text-align: right;">
					<button type="button" class="btn btn-default" data-dismiss="modal">X</button>

				</div>

				<h3 style="display:block; text-align:center;">Editar - <strong id="tituloNome"></strong></h3>
			</div>

			<form id="formEditarProfessor">
				<div id="erroMsgEditar"></div>
				<!-- MODAL BODY ------------------------------------- -->
				<div class="modal-body">

					<input type="hidden" name="idEditar" id="idEditar"/>
					<div class="form-group">
						<label for="nomeEditar">Nome</label>
						<input type="text" class="form-control" id="nomeEditar" autofocus name="nomeEditar" autocomplete="off">
					</div>
					<div class="form-group">
						<label for="emailEditar">E-mail</label>
						<input type="email" class="form-control" id="emailEditar" name="emailEditar" autocomplete="off" >
					</div>
					<div class="form-group">
						<label for="classeEditar">Classe</label>
						<select class="form-control" id="classeEditar" name="classeEditar" required>
							<option value="" >Selecionar a classe:</option>
							<option value="1" >1º Ano Médio</option>
							<option value="2" >2º Ano Médio</option>
							<option value="3" >3º Ano Médio</option>
						</select>
					</div>
					<div class="form-group">
						<label for="senhaEditar">Senha</label>
						<input type="password" class="form-control" id="senhaEditar" name="senhaEditar" autocomplete="off">
					</div>
					<div class="form-group">
						<label for="senha2Editar">Digite a Senha novamente</label>
						<input type="password" class="form-control" id="senha2Editar" name="senha2Editar" autocomplete="off">
					</div>
				<input type="hidden" name="statEditar" id="statEditar" value="1" />
					
				</div>
				<!-- MODAL FOOTER ------------------------------------- -->
				<div class="modal-footer">
					<button type="submit" id="botaoEditar" class="btn btn-primary">Editar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!----------------------FIM DO MODAL EDITAR----------------------------------------->


<!----------------------INICIO DO MODAL DESATIVAR----------------------------------->

<div id="modalDesativarProfessor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">

		<div class="modal-content">
			<!-- MODAL HEADER ------------------------------------------------------->
			<div class="modal-header">
				<h3 style="display:block; text-align:center;">Excluir Usuário</h3>
			</div>

			<form id="formDesativarProfessor">
				<div id="erroMsgDesativar"></div>

				<input type="hidden" name="idDesativar" id="idDesativar">
				<input type="hidden" name="statDesativar" id="statDesativar">
				<!-- MODAL BODY --------------------------------------------------------->
				<div class="modal-body">

					<p>Deseja excluir o usuário <strong id="tituloDesativar"></strong> ?</p>
					<p>Após confirmação, esta ação não poderá ser desfeita.</p>	

				</div>
				<!-- MODAL FOOTER ------------------------------------- -->
				<div class="modal-footer">
					<button type="submit" id="botaoDesativar" class="btn btn-success"> Sim</button>
					<button type="button" class="btn btn-info" data-dismiss="modal"> Não</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!----------------------FIM DO MODAL DESATIVAR----------------------------------->

