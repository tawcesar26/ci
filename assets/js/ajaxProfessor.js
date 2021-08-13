

listarProfessores();
listarClasses();
listarDisciplinas();



function listarProfessores(){

	$.ajax({

		url: "listarProfessor",
		ajax: 'lista2.json',

		success: function(lista2){

			var dados = JSON.parse(lista2);

			dadosGlobaisProfessor = dados; //Variavel Global é preenchida para utilizar posteriormente na Edição/Exclusão

			$('#tabelaProfessor').html('');

			if(dados.length > 0)
			{

				for (var i = 0; i < dados.length; i++) 
				{
					$('#tabelaProfessor').append(
						'<tr>'+
						
						'<td>'+ dados[i].id_usuario +'</td>'+
						'<td>'+ dados[i].nome_professor +'</td>'+
						'<td>'+ dados[i].nome_classe +'</td>'+
						'<td>'+ dados[i].nome_disciplina +'</td>'+
						'<td>'+ dados[i].email_professor +'</td>'+
						'<td>'+
						'<button type="button" onclick="javascript:modalEditarProfessor('+ i +');" class="btn btn-sm btn-primary mr-2" >Editar</button>'+
						' '+
						'<button type="button" onclick="javascript:modalDesativarProfessor('+ i +');" class="btn btn-sm btn-danger mr-2" >Desabilitar</button>'+
						'</td>'+		
						'</tr>'	

						);
				}

			}else
			{
				$('#tabelaProfessor').append(

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


function listarClasses(){

	$.ajax({

		url: "listarClasses",
		ajax: 'dados.json',

		success: function(dados){

			var dados = JSON.parse(dados);

			$('#selectClasse').html('');

			if(dados.length > 0)
			{
				for (var i = 0; i < dados.length; i++) 
				{
					$('#selectClasse').append(
						'<option value="'+ dados[i].id_classe +'" >'+ dados[i].nome_classe+'</option>'

					);
					$('#selectClasse2').append(
						'<option value="'+ dados[i].id_classe +'" >'+ dados[i].nome_classe+'</option>'

					);
				}
			}else
			{
				$('#selectClasse').append(
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
				}
			}else
			{
				$('#selectDisc').append(
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
	$('#classeEditar').val(dadosGlobaisProfessor[att].tb_classe_id_classe);
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

	$('#tituloDesativar').html(dadosGlobaisProfessor[del].nome_aluno);
	$('#idDesativar').val(dadosGlobaisProfessor[del].id_usuario);
	$('#statDesativar').val(dadosGlobaisProfessor[del].stat);
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

				listarProfessor();

				$('.alert').delay(2000).slideUp(500, function(){ $(this).alert('close'); });
				

				
			}
		}



	});

}

