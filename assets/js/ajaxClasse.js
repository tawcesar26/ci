


listarClasses();
listarAlunos();


function listarClasses(){

	$.ajax({

		url: "tabelaClasses",
		ajax: 'dados.json',

		success: function(dados){

			var dados = JSON.parse(dados);

			dadosGlobaisClasse = dados;

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
							'<td><button type="button" onclick="javascript:redirectAlunos();" class="btn btn-sm btn-primary mr-2" >Gerenciar</button>'+
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
						
						'<td>'+ dados[i].id_usuario +'</td>'+
						'<td>'+ dados[i].nome_aluno +'</td>'+		
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

	//$('#modalTabelaAlunos').modal('show');

	//$('#idClasse').val(dadosGlobaisClasse[id].tb_classe_id_classe);
	
	//$('#idDisciplina').val(dadosGlobaisClasse[id].tb_disciplina_id_disciplina);

} 

