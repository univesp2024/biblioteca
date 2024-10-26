<main id="main" class="main">

  <!-- Meu debug -->
  <?php

  #var_dump($dados);
  #die();
  # echo count($doacoes[0]);
  /*
  $session = \Config\Services::session();
  $id_usuario = $session->get('id_usuario');
  $cpf = $session->get('cpf');
  $nome_completo = $session->get('nome_completo');
  $email = $session->get('e-mail');
  $status = $session->get('status');
  $logged_in = $session->get('logged_in');
  */

  ?>


  <div class="pagetitle">
    <h1>Finalizar Empréstimo</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Início</a></li>
        <li class="breadcrumb-item">Finalizar empréstimo</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <!-- Mostrando o caminho do arquivo apenas quando em desenvolvimento -->
  <?php if ($environment == 'development'): ?>
    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active"><i>Debug:</i> View/Livro/FinalizaEmprestarView.php <i>Controller:</i>
            LivroController
          </li>
        </ol>
      </nav>
    </div>
  <?php endif; ?>
  <!-- Fim do debug -->

  <section class="section dashboard">
    <div class="row">
      <div class="card">
        <div class="card-header">
          <h6>Livro escolhido</h6>
        </div>
        <div class="card-body">
          <h6 class="mt-2">Tombo: <?= $dados['id_livro'] ?></h6>
          <h6>Título: <?= $dados['titulo'] ?></h6>
          <h6>Autor: <?= $dados['autor'] ?></h6>
          <h6>Qtde Disponível: <?= $dados['quantidade_disponivel'] ?></h6>

        </div>
      </div>
    </div>
  </section>


  <section class="section dashboard">
    <div class="row">
      <div class="card">
      <div class="card-header">
          <h6>Escolha o aluno</h6>
        </div>
        <div class="card-body">
          <h5 class="mt-3">Tombo: <?= $dados['id_livro'] ?></h5>
          <h5>Título: <?= $dados['titulo'] ?></h5>
          <h5>Autor: <?= $dados['autor'] ?></h5>
          <h5>Qtde Disponível: <?= $dados['quantidade_disponivel'] ?></h5>
        </div>
      </div>
    </div>
  </section>
  


</main><!-- End #main -->