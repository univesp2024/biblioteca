<main id="main" class="main">

  <!-- Meu debug -->
  <?php

  #var_dump($doacoes); 
#die();
# echo count($doacoes[0]);
  
  ?>


  <div class="pagetitle">
    <h1>Painel de bordo</h1>
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
          <li class="breadcrumb-item active"><i>Debug:</i> View/Usuario/MainView.php <i>Controller:</i> HomeController
          </li>
          <li class="breadcrumb-item active"><i>E-mail de teste:<?= $emailcookie ?></i>
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

          <!--  Card -->
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
                      <?= $qtdeDoacaoRealizada; ?>
                    </h6>
                  </div>
                </div>
              </div>
              <div class="ps-3">
              Última doação em <?= $dataultimaDoacao; ?>
              </div>

            </div>
          </div><!-- End  Card -->

          <!-- Revenue Card -->
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
                      <?= $qtdeSolicitacaoRealizada; ?>
                    </h6>
                  </div>

                </div>
              </div>
              <div class="ps-3">
              Última solicitação em <?= $dataultimasolicitacao ?>
              </div>
            </div>
          </div><!-- End Revenue Card -->

          <!-- Customers Card -->
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
                      <?= $qtdeTotalDoado; ?>
                    </h6>
                  </div>
                </div>

              </div>
              <div class="ps-3">
                Você faz parte dessa conquista!
                </div>
            </div>
          </div><!-- End Customers Card -->








          </div>

        </div><!-- End Recent  -->


      </div>
    </div><!-- End Left side columns -->


    </div>
  </section>

</main><!-- End #main -->