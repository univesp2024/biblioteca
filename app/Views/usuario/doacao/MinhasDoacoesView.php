<main id="main" class="main">

<!-- Meu debug -->
<?php  

#var_dump($doacoes); 
#die();
# echo count($doacoes[0]);

?>


<div class="pagetitle">
  <h1>Minhas doações</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="home">Home</a></li>
      <li class="breadcrumb-item active">Doações</li>
      <li class="breadcrumb-item active">Minhas doações</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<!-- Mostrando o caminho do arquivo apenas quando em desenvolvimento -->
<?php if ($environment== 'development'): ?>
<div class="pagetitle">
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item active"><i>Debug:</i> View/Usuario/doacao/MinhasDoacoesView.php   <i>Controller:</i> DoacaoController</li>
    </ol>
  </nav>
</div>
<?php endif; ?>
<!-- Fim do debug -->

<section class="section dashboard">


<?php // var_dump($doacoes) ?>

  <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-12">
      <div class="row">

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
              <h5 class="card-title">Pedidos de doações</h5>

              <table class="table table-borderless datatable" id="minhaTabela">
              <!-- <table class="table table-borderless datatable"> -->
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Data solicitação</th>
                    <th scope="col">Nome do receptor</th>
                    <th scope="col">Local de doação</th>                   
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
                          <span class="text-primary">
                            <?= date('d/m/Y', strtotime($doacao['data_solicitacao'])); ?>
                          </span>
                        </td>


                        <td>
                          <span id="nome_receptor">
                              <?= $doacao['nome_receptor'] ?>
                          </span>
                        </td>                        

                        <td>
                          <span id="local_doacao" title="<?= $doacao['endereco_local'].' - '.$doacao['municipio'] ?>">
                              <?= $doacao['nome_local'] ?>
                          </span>
                        </td>
                        


                        <td>
                          
                            <?php if($doacao['status'] == 3): ?>
                              <span class="text-danger text-center">
                                Rejeitado
                              </span>
                            <?php elseif($doacao['data_doacao'] == null): ?>
                                -----
                            <?php else: ?>
                              <?= date('d/m/Y', strtotime($doacao['data_doacao'])); ?>

                            <?php endif ?>
                          
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


<!--
                  <tr>
                    <th scope="row">#2</th>
                    <td>item2</td>
                    <td><span class="text-primary">item a2</span></td>
                    <td>item b2</td>
                    <td><span class="badge bg-warning">Pendente</span></td>
                  </tr>

                  <tr>
                    <th scope="row">#3</th>
                    <td>item3</td>
                    <td><a href="#" class="text-primar">item a3</a></td>
                    <td>item b3</td>
                    <td><span class="badge bg-danger">Rejeitado</span></td>
                  </tr>        
                  -->                            

                </tbody>
              </table>

            </div>

          </div>
        </div><!-- End Recent  -->


      </div>
    </div><!-- End Left side columns -->


  </div>


</section>

</main><!-- End #main -->



