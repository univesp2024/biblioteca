<main id="main" class="main">

  <!-- Meu debug -->
  <?php

    #var_dump($doacoes); 
    #die();
    # echo count($doacoes[0]);
    $session = \Config\Services::session();
    $id_usuario = $session->get('id_usuario');
    $cpf = $session->get('cpf');
    $nome_completo = $session->get('nome_completo');
    $email = $session->get('e-mail');
    $status = $session->get('status');
    $logged_in = $session->get('logged_in');
  
  ?>


  <div class="pagetitle">
    <h1>Devolver livro</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home">Início</a></li>
        <li class="breadcrumb-item">Devolver livro</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <!-- Mostrando o caminho do arquivo apenas quando em desenvolvimento -->
  <?php if ($environment == 'development'): ?>
    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active"><i>Debug:</i> View/Livro/EmprestarView.php <i>Controller:</i> LivroController
          </li>
        </ol>
      </nav>
    </div>
  <?php endif; ?>
  <!-- Fim do debug -->

  <section class="section dashboard">
  <div class="row">
    <div class="col-lg-12">
      <div class="row">
        <div class="col-12">
          <div class="card info-card customers-card">
            <div class="card-body">
              <h5 class="card-title">Vidas <span>| Salvas</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-newspaper"></i>
                </div>
                <div class="ps-3">
                  <h6>Emprestar</h6>
                </div>
              </div>
            </div>
            <div class="ps-3">Você faz parte dessa conquista!</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</main><!-- End #main -->