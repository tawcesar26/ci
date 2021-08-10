<div class="mt-2 fixed-top" style="position: absolute !important; z-index: 999999999;"><br>
	<div id="sucessoMsg"></div>
</div>



<div class="col-md-4 offset-md-4">
	<button type="button" onclick="javascript:modalCadastrar();"class="btn btn-sm btn-success mr-2">Novo cadastro</button>

</div>

<table class="table mt-4 table-bordered table-hover table-striped">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nome</th>
			<th>E-mail</th>
			<th>Login</th>
			<th>Status</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody id="tabelaAdm">


	</tbody>	
</table>

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




<!----------------------EDITAR----------------------------------->

<div id="modalEditar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">

		<div class="mt-2 fixed-top" style="position: absolute !important; z-index: 999999999;"><br>
			<div id="erroMsg"></div>
		</div>

		<div class="modal-content">
			<!-- MODAL HEADER ------------------------------------- -->
			<div class="modal-header">

				<div class="col-md-12" style="text-align: right;">
					<button type="button" class="btn btn-default" data-dismiss="modal">X</button>

				</div>

				<h3 style="display:block; text-align:center;">Editar - <strong id="tituloNome"></strong></h3>
			</div>

			<form id="formEditar">
				<div class="mt-3" id="erroMsgEditar"></div>
			<!-- MODAL BODY ------------------------------------- -->
				<div class="modal-body">

					<input type="hidden" name="idEditar" id="idEditar"/>
					<div class="form-group">
						<label for="nomeEditar">Nome</label>
						<input type="text" class="form-control" id="nomeEditar" autofocus name="nomeEditar" autocomplete="off">
					</div>
					<div class="form-group">
						<label for="emailEditar">E-mail</label>
						<input type="email" readonly=“true” class="form-control" id="emailEditar" name="emailEditar" autocomplete="off" >
					</div>
					<div class="form-group">
						<label for="loginEditar">Login</label>
						<input type="text" class="form-control" id="loginEditar" name="loginEditar" autocomplete="off" >
					</div>
					<div class="form-group">
						<label for="senhaEditar">Senha</label>
						<input type="password" class="form-control" id="senhaEditar" name="senhaEditar" autocomplete="off">
					</div>
					<div class="form-group">
						<label for="senha2Editar">Digite a Senha novamente</label>
						<input type="password" class="form-control" id="senha2Editar" name="senha2Editar" autocomplete="off">
					</div>
					<div class="form-group">
						<label for="statEditar">Status do Usuário: </label>
						<input type="radio"   name="statEditar" value="1"  checked> Ativo
						<input type="radio" name="statEditar" value="0" > Inativo
					</div>
				
				</div>
				<!-- MODAL FOOTER ------------------------------------- -->
				<div class="modal-footer">
					<button type="submit" id="botaoEditar" class="btn btn-primary">Enviar</button>
				</div>
			</form>
		</div>
	</div>
</div>
