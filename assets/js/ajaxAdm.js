

////// CADASTRO /////////////////////////////////////////////////////////////////////////////////////////////
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
////// LISTAR ////////////////////////////////////////////////////////////////////////////////////////////////

listarUsuarios();


function listarUsuarios(){

	$.ajax({

		url: "listarUsuarios",
		ajax: 'dados.json',

		success: function(dados){

			var dados = JSON.parse(dados);

			dadosGlobaisAdm = dados; //Variavel Global é preenchida para utilizar posteriormente na Edição/Exclusão

			var tamanhoPagina = 6;
			var pagina = 0;

			function paginar() {
			    $('table > tbody > tr').remove();
			    var tbody = $('table > tbody');
			    for (var i = pagina * tamanhoPagina; i < dados.length && i < (pagina + 1) *  tamanhoPagina; i++) {
			        tbody.append(
			            $('<tr>')
			                .append($('<td>').append(dados[i].idusuario))
			                .append($('<td>').append(dados[i].nome))
			                .append($('<td>').append(dados[i].email))
			                .append(
			                	'<td><button type="button" onclick="javascript:modalEditarAdm('+ i +');" class="btn btn-sm btn-primary mr-2" >Editar</button>'+
								' '+
								'<button type="button" onclick="javascript:modalDesativarAdm('+ i +');" class="btn btn-sm btn-danger mr-2" >Desabilitar</button></td>'
								)
			        )
			    }
			    $('#numeracao').text('Página ' + (pagina + 1) + ' de ' + Math.ceil(dados.length / tamanhoPagina));
			}

			function ajustarBotoes() {
			    $('#proximo').prop('disabled', dados.length <= tamanhoPagina || pagina >= Math.ceil(dados.length / tamanhoPagina) - 1);
			    $('#anterior').prop('disabled', dados.length <= tamanhoPagina || pagina == 0);
			}

			$(function() {
			    $('#proximo').click(function() {
			        if (pagina < dados.length / tamanhoPagina - 1) {
			            pagina++;
			            paginar();
			            ajustarBotoes();
			        }
			    });
			    $('#anterior').click(function() {
			        if (pagina > 0) {
			            pagina--;
			            paginar();
			            ajustarBotoes();
			        }
			    });
			    paginar();
			    ajustarBotoes();
			});


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

$('#formDesativarProfessor').submit(function(e) 
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

				$('#formDesativarProfessor').each(function(){
					this.reset();
				});

				$('#botaoDesativar').prop("disabled",false);

				$('#modalDesativar').modal('hide');

				listarProfessores();

				$('.alert').delay(2000).slideUp(500, function(){ $(this).alert('close'); });
				

				
			}
		}



	});

}
