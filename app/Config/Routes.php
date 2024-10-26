<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
# $routes->setAutoRoute(true);

# ------------------------------------ [Login] 
$routes->get('/', 'LoginController::index', ['as'=> 'login']);
$routes->post('autenticar','LoginController::autenticar');
$routes->get('logout','LoginController::logout', ['as'=> 'logout']);

# ------------------------------------ [Home] 
$routes->get('home','HomeController::index', ['as'=> 'home', 'filter' => 'authGuard']);


# ------------------------------------ [Livros] 
$routes->get('emprestar_livro','LivroController::emprestar_livro', ['as'=> 'emprestar_livro', 'filter' => 'authGuard']);

$routes->get('devolver_livro','LivroController::devolver_livro', ['as'=> 'devolver_livro', 'filter' => 'authGuard']);

$routes->get('consultar_livro','LivroController::consultar_livro', ['as'=> 'consultar_livro', 'filter' => 'authGuard']);

$routes->get('finaliza_emprestimo/(:num)', 'LivroController::finaliza_emprestimo/$1', ['as'=> 'finaliza_emprestimo', 'filter' => 'authGuard']);

$routes->get('registra_emprestimo/(:segment)/(:segment)', 'LivroController::registra_emprestimo/$1/$2', [
    'as' => 'registra_emprestimo',
    'filter' => 'authGuard'
]);



$routes->get('limpacookie','HomeController::limpacookie', ['filter' => 'authGuard']);


# ------------------------------------ [Dashboard] 
$routes->get('dashboard','DashboardController::index', ['as'=> 'dashboard', 'filter' => 'authGuard']);


# ------------------------------------ [Usuario] 
$routes->get('cadastro','UsuarioController::index', ['as'=> 'cadastro']);
$routes->post('salvar_usuario','UsuarioController::salvar_usuario', ['as'=> 'salvar_usuario']);
$routes->post('update_usuario','UsuarioController::update_usuario', ['as'=> 'update_usuario']);
$routes->post('update_senha','UsuarioController::update_senha', ['as'=> 'update_senha']);

$routes->get('sucesso','UsuarioController::sucesso', ['as'=> 'sucesso']);
$routes->get('meuperfil','UsuarioController::meuperfil', ['as'=> 'meuperfil', 'filter' => 'authGuard']);

$routes->get('adminMeuPerfil','UsuarioController::adminMeuPerfil', ['as'=> 'adminMeuPerfil', 'filter' => 'authGuard']);

$routes->get('alterarsenha','UsuarioController::alterarsenha', ['as'=> 'alterarsenha', 'filter' => 'authGuard']);


# ------------------------------------ [Solicitacao] 
$routes->get('listasolicitacao',
             'SolicitacaoController::index', 
             ['filter' => 'authGuard']
);

$routes->get('solicitadoacao',
             'SolicitacaoController::solicitadoacao', 
             ['filter' => 'authGuard']
);

$routes->post('inseresolicitadoacao',
              'SolicitacaoController::inseresolicitadoacao', 
              ['filter' => 'authGuard']
);


# ------------------------------------ [Doação] 
$routes->get('minhasdoacoes',
             'DoacaoController::minhasdoacoes', 
             ['filter' => 'authGuard']
);

$routes->get('inserirdoacao',
             'DoacaoController::inserirdoacao', 
             ['filter' => 'authGuard']
);

$routes->post('inserirdoacaopost',
              'DoacaoController::inserirdoacaopost', 
              ['filter' => 'authGuard']
);