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
    <h1>Página inicial</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home">Home</a></li>
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
          <li class="breadcrumb-item active"><i>E-mail de teste:</i>
          </li>
        </ol>
      </nav>
    </div>
  <?php endif; ?>
  <!-- Fim do debug -->

  <section class="section dashboard">


    <?php // var_dump($doacoes)  ?>

    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">


<!--        
          
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Doações <span>| Realizadas</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-balloon-heart-fill"></i>
                  </div>
                  <div class="ps-3">
                    <h6>
                      
                    </h6>
                  </div>
                </div>
              </div>
              <div class="ps-3">
              Última doação em 
              </div>
            </div>
          </div>

          
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">
              <div class="card-body">
                <h5 class="card-title">Doações <span>| Solicitadas</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-heart-pulse"></i>
                  </div>
                  <div class="ps-3">
                    <h6>
                     
                    </h6>
                  </div>
                </div>
              </div>
              <div class="ps-3">
              Última solicitação em 
              </div>
            </div>
          </div>

  -->

          <!-- Card -->
          <div class="col-xxl-4 col-xl-12">
            <div class="card info-card customers-card">
              <div class="card-body">
                <h5 class="card-title">Vidas <span>| Salvas</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-newspaper"></i>
                  </div>
                  <div class="ps-3">
                    <h6>
                      <?= $nome_completo ?>
                    </h6>
                  </div>
                </div>

              </div>
              <div class="ps-3">
                Você faz parte dessa conquista!
                </div>
            </div>
          </div><!-- End Card -->








          </div>

        </div><!-- End Recent  -->


      </div>
    </div><!-- End Left side columns -->


    </div>
  </section>

</main><!-- End #main -->