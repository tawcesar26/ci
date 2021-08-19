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
		<th>Nome</th>
    <th>Nota 1</th>
    <th>Nota 2</th>
    <th>Nota 3</th>
    <th>Nota 4</th>
    <th>Média</th>
		<th>Ações</th>
	</tr>
</thead>
<tbody id="tabelaAlunos">


</tbody>  
</table>



<!----------------------INICIO DO MODAL EDITAR----------------------------------->

<div id="modalEditarNota" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">


  <div class="modal-content">
    <!-- MODAL HEADER ------------------------------------- -->
    <div class="modal-header">

      <div class="col-md-12" style="text-align: right;">
        <button type="button" class="btn btn-default" data-dismiss="modal">X</button>

      </div>

      <h3 style="display:block; text-align:center;">Nota</h3>
    </div>

    <form id="formEditarNota">
      <div id="erroMsgEditar"></div>
      <!-- MODAL BODY ------------------------------------- -->
      <div class="modal-body">

        <h4>Dados do Aluno</h4>

        <p>Nome: <em id="tituloNome"></em></p>
        <input type="hidden" id="idAluno" name="idAluno">

        <p>Classe: <em id="tituloClasse"></em></p>

        <p>Disciplina: <em id="tituloDisciplina"></em></p>
         <input type="hidden" id="disciplinaAluno" name="disciplinaAluno">


      
            <div class="box-body">
              <div class="row">
                <div class="col-xs-3">
                  <label for="nomeEditar">Nota 1</label>
                  <input type="number" class="form-control" id="nota1" name="nota1" step="0.1" min="0" max="10" placeholder="Exemplo: 99.9">
                </div>
                <div class="col-xs-3">
                  <label for="nomeEditar">Nota 2</label>
                  <input type="number" class="form-control" id="nota2" name="nota2" step="0.1" min="0" max="10"placeholder="Exemplo: 99.9">
                </div>
                <div class="col-xs-3">
                  <label for="nomeEditar">Nota 3</label>
                  <input type="number" class="form-control" id="nota3" name="nota3" step="0.1" min="0" max="10"placeholder="Exemplo: 99.9">
                </div>
                 <div class="col-xs-3">
                  <label for="nomeEditar">Nota 4</label>
                  <input type="number" class="form-control" id="nota4" name="nota4" step="0.1" min="0" max="10" placeholder="Exemplo: 99.9">
                </div>

              </div>
            </div>

        </div>
        <!-- MODAL FOOTER ------------------------------------- -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </div>
      </form>
    </div>
  </div>
</div>





