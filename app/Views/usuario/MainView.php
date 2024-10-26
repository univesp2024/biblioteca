<main id="main" class="main">
  <?php
  #var_dump($dados); 
  #die();
  # echo count($doacoes[0]);
  ?>

  <div class="pagetitle">
    <h1>Página inicial</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home">Início</a></li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <!-- Mostrando o caminho do arquivo apenas quando em desenvolvimento -->
  <?php if ($environment == 'development'): ?>
    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active"><i>Debug:</i> View/Usuario/MainView.php <i>Controller:</i> HomeController
          </li>
        </ol>
      </nav>
    </div>
  <?php endif; ?>
  <!-- Fim do debug -->

  <section class="section dashboard">
    <?php // var_dump($doacoes)  ?>
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <!-- Primeira coluna -->
          <div class="col-md-6">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Disponíveis <span>| Livros</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-journal"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?= $total_livros; ?><span class="ms-3">disponíveis</span></h6>
                  </div>
                </div>
              </div>
              <!-- <div class="ps-3">Última doação em <?= $dataultimaDoacao; ?></div> -->
              <a href="emprestar_livro" class="btn btn-success mt-3 ms-3 me-3">
                <i class="bi bi-arrow-up-circle me-2"></i>Emprestar livro
              </a>
            </div>
          </div>

          <!-- Segunda coluna -->
          <div class="col-md-6">
            <div class="card info-card revenue-card">
              <div class="card-body">
                <h5 class="card-title">Emprestados <span>| Livros</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-journal-arrow-up"></i>
                  </div>
                  <div class="ps-3">
                    <h6><?= $livros_emprestados; ?><span class="ms-3">emprestados</span></h6>
                  </div>
                </div>
              </div>
              <!-- <div class="ps-3">Última doação em <?= $dataultimaDoacao; ?></div> -->
              <a href="devolver_livro" class="btn btn-success mt-3 ms-3 me-3">
                <i class="bi bi-arrow-down-circle me-2"></i>Devolver livro
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
</main>