<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Login'; //Controlador Principal
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['home'] = 'Crud';
$route['sair'] = 'Login/logout';


//Rotas para as listas de usuários
$route['listaAdmin'] = 'Crud/listaAdmin';
$route['listaAluno'] = 'Crud/listaAluno';
$route['listaProfessor'] = 'Crud/listaProfessor';


//Rotas do Ajax
//ADMINISTRADOR
$route['cadastrarAdm']['post'] = 'Crud/cadastrarAdm';
$route['listarUsuarios'] = 'Crud/listarUsuarios';
$route['editarAdm']['post'] = 'Crud/editarAdm';
$route['desabilitar']['post'] = 'Crud/desabilitarAdm';

//ALUNO
$route['cadastrarAluno']['post'] = 'Crud/cadastrarAluno';
$route['listarAlunos']= 'Crud/listarAlunos';
$route['editarAluno']['post'] = 'Crud/editarAluno';
$route['desabilitarAluno']['post'] = 'Crud/desabilitarAluno';

//PROFESSOR
$route['cadastrarProfessor']['post'] = 'Crud/cadastrarProfessor';
$route['listarProfessor']= 'Crud/listarProfessor';
$route['editarProfessor']['post'] = 'Crud/editarProfessor';
$route['desabilitarProfessor']['post'] = 'Crud/desabilitarProfessor';
$route['listarClasses'] = 'Crud/listarClasses';
$route['listarDisciplinas'] = "Crud/listarDisciplinas";

//Exportar XLS
$route['exportarAdm'] = 'Crud/exportarAdm';
$route['exportarAluno'] = 'Crud/exportarAluno';
$route['exportarProfessor'] = 'Crud/exportarProfessor';
