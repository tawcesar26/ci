$('#formCadastrar').submit(function(e) 
{
	e.preventDefault(); // Impedir o reload da pagina
	var dados = $(this); // Pegar os dados
	//alert(dados.serialize());
	var retorno = cadastrarUsuario(dados);

});

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

				$('#erroMsg').html(
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

				$('#nomeCadastrar').prop("disabled",false);
				$('#emailCadastrar').prop("disabled",false);
				$('#loginCadastrar').prop("disabled",false);
				$('#senhaCadastrar').prop("disabled",false);
				$('#senha2Cadastrar').prop("disabled",false);
				$('#statCadastrar').prop("disabled",false);
				$('#botaoCadastrar').text('Cadastrar outro... ').prop("disabled",false);

				$('.alert').delay(5000).slideUp(1000, function(){ $(this).alert('close'); });
			}
		}


	}); //Fechando o AJAX

}

