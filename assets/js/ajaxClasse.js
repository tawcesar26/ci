


listarClasses();
listarAlunos();


function listarClasses(){

	$.ajax({

		url: "tabelaClasses",
		ajax: 'dados.json',

		success: function(dados){

			var dados = JSON.parse(dados);

			var tamanhoPagina = 10;
			var pagina = 0;

			function paginar() {

				$('#tabelaClasses').html('');


				for (var i = pagina * tamanhoPagina; i < dados.length && i < (pagina + 1) *  tamanhoPagina; i++) {
					$('#tabelaClasses').append(
						$('<tr>')
						.append($('<td>').append(dados[i].id_usuario))
						.append($('<td>').append(dados[i].nome_professor))
						.append($('<td>').append(dados[i].nome_classe))
						.append($('<td>').append(dados[i].nome_disciplina))
						.append(
							'<td><button type="button" onclick="javascript:redirectAlunos();" class="btn btn-sm btn-primary mr-2" >Boletins</button>'+
							'</td>'
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

function listarAlunos(){

	$.ajax({

		url: "tabelaAlunos",
		ajax: 'dados.json',

		success: function(dados){

			var dados = JSON.parse(dados);

			dadosGlobaisClasse = dados;

			$('#tabelaAlunos').html('');

			if(dados.length > 0)
			{

				for (var i = 0; i < dados.length; i++) 
				{
					$('#tabelaAlunos').append(
						'<tr>'+			
						'<td>'+ dados[i].nome_aluno +'</td>'+
						'<td>'+ dados[i].nota1 +'</td>'+
						'<td>'+ dados[i].nota2 +'</td>'+
						'<td>'+ dados[i].nota3 +'</td>'+
						'<td>'+ dados[i].nota4 +'</td>'+
						'<td>S/N</td>'+
						'<td>'+
						(1 > 0 ? '<button type="button" onclick="javascript:modalEditarNota('+ i +');" class="btn btn-sm btn-success mr-2" >Inserir Nota</button>' : '<button type="button" onclick="javascript:modalEditarNota('+ i +');" class="btn btn-sm btn-primary mr-2" >Editar Nota</button>') +
						'</td>'+		
						'</tr>'	

						);
				}

			}else
			{
				$('#tabelaAlunos').append(

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






function redirectAlunos(){

	window.location.href = "listaAlunosProfessor";

}

function modalEditarNota(id){

	$('#modalEditarNota').modal('show');

	$('#tituloNome').html(dadosGlobaisClasse[id].nome_aluno);
	$('#tituloClasse').html(dadosGlobaisClasse[id].nome_classe);
	$('#tituloDisciplina').html(dadosGlobaisClasse[id].nome_disciplina);

	$('#idAluno').val(dadosGlobaisClasse[id].id_aluno);
	$('#disciplinaAluno').val(dadosGlobaisClasse[id].id_disciplina);
	$('#nota1').val(dadosGlobaisClasse[id].nota1);
	$('#nota2').val(dadosGlobaisClasse[id].nota2);
	$('#nota3').val(dadosGlobaisClasse[id].nota3);
	$('#nota4').val(dadosGlobaisClasse[id].nota4);
	
} 

$('#formEditarNota').submit(function(e) 
{
	e.preventDefault(); 
	var dados = $(this); 
	var retorno = atualizarNotas(dados);

});

function atualizarNotas(dados){


	$.ajax({
		type: "POST",
		data: dados.serialize(),
		url: "atualizarNotas",
		dataType: 'json',

		beforeSend: function(){


			$('#nota1').prop("disabled",true);
			$('#nota2').prop("disabled",true);
			$('#nota3').prop("disabled",true);
			$('#nota4').prop("disabled",true);
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

				$('#nota1').prop("disabled",false);
				$('#nota2').prop("disabled",false);
				$('#nota3').prop("disabled",false);
				$('#nota4').prop("disabled",false);

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

				$('#formEditarNota').each(function(){
					this.reset();
				});

				$('#nota1').prop("disabled",false);
				$('#nota2').prop("disabled",false);
				$('#nota3').prop("disabled",false);
				$('#nota4').prop("disabled",false);
				$('#botaoEditar').prop("disabled",false);

				$('#modalEditarNota').modal('hide');

				listarAlunos();

				$('.alert').delay(2000).slideUp(500, function(){ $(this).alert('close'); });
				

				
			}


		},

	});
}


