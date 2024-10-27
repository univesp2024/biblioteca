<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
# $routes->setAutoRoute(true);

# ------------------------------------ [Login] 
//$routes->get('/', 'LoginController::index', ['as'=> 'login']);

$routes->get('/', 'LivroController::index', ['as'=> 'login']);

$routes->get('administrar', 'LoginController::index', ['as'=> 'administrar']);
$routes->post('autenticar','LoginController::autenticar');
$routes->get('logout','LoginController::logout', ['as'=> 'logout']);

# ------------------------------------ [Home] 
$routes->get('home','HomeController::index', ['as'=> 'home', 'filter' => 'authGuard']);


# ------------------------------------ [Livros] 
$routes->get('emprestar_livro','LivroController::emprestar_livro', ['as'=> 'emprestar_livro', 'filter' => 'authGuard']);

$routes->get('devolver_livro','LivroController::devolver_livro', ['as'=> 'devolver_livro', 'filter' => 'authGuard']);

$routes->get('consultar_livro','LivroController::consultar_livro', ['as'=> 'consultar_livro', 'filter' => 'authGuard']);

$routes->get('aluno_devolver/(:segment)/(:segment)', 'LivroController::aluno_devolver/$1/$2', [
    'as' => 'aluno_devolver',
    'filter' => 'authGuard'
]);

$routes->get('cadastrar_livro','LivroController::cadastrar_livro', ['as'=> 'cadastrar_livro', 'filter' => 'authGuard']);

//cadastrar_livro
$routes->post('cadastrar_livro_post','LivroController::cadastrar_livro_post');

# ------------------------------------ [Consultar Livros Público] 
$routes->get(
    'consulta_publica_livro',
    'LivroController::consulta_publica_livro', 
    ['as'=> 'consulta_publica_livro'
]);


# ------------------------------------ [Alunos] 

$routes->get('cadastrar_aluno','AlunoController::cadastrar_aluno', ['as'=> 'cadastrar_aluno', 'filter' => 'authGuard']);

//cadastrar_livro
$routes->post('cadastrar_aluno_post','AlunoController::cadastrar_aluno_post');

$routes->get('GerenciaAluno','AlunoController::GerenciaAluno', ['as'=> 'GerenciaAluno', 'filter' => 'authGuard']);

$routes->get('apaga_aluno/(:segment)','AlunoController::apaga_aluno/$1', ['as'=> 'apaga_aluno', 'filter' => 'authGuard']);

$routes->get('editar_aluno/(:segment)','AlunoController::editar_aluno/$1', ['as'=> 'editar_aluno', 'filter' => 'authGuard']);

$routes->post('editar_aluno_post','AlunoController::editar_aluno_post');



# ------------------------------------ [Emprestimo] 
$routes->get('finaliza_emprestimo/(:segment)', 'LivroController::finaliza_emprestimo/$1', ['as'=> 'finaliza_emprestimo', 'filter' => 'authGuard']);

$routes->get('registra_emprestimo/(:segment)/(:segment)', 'LivroController::registra_emprestimo/$1/$2', [
    'as' => 'registra_emprestimo',
    'filter' => 'authGuard'
]);


$routes->get(
    'historico_emprestimos',
    'EmprestimoController::historico_emprestimos', 
    [
        'as'=> 'historico_emprestimos', 
        'filter' => 'authGuard'
    ]);





// $routes->get('limpacookie','HomeController::limpacookie', ['filter' => 'authGuard']);


# ------------------------------------ [Dashboard] 
//$routes->get('dashboard','DashboardController::index', ['as'=> 'dashboard', 'filter' => 'authGuard']);


# ------------------------------------ [Usuario] 
$routes->get('cadastro','UsuarioController::index', ['as'=> 'cadastro']);
$routes->post('salvar_usuario','UsuarioController::salvar_usuario', ['as'=> 'salvar_usuario']);
$routes->post('update_usuario','UsuarioController::update_usuario', ['as'=> 'update_usuario']);
$routes->post('update_senha','UsuarioController::update_senha', ['as'=> 'update_senha']);

$routes->get('sucesso','UsuarioController::sucesso', ['as'=> 'sucesso']);
$routes->get('meuperfil','UsuarioController::meuperfil', ['as'=> 'meuperfil', 'filter' => 'authGuard']);

$routes->get('adminMeuPerfil','UsuarioController::adminMeuPerfil', ['as'=> 'adminMeuPerfil', 'filter' => 'authGuard']);

$routes->get('alterarsenha','UsuarioController::alterarsenha', ['as'=> 'alterarsenha', 'filter' => 'authGuard']);

