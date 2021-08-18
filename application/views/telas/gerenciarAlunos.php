<!------Alerta de Sucesso-------------->

<div id="sucessoMsg" class="row" style="width: 80% ;position: absolute !important; z-index: 999999999;"></div>

<!------Botão Cadastrar-------------->

<div class="row" style="width: 80%;margin-left: 10px">

<a href="<?php echo base_url('listaClassesProfessor'); ?>"> <button type="button" class="btn btn-sm btn-info mr-2"><< Voltar</button></a>


</div>

<!------Tabela de Listagem-------------->
<br>

<table class="table mt-4 table-bordered table-hover table-striped">
<thead>
	<tr>
		<th>ID</th>
		<th>Nome</th>
		<th>Ações</th>
	</tr>
</thead>
<tbody id="tabelaAlunos">


          </tbody>  
</table>
<center>
  <ul class="pagination">
    <li class="page-item"><a id="anterior" disabled class="page-link" href="#">Anterior</a></li>
    <li class="page-item"><a class="page-link" href="#"><span id="numeracao"></span></a></li>
    <li class="page-item"><a id="proximo" disabled class="page-link" href="#">Próximo</a></li>
  </ul>
</center>



<!-- Modal 
<div class="modal fade" id="modalTabelaAlunos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Alunos Matriculados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
      	<table class="table mt-4 table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nome</th>
						</tr>
					</thead>
					<tbody id="tabelaAlunos">


					</tbody>	
					</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary">Salvar Alterações</button>
      </div>
    </div>
  </div>
</div>
-->



