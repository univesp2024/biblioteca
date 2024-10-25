<main id="main" class="main">

<!-- Meu debug -->
<?php  

#var_dump($doacoes); 
#die();
# echo count($doacoes[0]);

?>


<div class="pagetitle">
  <h1>Administração</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
      <li class="breadcrumb-item active">Painel de bordo</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-12">
      <div class="row">

        <!-- Sales Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card sales-card">

            <div class="card-body">
              <h5 class="card-title">Doações <span>| Realizadas</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-balloon-heart-fill"></i>
                </div>
                <div class="ps-3">
                  <h6><?php echo isset($doacoes) ? count($doacoes)  : 0; ?></h6>
                </div>
              </div>
            </div>

          </div>
        </div><!-- End Sales Card -->

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
                  <h6>0</h6>
                </div>
                
              </div>
            </div>

          </div>
        </div><!-- End Revenue Card -->

        <!-- Customers Card -->
        <div class="col-xxl-4 col-xl-12">

          <div class="card info-card customers-card">



            <div class="card-body">
              <h5 class="card-title">Pessoas <span>| Atendidas</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-newspaper"></i>
                </div>
                <div class="ps-3">
                  <h6>0</h6>
                </div>
              </div>

            </div>
          </div>

        </div><!-- End Customers Card -->

  

        <!-- Recent Sales -->
        <div class="col-12">
          <div class="card recent-sales overflow-auto">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filtro</h6>
                </li>

                <li><a class="dropdown-item" href="#">Hoje</a></li>
                <li><a class="dropdown-item" href="#">Este mês</a></li>
                <li><a class="dropdown-item" href="#">Este ano</a></li>
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Lista de doadores</h5>

              <table class="table table-borderless datatable" id="minhaTabela">
              <!-- <table class="table table-borderless datatable"> -->
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Local de doação</th>
                    <th scope="col">Data solicitação</th>
                    <th scope="col">Data doação</th>
                    <th scope="col">Status</th>
                    <th scope="col">
                      Ações 
                      <i class="bi bi-question-circle"  title="Se você doou sangue clique no botão Doei. Se não foi possível doar, clique em Rejeitar." ></i>
                    </th>


                  </tr>
                </thead>
                <tbody>


                  <?php foreach ($doacoes as $indice => $doacao): ?>
                      <tr>
                        
                        <th scope="row">
                          <?= $doacao['id_doacao'] ?>
                        </th>
                        
                        <td>

                          <span id="local_doacao" title="<?= $doacao['endereco_local'].' - '.$doacao['municipio'] ?>">
                              <?= $doacao['nome_local'] ?>
                          </span>

                        </td>
                        
                        <td>
                          <span class="text-primary">
                            <?= date('d/m/Y', strtotime($doacao['data_solicitacao'])); ?>
                          </span>
                        </td>

                        <td>
                          <span class="text-primary text-center">
                            <?php if($doacao['data_doacao'] == null): ?>
                              -
                            <?php else: ?>
                              <?= date('d/m/Y', strtotime($doacao['data_doacao'])); ?>
                            <?php endif ?>
                          </span>
                        </td>                        

                        <?php if($doacao['status'] == 1): ?>
                          <td>
                            <span class="badge bg-warning">Pendente</span>
                          </td>

                        <?php elseif ($doacao['status'] == 2): ?>
                          <td>
                            <span class="badge bg-success">Doado</span>
                          </td>

                          <?php elseif ($doacao['status'] == 3): ?>
                            <td>
                              <span class="badge bg-danger">Rejeitado</span>
                            </td>                  

                        <?php endif ?>

                            <td>
                              
                                <?php if($doacao['status'] == 1): ?>
                                  <span class="badge bg-success">
                                    <a href="<?= '/doacao_confirmar/'.urlencode( base64_encode($doacao['id_doacao'].';'.rand(1,100000)) );?>">Doei</a>
                                  </span>
                                <?php else: ?>
                                  <span class="badge bg-secondary">
                                    Doei
                                  </span>
                                <?php endif ?>
                                
                              
<!--
                              <span class="badge bg-danger">
                                <a href="<?= '/doacao_rejeitar/'.urlencode( base64_encode($doacao['id_doacao']) );?>">Rejeitar</a>
                              </span>
                                -->                              
                              <?php if($doacao['status'] == 1): ?>
                                  <span class="badge bg-danger">
                                  <a href="<?= '/doacao_rejeitar/'.urlencode( base64_encode($doacao['id_doacao'].';'.rand(1,100000)) );?>">Rejeitar</a>
                                  </span>
                                <?php else: ?>
                                  <span class="badge bg-secondary">
                                    Rejeitar
                                  </span>
                                <?php endif ?>      
                                
                              


                            </td>     

                      </tr>                   
                  <?php endforeach; ?>                
                   

                </tbody>
              </table>

            </div>

          </div>
        </div><!-- End Recent Sales -->


      </div>
    </div><!-- End Left side columns -->


  </div>
</section>

</main><!-- End #main -->



