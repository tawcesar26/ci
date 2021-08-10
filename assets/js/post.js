


$('#formCadastrar').submit(function(e) 
{
	e.preventDefault(); // Impedir o reload da pagina
	var dados = $(this); // Pegar os dados
	//alert(dados.serialize());
	var retorno = cadastrarUsuario(dados);

});

function modalCadastrar(){

	$('#divMain').modal('show');

} 

function cadastrarUsuario(dados)
{

	$.ajax({ //Abrindo o AJAX

		type: "POST",
		data: dados.serialize(),
		url: "Crud/cadastrarAdm",
		dataType: 'json',

		beforeSend: function()
		{
			$('#nomeCadastrar').prop("disabled",true);
			$('#emailCadastrar').prop("disabled",true);
			$('#loginCadastrar').prop("disabled",true);
			$('#senhaCadastrar').prop("disabled",true);
			$('#senha2Cadastrar').prop("disabled",true);
			$('#statCadastrar').prop("disabled",true);
			$('#botaoCadastrar').text('Cadastrando... ').prop("disabled",true);

		},

		success: function(retorno)
		{
			if(retorno.ret === false)
			{

				$('#erroMsg').html(

					'<div class="col-md-12">'+	
					'<div class="alert alert-danger" alert-dismissible role="alert">' +
					'<strong> Erro! </strong> <br>' +
					retorno.msg +
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
					'<span aria-hidden="true">&times;</span>'+
					'</button>'+
					'</div>'+
					'</div>'
					);

				$('#nomeCadastrar').prop("disabled",false);
				$('#emailCadastrar').prop("disabled",false);
				$('#loginCadastrar').prop("disabled",false);
				$('#senhaCadastrar').prop("disabled",false);
				$('#senha2Cadastrar').prop("disabled",false);
				$('#statCadastrar').prop("disabled",false);
				$('#botaoCadastrar').text('Tentar novamente... ').prop("disabled",false);

				$('.alert').delay(5000).slideUp(1000, function(){

					$(this).alert('close'); 

				});

			} else
			{

				$('#sucessoMsg').html(
					'<div class="col-md-12">'+	
					'<div class="alert alert-success alert-dismissible" role="alert">'+
					'<strong>Erro!</strong><br>'+
					retorno.msg+
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
					'<span aria-hidden="true">&times;</span>'+
					'</button>'+
					'</div>'+
					'</div>'

					);

				$('#formCadastrar').each(function(){
					this.reset();
				});

				$('#nomeCadastrar').prop("disabled",false);
				$('#emailCadastrar').prop("disabled",false);
				$('#loginCadastrar').prop("disabled",false);
				$('#senhaCadastrar').prop("disabled",false);
				$('#senha2Cadastrar').prop("disabled",false);
				$('#statCadastrar').prop("disabled",false);
				$('#botaoCadastrar').text('Cadastrar outro... ').prop("disabled",false);

				$('#divMain').modal('hidden');
				

				listarUsuarios();
			}
		}


	}); //Fechando o AJAX

}

listarUsuarios();

function listarUsuarios(){

	$.ajax({

		url: "listarUsuarios",
		ajax: 'lista.json',

		success: function(lista){

			var dados = JSON.parse(lista);

			dadosGlobais = dados;

			$('#tabelaAdm').html('');

			if(dados.length > 0)
			{

				for (var i = 0; i < dados.length; i++) 
				{
					$('#tabelaAdm').append(
						'<tr>'+
						
						'<td>'+ dados[i].idusuario +'</td>'+
						'<td>'+ dados[i].nome +'</td>'+
						'<td>'+ dados[i].email +'</td>'+
						'<td>'+ dados[i].login +'</td>'+
						'<td>'+ dados[i].stat +'</td>'+
						'<td>'+
							'<button type="button" onclick="javascript:modalEditar('+ i +');" class="btn btn-sm btn-primary mr-2" >Editar</button>'+
							'  '+
							'<button type="button" onclick="javascript:modalApagar('+ i +');" class="btn btn-sm btn-danger mr-2" >Deletar</button>'+
						'</td>'+		
						'</tr>'	

						);
					}

			}else
			{
				$('#tabelaAdm').append(
						
						'<td colspan="6"></td>'+
							'<center class="mt-4" text-center>'+
								'<div class="col-md-12 text-center">'+
									'<div class="alert alert-danger text-danger">'+
										'<i class="fas fa-exclamation-circle"></i>Nenhum usuário cadastrado'+		
									'</div>'+
								'</div>'+	
							'</center>'+		
						'</td>'	

						);

			}
		}


	});
}

function modalEditar(att){

	$('#modalEditar').modal('show');

	$('#tituloNome').html(dadosGlobais[att].nome);

	$('#idEditar').val(dadosGlobais[att].idusuario);
	$('#nomeEditar').val(dadosGlobais[att].nome);
	$('#emailEditar').val(dadosGlobais[att].email);
	$('#loginEditar').val(dadosGlobais[att].login);
	$('#senhaEditar').val(dadosGlobais[att].senha);
	$('#senha2Editar').val(dadosGlobais[att].senha);
	$('#statEditar').val(dadosGlobais[att].stat);


} 

$('#formEditar').submit(function(e) 
{
	e.preventDefault(); // Impedir o reload da pagina
	var dados = $(this); // Pegar os dados
	//alert(dados.serialize());
	var retorno = cadastrarUsuario(dados);

});

function atualizarDados(dados){

	$.ajax({
		type: "POST",
		data: dados.serialize(),
		dataType: 'json',

		beforeSend: function(){

			$('#nomeEditar').prop("disabled",true);
			$('#emailEditar').prop("disabled",true);
			$('#loginEditar').prop("disabled",true);
			$('#senhaEditar').prop("disabled",true);
			$('#senha2Editar').prop("disabled",true);
			$('#statEditar').prop("disabled",true);
			$('#botaoEditar').text('Cadastrando... ').prop("disabled",true);


		},

		success: function(){

			if(retorno.ret === false)
			{

				$('#erroMsgEditar').html(

					'<div class="col-md-12">'+	
					'<div class="alert alert-danger" alert-dismissible role="alert">' +
					'<strong> Erro! </strong> <br>' +
					retorno.msg +
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
					'<span aria-hidden="true">&times;</span>'+
					'</button>'+
					'</div>'+
					'</div>'
					);

				$('#nomeEditar').prop("disabled",false);
				$('#emailEditar').prop("disabled",false);
				$('#loginEditar').prop("disabled",false);
				$('#senhaEditar').prop("disabled",false);
				$('#senha2Editar').prop("disabled",false);
				$('#statEditar').prop("disabled",false);
				$('#botaoEditar').text('Tentar novamente... ').prop("disabled",false);

				$('.alert').delay(5000).slideUp(1000, function(){

					$(this).alert('close'); 

				});

			} else
			{

				$('#sucessoMsg').html(
					'<div class="col-md-12">'+	
					'<div class="alert alert-success alert-dismissible" role="alert">'+
					'<strong>Erro!</strong><br>'+
					retorno.msg+
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
					'<span aria-hidden="true">&times;</span>'+
					'</button>'+
					'</div>'+
					'</div>'

					);

				$('#formEditar').each(function(){
					this.reset();
				});

				$('#nomeEditar').prop("disabled",false);
				$('#emailEditar').prop("disabled",false);
				$('#loginEditar').prop("disabled",false);
				$('#senhaEditar').prop("disabled",false);
				$('#senha2Editar').prop("disabled",false);
				$('#statEditar').prop("disabled",false);
				$('#botaoEditar').prop("disabled",false);

				$('.alert').delay(5000).slideUp(1000, function(){ $(this).alert('close');});

				$('#modaEditar').modal('hidden');

				listarUsuarios();
			}


		},

	});
}




