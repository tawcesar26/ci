<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CRUD</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/login.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE/plugins/iCheck/square/blue.css">

</head>
<body style="background-image: url(<?php echo base_url();?>assets/AdminLTE/dist/img/background.png);">

 <div class="container">
      <div class="login-container">
        <div id="output"></div>
        <div><h2>Login de Acesso</h2></div>
        <div class="form-box">
          <br>
         <form action="<?= base_url('Login/logar') ?>" method="post">
            <input type="text" placeholder="Email:" required name="email">
            <input type="password" placeholder="Senha:" required name="senha">
            <select type="text" required name="nivel">
              <option value="" disabled selected>Nível de Acesso:</option>
              <option value="1">Administrador</option>
              <option value="2">Opção 2</option>
              <option value="3">Opção 3</option>
          </select>
             
            <br><br>

          <button class="btn btn-primary btn-block" type="submit">Acessar</button>
          <?php if (isset($erro)): ?>
           <div class="alert alert-danger" role="alert" style="margin-top: 10px;"><?php echo $erro; ?></div>
         <?php endif; ?>
       </form>
     </div>
    </div>
</div>



</body>
</html>
