

listarAlunos();


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
						
						'<td>'+ dados[i].id_usuario +'</td>'+
						'<td>'+ dados[i].nome_aluno +'</td>'+
						'<td>'+ dados[i].nome_classe +'</td>'+
						'<td>'+ dados[i].email +'</td>'+
						'<td>'+
						'<button type="button" onclick="javascript:modalEditarAluno('+ i +');" class="btn btn-sm btn-primary mr-2" >Editar</button>'+
						' '+
						'<button type="button" onclick="javascript:modalDesativarAluno('+ i +');" class="btn btn-sm btn-danger mr-2" >Desabilitar</button>'+
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
			$('#classeCadastrar').prop("disabled",true);
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
				$('#classeCadastrar').prop("disabled",false);
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

				listarAlunos();

				$('.alert').delay(5000).slideUp(500, function(){ $(this).alert('close');});


			}
		}


	}); //Fechando o AJAX

}

////// EDITAR ALUNO ///////////////////////////////////////////////////////////////////////////////////////////
function modalEditarAluno(att){

	$('#modalEditarAluno').modal('show');

	$('#tituloNome').html(dadosGlobaisAluno[att].nome_aluno);

	$('#idEditar').val(dadosGlobaisAluno[att].id_usuario);
	$('#nomeEditar').val(dadosGlobaisAluno[att].nome_aluno);
	$('#emailEditar').val(dadosGlobaisAluno[att].email);
	$('#senhaEditar').val(dadosGlobaisAluno[att].senha);
	$('#senha2Editar').val(dadosGlobaisAluno[att].senha);
	$('#classeEditar').val(dadosGlobaisAluno[att].tb_classe_id_classe);
	$('#statEditar').val(dadosGlobaisAluno[att].stat);

} 

$('#formEditarAluno').submit(function(e) 
{
	e.preventDefault(); 
	var dados = $(this); 
	var retorno = atualizarDadosAluno(dados);

});

function atualizarDadosAluno(dados){

	$.ajax({
		type: "POST",
		data: dados.serialize(),
		url: "editarAluno",
		dataType: 'json',

		beforeSend: function(){


			$('#nomeEditar').prop("disabled",true);
			$('#emailEditar').prop("disabled",true);
			$('#senhaEditar').prop("disabled",true);
			$('#senha2Editar').prop("disabled",true);
			$('#classeEditar').prop("disabled",true);
			$('#botaoEditar').text('Editar').prop("disabled",true);
			


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
				$('#classeEditar').prop("disabled",false);
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

				$('#formEditarAluno').each(function(){
					this.reset();
				});

				$('#nomeEditar').prop("disabled",false);
				$('#emailEditar').prop("disabled",false);
				$('#classeEditar').prop("disabled",false);
				$('#senhaEditar').prop("disabled",false);
				$('#senha2Editar').prop("disabled",false);
				$('#statEditar').prop("disabled",false);
				$('#botaoEditar').prop("disabled",false);

				$('#modalEditarAluno').modal('hide');

				listarAlunos();

				$('.alert').delay(2000).slideUp(500, function(){ $(this).alert('close'); });
				

				
			}


		},

	});
}

////// DESATIVAR ///////////////////////////////////////////////////////////////////////////////////////////


function modalDesativarAluno(del){

	$('#modalDesativarAluno').modal('show');

	$('#tituloDesativar').html(dadosGlobaisAluno[del].nome_aluno);
	$('#idDesativar').val(dadosGlobaisAluno[del].id_usuario);
	$('#statDesativar').val(dadosGlobaisAluno[del].stat);
	$('#botaoDesativar').text('Sim').prop("disabled",false);
	
}

$('#formDesativarAluno').submit(function(e) 
{
	e.preventDefault(); 
	var dados = $(this); 
	var retorno = desabilitarDadosAluno(dados);

}); 

function desabilitarDadosAluno(dados){

	$.ajax({

		type: "POST",
		data: dados.serialize(),
		url: "desabilitarAluno",
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

				$('#modalDesativarAluno').modal('hide');

				listarAlunos();

				$('.alert').delay(2000).slideUp(500, function(){ $(this).alert('close'); });
				

				
			}
		}



	});

}

