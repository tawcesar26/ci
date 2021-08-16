

listarProfessores();
listarClasses();
listarDisciplinas();


function listarProfessores(){

	$.ajax({

		url: "listarProfessor",
		ajax: 'dados.json',

		success: function(dados){

			var dados = JSON.parse(dados);

			dadosGlobaisProfessor = dados; //Variavel Global é preenchida para utilizar posteriormente na Edição/Exclusão

			var tamanhoPagina = 10;
			var pagina = 0;

			function paginar() {
			    $('table > tbody > tr').remove();
			    var tbody = $('table > tbody');
			    for (var i = pagina * tamanhoPagina; i < dados.length && i < (pagina + 1) *  tamanhoPagina; i++) {
			        tbody.append(
			            $('<tr>')
			                .append($('<td>').append(dados[i].id_usuario))
			                .append($('<td>').append(dados[i].nome_professor))
			                .append($('<td>').append(dados[i].nome_disciplina))
			                .append($('<td>').append(dados[i].email_professor))
			                .append(
			                	'<td><button type="button" onclick="javascript:modalEditarProfessor('+ i +');" class="btn btn-sm btn-primary mr-2" >Editar</button>'+
								' '+
								'<button type="button" onclick="javascript:modalDesativarProfessor('+ i +');" class="btn btn-sm btn-danger mr-2" >Desabilitar</button></td>'
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


function listarClasses(){

	$.ajax({

		url: "listarClasses",
		ajax: 'dados.json',

		success: function(dados){

			var dados = JSON.parse(dados);

			$('#selectClasses').html('');

			if(dados.length > 0)
			{
				for (var i = 0; i < dados.length; i++) 
				{
					$('#selectClasses').append(
						'<input class="form-check-input" type="checkbox" id="selectClasse[]" name="selectClasse[]" value="'+ dados[i].id_classe +'">'+
					  	'<label class="form-check-label" for="inlineCheckbox1">'+dados[i].nome_classe+'</label><br>'

						);

					$('#selectClasseEditar').append(
						'<input class="form-check-input" type="checkbox" id="selectClasseEditar[]" value="'+ dados[i].id_disciplina +'">'+
					  	'<label class="form-check-label" for="inlineCheckbox1">'+dados[i].nome_disciplina+'</label><br>'

						);
				}
			}else
			{
				$('#selectClasses').append(
					'<option value="" >Nenhuma classe cadastrada</option>'
					);
				$('#selectClasseEditar').append(
					'<option value="" >Nenhuma classe cadastrada</option>'
					);
			}
		}


	});
}
function listarDisciplinas(){

	$.ajax({

		url: "listarDisciplinas",
		ajax: 'dados.json',

		success: function(dados){

			var dados = JSON.parse(dados);

			$('#selectDisc').html('');

			if(dados.length > 0)
			{	

				for (var i = 0; i < dados.length; i++) 
				{
					$('#selectDisc').append(
						'<option value="'+ dados[i].id_disciplina +'" >'+ dados[i].nome_disciplina+'</option>'

						);
					$('#selectDiscEditar').append(
						'<option value="'+ dados[i].id_disciplina +'" >'+ dados[i].nome_disciplina+'</option>'

						);
				}
			}else
			{
				$('#selectDisc').append(
					'<option value="" >Nenhuma classe cadastrada</option>'
					);
				$('#selectDiscEditar').append(
					'<option value="" >Nenhuma classe cadastrada</option>'
					);
			}
		}


	});
}


////// CADASTRO Professor  ///////////////////////////////////////////////////////////////////////////////////////////
$('#formCadastrarProfessor').submit(function(e) 
{
	e.preventDefault();
	var dados = $(this);
	var retorno = cadastrarProfessor(dados);

});

function modalCadastrarProfessor(){

	$('#modalCadastrarProfessor').modal('show');

} 

function cadastrarProfessor(dados)
{

	$.ajax({ //Abrindo o AJAX

		type: "POST",
		data: dados.serialize(),
		url: "cadastrarProfessor",
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

				$('#formCadastrarProfessor').each(function(){
					this.reset();
				});
				

				$('#modalCadastrarProfessor').modal('hide');

				listarProfessores();

				$('.alert').delay(5000).slideUp(500, function(){ $(this).alert('close');});


			}
		}


	}); //Fechando o AJAX

}

////// EDITAR Professor ///////////////////////////////////////////////////////////////////////////////////////////
function modalEditarProfessor(att){

	$('#modalEditarProfessor').modal('show');

	$('#tituloNome').html(dadosGlobaisProfessor[att].nome_professor);

	$('#idEditar').val(dadosGlobaisProfessor[att].id_usuario);
	$('#nomeEditar').val(dadosGlobaisProfessor[att].nome_professor);
	$('#emailEditar').val(dadosGlobaisProfessor[att].email_professor);
	$('#senhaEditar').val(dadosGlobaisProfessor[att].senha_professor);
	$('#senha2Editar').val(dadosGlobaisProfessor[att].senha_professor);
	$('#selectDiscEditar').val(dadosGlobaisProfessor[att].tb_disciplina_id_disciplina);
	$('#selectClasseEditar').val(dadosGlobaisProfessor[att].tb_classe_id_classe);
	$('#statEditar').val(dadosGlobaisProfessor[att].status);

} 

$('#formEditarProfessor').submit(function(e) 
{
	e.preventDefault(); 
	var dados = $(this); 
	var retorno = atualizarDadosProfessor(dados);

});

function atualizarDadosProfessor(dados){

	$.ajax({
		type: "POST",
		data: dados.serialize(),
		url: "editarProfessor",
		dataType: 'json',

		beforeSend: function(){


			$('#nomeEditar').prop("disabled",true);
			$('#emailEditar').prop("disabled",true);
			$('#senhaEditar').prop("disabled",true);
			$('#senha2Editar').prop("disabled",true);
			$('#selectClasse').prop("disabled",true);
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
				$('#selectClasse').prop("disabled",false);
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

				$('#formEditarProfessor').each(function(){
					this.reset();
				});

				$('#nomeEditar').prop("disabled",false);
				$('#emailEditar').prop("disabled",false);
				$('#selectClasse').prop("disabled",false);
				$('#senhaEditar').prop("disabled",false);
				$('#senha2Editar').prop("disabled",false);
				$('#statEditar').prop("disabled",false);
				$('#botaoEditar').prop("disabled",false);

				$('#modalEditarProfessor').modal('hide');

				listarProfessores();

				$('.alert').delay(2000).slideUp(500, function(){ $(this).alert('close'); });
				

				
			}


		},

	});
}

////// DESATIVAR ///////////////////////////////////////////////////////////////////////////////////////////


function modalDesativarProfessor(del){

	$('#modalDesativarProfessor').modal('show');

	$('#tituloDesativar').html(dadosGlobaisProfessor[del].nome_professor);
	$('#idDesativar').val(dadosGlobaisProfessor[del].id_usuario);
	$('#statDesativar').val(dadosGlobaisProfessor[del].status);
	$('#botaoDesativar').text('Sim').prop("disabled",false);
	
}

$('#formDesativarProfessor').submit(function(e) 
{
	e.preventDefault(); 
	var dados = $(this); 
	var retorno = desabilitarDadosProfessor(dados);

}); 

function desabilitarDadosProfessor(dados){

	$.ajax({

		type: "POST",
		data: dados.serialize(),
		url: "desabilitarProfessor",
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

				$('#modalDesativarProfessor').modal('hide');

				listarProfessores();

				$('.alert').delay(2000).slideUp(500, function(){ $(this).alert('close'); });
				

				
			}
		}



	});

}

