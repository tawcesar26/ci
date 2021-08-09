<div id="divMain" class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  
  <h3 style="display:block; text-align:center;">Tela de Cadastro</h3>

  <form name="formAjax" onsubmit="return false;">
    
    <div class="form-group">
      <label for="nome">Nome</label>
      <input type="text" class="form-control" id="nome" autofocus name="nome" required>
    </div>
    <div class="form-group">
      <label for="email">E-mail</label>
      <input type="email" class="form-control" id="email" name="email"  required>
    </div>
    <div class="form-group">
      <label for="login">Loginl</label>
      <input type="text" class="form-control" id="login" name="login"  required>
    </div>
    <div class="form-group">
      <label for="email">Senha</label>
      <input type="password" class="form-control" id="senha" name="senha" required>
    </div>
    <div class="form-group">
      <label for="stat">Status</label><br>
      <input type="radio"   name="stat" value="1" required checked>Ativo<br>
      <input type="radio" name="stat" value="0" required>Inativo<br>
    </div>
    <div class="form-group">
      <div class="col-md-12">
        <button id="btnEnviar" class="form-control btn btn-primary" onclick="ajaxPost('<?= base_url('Crud/validaCadastro') ?>', '#divDestino'"> <i class="glyphicon glyphicon-ok"></i> Cadastrar</button>
      </div>
    </div>
  </form>
</div>


