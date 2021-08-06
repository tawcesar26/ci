 <aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url(); ?>assets/AdminLTE/dist/img/avatar5.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $this->session->userdata('nome'); ?></p>
      </div>
    </div>
    
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MENU</li>
      
      <li <?php if ($page == 'home') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('home'); ?>">

          <i class="glyphicon glyphicon-home"></i> <span>Página Inicial</span>
          <span class="pull-right-container">

          </span>
        </a>
      </li>
      <li <?php if ($page == 'comissao') {echo 'class="active"';} ?>>
        <a href="<?php echo base_url('validaCadastro'); ?>">
          <i class="fa fa-group"></i> <span>Cadastro</span>
          <span class="pull-right-container">

          </span>
        </a>
      </li>
      <li <?php if ($page == 'usuarios1' || $page == 'usuarios2' || $page =='usuarios3') {echo 'class="treeview active"';}
      else{
        echo "class='treeview'";
      } ?>>
        <a href="#">
         <i class="glyphicon glyphicon-user"></i> <span>Usuários</span>
         <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li  <?php if ($page == 'usuarios1') {echo 'class="active"';} ?> > 
          <a href="<?php echo base_url('Administrador/listarAlunos'); ?>"><i class="fa fa-circle-o"></i> Aluno
          </a>
        </li>
        <li  <?php if ($page == 'usuarios2') {echo 'class="active"';} ?> > 
          <a href="<?php echo base_url('Administrador/listarProfessores'); ?>"><i class="fa fa-circle-o"></i> Professor
          </a>
        </li>
        <li  <?php if ($page == 'usuarios3') {echo 'class="active"';} ?> > 
          <a href="<?php echo base_url('Administrador/listarFuncionarios'); ?>"><i class="fa fa-circle-o"></i> Funcionario</a>
        </li>
      </ul>
    </li>
  </ul>
</section>
<!-- /.sidebar -->
</aside>
