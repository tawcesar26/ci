

////// CADASTRO /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$('#formCadastrarAdm').submit(function(e) 
{
	e.preventDefault();
	var dados = $(this);
	var retorno = cadastrarAdm(dados);

});

function modalCadastrarAdm(){

	$('#modalCadastrarAdm').modal('show');

} 

function cadastrarAdm(dados)
{

	$.ajax({ //Abrindo o AJAX

		type: "POST",
		data: dados.serialize(),
		url: "cadastrarAdm",
		dataType: 'json',

		beforeSend: function()
		{
			$('#nomeCadastrar').prop("disabled",true);
			$('#emailCadastrar').prop("disabled",true);
			$('#senhaCadastrar').prop("disabled",true);
			$('#senha2Cadastrar').prop("disabled",true);
			$('#statCadastrar').prop("disabled",true);
			$('#botaoCadastrar').text('Cadastrando... ').prop("disabled",true);

		},

		success: function(retorno)
		{
			if(retorno.ret === false)
			{

				$('#erroMsgCadastrar').html(

					'<div class="col-md-12">'+	
					'<div class="alert alert-danger alert-dismissible role="alert">' +
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
				$('#senhaCadastrar').prop("disabled",false);
				$('#senha2Cadastrar').prop("disabled",false);
				$('#statCadastrar').prop("disabled",false);
				$('#botaoCadastrar').text('Tentar novamente... ').prop("disabled",false);

				$('.alert').delay(5000).slideUp(500, function(){$(this).alert('close');});

			} else
			{

				$('#sucessoMsg').html(
					'<div class="col-md-12">'+	
					'<div class="alert alert-success alert-dismissible" role="alert">'+
					'<strong>Sucesso!</strong><br>'+
					retorno.msg+
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
					'<span aria-hidden="true">&times;</span>'+
					'</button>'+
					'</div>'+
					'</div>'

					);

				$('#formCadastrarAdm').each(function(){
					this.reset();
				});
				

				$('#modalCadastrarAdm').modal('hide');

				listarUsuarios();

				$('.alert').delay(5000).slideUp(500, function(){ $(this).alert('close');});


			}
		}


	}); //Fechando o AJAX

}
////// LISTAR //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

listarUsuarios();
listarAlunos();

function listarUsuarios(){

	$.ajax({

		url: "listarUsuarios",
		ajax: 'lista.json',

		success: function(lista){

			var dados = JSON.parse(lista);

			dadosGlobaisAdm = dados; //Variavel Global é preenchida para utilizar posteriormente na Edição/Exclusão

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
						'<td>'+
						'<button type="button" onclick="javascript:modalEditarAdm('+ i +');" class="btn btn-sm btn-primary mr-2" >Editar</button>'+
						' '+
						'<button type="button" onclick="javascript:modalDesativar('+ i +');" class="btn btn-sm btn-danger mr-2" >Desabilitar</button>'+
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

function listarAlunos(){

	$.ajax({

		url: "listarAlunos",
		ajax: 'lista2.json',

		success: function(lista2){

			var dados = JSON.parse(lista2);

			dadosGlobaisAluno = dados; //Variavel Global é preenchida para utilizar posteriormente na Edição/Exclusão

			$('#tabelaAluno').html('');

			if(dados.length > 0)
			{

				for (var i = 0; i < dados.length; i++) 
				{
					$('#tabelaAluno').append(
						'<tr>'+
						
						'<td>'+ dados[i].idusuario +'</td>'+
						'<td>'+ dados[i].nome +'</td>'+
						'<td>'+ dados[i].curso +'</td>'+
						'<td>'+ dados[i].email +'</td>'+
						'<td>'+
						'<button type="button" onclick="javascript:m('+ i +');" class="btn btn-sm btn-primary mr-2" >Editar</button>'+
						' '+
						'<button type="button" onclick="javascript:m('+ i +');" class="btn btn-sm btn-danger mr-2" >Desabilitar</button>'+
						'</td>'+		
						'</tr>'	

						);
				}

			}else
			{
				$('#tabelaAluno').append(

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

////// EDITAR ///////////////////////////////////////////////////////////////////////////////////////////
function modalEditarAdm(att){

	$('#modalEditarAdm').modal('show');

	$('#tituloNome').html(dadosGlobaisAdm[att].nome);

	$('#idEditar').val(dadosGlobaisAdm[att].idusuario);
	$('#nomeEditar').val(dadosGlobaisAdm[att].nome);
	$('#emailEditar').val(dadosGlobaisAdm[att].email);
	$('#senhaEditar').val(dadosGlobaisAdm[att].senha);
	$('#senha2Editar').val(dadosGlobaisAdm[att].senha);
	$('#statEditar').val(dadosGlobaisAdm[att].stat);

} 

$('#formEditarAdm').submit(function(e) 
{
	e.preventDefault(); 
	var dados = $(this); 
	var retorno = atualizarDados(dados);

});

function atualizarDados(dados){

	$.ajax({
		type: "POST",
		data: dados.serialize(),
		url: "editarAdm",
		dataType: 'json',

		beforeSend: function(){

			$('#nomeEditar').prop("disabled",true);
			$('#emailEditar').prop("disabled",true);
			$('#senhaEditar').prop("disabled",true);
			$('#senha2Editar').prop("disabled",true);
			$('#statEditar').prop("disabled",true);
			


		},

		success: function(retorno){

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
				$('#senhaEditar').prop("disabled",false);
				$('#senha2Editar').prop("disabled",false);
				$('#statEditar').prop("disabled",false);
				$('#botaoEditar').prop("disabled",false);

				$('.alert').delay(5000).slideUp(500, function(){$(this).alert('close'); });

			} else
			{

				$('#sucessoMsg').html(
					'<div class="col-md-12">'+	
					'<div class="alert alert-success alert-dismissible" role="alert">'+
					'<strong>Sucesso!</strong><br>'+
					retorno.msg+
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
					'<span aria-hidden="true">&times;</span>'+
					'</button>'+
					'</div>'+
					'</div>'

					);

				$('#formEditarAdm').each(function(){
					this.reset();
				});

				$('#nomeEditar').prop("disabled",false);
				$('#emailEditar').prop("disabled",false);
				$('#senhaEditar').prop("disabled",false);
				$('#senha2Editar').prop("disabled",false);
				$('#statEditar').prop("disabled",false);
				$('#botaoEditar').prop("disabled",false);

				$('#modalEditarAdm').modal('hide');

				listarUsuarios();

				$('.alert').delay(2000).slideUp(500, function(){ $(this).alert('close'); });
				

				
			}


		},

	});
}

////// DESATIVAR ///////////////////////////////////////////////////////////////////////////////////////////


function modalDesativar(del){

	$('#modalDesativar').modal('show');

	$('#tituloDesativar').html(dadosGlobaisAdm[del].nome);
	$('#idDesativar').val(dadosGlobaisAdm[del].idusuario);
	$('#statDesativar').val(dadosGlobaisAdm[del].stat);
	$('#botaoDesativar').text('Sim').prop("disabled",false);
	


}

$('#formDesativar').submit(function(e) 
{
	e.preventDefault(); 
	var dados = $(this); 
	var retorno = desabilitarDados(dados);

}); 

function desabilitarDados(dados){

	$.ajax({

		type: "POST",
		data: dados.serialize(),
		url: "desabilitar",
		dataType: 'json',

		beforeSend: function(){

			$('#botaoDesativar').text('Sim').prop("disabled",true);

		},

		success: function(retorno){

			if(retorno.ret === false)
			{

				$('#erroMsgDesativar').html(

					'<div class="col-md-12">'+	
					'<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
					'<strong> Erro! </strong> <br>' +
					retorno.msg +
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
					'<span aria-hidden="true">&times;</span>'+
					'</button>'+
					'</div>'+
					'</div>'
					);


				$('#botaoDesabilitar').prop("disabled",false);

				$('.alert').delay(5000).slideUp(500, function(){$(this).alert('close'); });

			}
			else
			{

				$('#sucessoMsg').html(
					'<div class="col-md-12">'+	
					'<div class="alert alert-success alert-dismissible" role="alert">'+
					'<strong>Sucesso!</strong><br>'+
					retorno.msg+
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
					'<span aria-hidden="true">&times;</span>'+
					'</button>'+
					'</div>'+
					'</div>'

					);

				$('#formDesativar').each(function(){
					this.reset();
				});

				$('#botaoDesativar').prop("disabled",false);

				$('#modalDesativar').modal('hide');

				listarUsuarios();

				$('.alert').delay(2000).slideUp(500, function(){ $(this).alert('close'); });
				

				
			}
		}



	});

}

////// CADASTRO ALUNO  ///////////////////////////////////////////////////////////////////////////////////////////
$('#formCadastrarAluno').submit(function(e) 
{
	e.preventDefault();
	var dados = $(this);
	var retorno = cadastrarAluno(dados);

});

function modalCadastrarAluno(){

	$('#modalCadastrarAluno').modal('show');

} 

function cadastrarAluno(dados)
{

	$.ajax({ //Abrindo o AJAX

		type: "POST",
		data: dados.serialize(),
		url: "cadastrarAluno",
		dataType: 'json',

		beforeSend: function()
		{
			$('#nomeCadastrar').prop("disabled",true);
			$('#emailCadastrar').prop("disabled",true);
			$('#senhaCadastrar').prop("disabled",true);
			$('#senha2Cadastrar').prop("disabled",true);
			$('#statCadastrar').prop("disabled",true);
			$('#botaoCadastrar').text('Cadastrando... ').prop("disabled",true);

		},

		success: function(retorno)
		{
			if(retorno.ret === false)
			{

				$('#erroMsgCadastrar').html(

					'<div class="col-md-12">'+	
					'<div class="alert alert-danger alert-dismissible role="alert">' +
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
				$('#senhaCadastrar').prop("disabled",false);
				$('#senha2Cadastrar').prop("disabled",false);
				$('#statCadastrar').prop("disabled",false);
				$('#botaoCadastrar').text('Tentar novamente... ').prop("disabled",false);

				$('.alert').delay(5000).slideUp(500, function(){$(this).alert('close');});

			} else
			{

				$('#sucessoMsg').html(
					'<div class="col-md-12">'+	
					'<div class="alert alert-success alert-dismissible" role="alert">'+
					'<strong>Sucesso!</strong><br>'+
					retorno.msg+
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
					'<span aria-hidden="true">&times;</span>'+
					'</button>'+
					'</div>'+
					'</div>'

					);

				$('#formCadastrarAluno').each(function(){
					this.reset();
				});
				

				$('#modalCadastrarAluno').modal('hide');

				listarUsuarios();

				$('.alert').delay(5000).slideUp(500, function(){ $(this).alert('close');});


			}
		}


	}); //Fechando o AJAX

}