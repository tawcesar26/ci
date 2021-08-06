<?php 

$this->load->view('includes/header');
echo '<nav class="container">';
$this->load->view('includes/menu');

if($tela!=''){

	$this->load->view('telas/'.$tela); //Carregando a view setada pela váriavel $tela via parâmetro no controller

}
echo '</nav>';
$this->load->view('includes/footer');
 ?>