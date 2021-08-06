<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Tela de Cadastro</h3>

  <form id="form-cadastrar-adm" method="POST">
    
    <div class="form-group">
      <label for="nome">Nome</label>
      <input type="text" class="form-control" id="nome" autofocus name="nome" required>
    </div>
    <div class="form-group">
      <label for="email">E-mail</label>
      <input type="email" class="form-control" id="email" name="email"  required>
    </div>
    <div class="form-group">
      <label for="email">Senha</label>
      <input type="password" class="form-control" id="senha" name="senha" required>
    </div>
    <div class="form-group">
      <label for="email">Status</label><br>
      <input type="radio"   name="status" value="1" required checked>Ativo<br>
      <input type="radio" name="status" value="0" required>Inativo<br>
    </div>
    <div class="form-group">
      <div class="col-md-12">
        <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Cadastrar</button>
      </div>
    </div>
  </form>
</div>