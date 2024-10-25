<style>
.alert {
    z-index: 9999;
    position: absolute;
    top: 30%;
    left: 50%;
    transform: translateX(-50%);
    width: 50%;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);
}    
</style>    

<main id="main" class="main">

<!-- Meu debug -->
<?php 
use App\Models\DoacaoModel; 

#var_dump($solicitacoes); 
#die();
# echo count($doacoes[0]);

?>

<?php if (session()->getFlashdata('msgSolicitaDoacao')): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
        <h4 class="alert-heading">Atenção!</h4>
        <p><?= session()->getFlashdata('msgSolicitaDoacao') ?></p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

  </div>
<?php endif; ?>

<?php if (session()->getFlashdata('msgSolicitaDoacaoErro')): ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h4 class="alert-heading">Atenção!</h4>
        <p><?= session()->getFlashdata('msgSolicitaDoacaoErro') ?></p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

  </div>
<?php endif; ?>


<div class="pagetitle">
  <h1>Minhas Solicitações</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="home">Home</a></li>
      <li class="breadcrumb-item active">Pedido de doação</li>
      <li class="breadcrumb-item active">Minhas Solicitações</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<!-- Mostrando o caminho do arquivo apenas quando em desenvolvimento -->
<?php if ($environment== 'development'): ?>
<div class="pagetitle">
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Debug: View/Usuario/solicitacao/ListaSolicitacaoView.php</li>
    </ol>
  </nav>
</div>
<?php endif; ?>
<!-- Fim do debug -->






<section class="section profile">
      <div class="row">

        <div class="col-xl-12">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
<!--
              <ul class="nav nav-tabs" id="myTab" role="tablist">

                <li class="nav-item" role="presentation">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#doacao-listagem" aria-selected="true" role="tab">Minhas solicitações</button>
                </li>

                <li class="nav-item" role="presentation">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#doacao-solicitacao" aria-selected="false" role="tab" tabindex="-1">Solicitar doação</button>
                </li>
     

              </ul>
-->
              <div class="tab-content pt-2">

                  <div class="tab-pane fade profile-overview active show" id="doacao-listagem" role="tabpanel">
                    
                  
                  <!-- <h5 class="card-title">About</h5>
                    <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p> -->

                    <h5 class="card-title">Listagem dos meus pedidos de doação</h5>

                    <table class="table table-borderless datatable" id="minhaTabela">
                <!-- <table class="table table-borderless datatable"> -->
                  <thead>
                    <tr>
                      <th scope="col">Id</th>
                      <th scope="col">Nome receptor</th>
                      <th scope="col">Data solicitação</th>
                      <th scope="col">Tipo Sangue</th>
                      <th scope="col">Local de doação</th>
                      <th scope="col">Situação do pedido</th>


                    </tr>
                  </thead>
                  <tbody>


                    <?php foreach ($solicitacoes as $indice => $solicitacao): ?>
                        <tr>
                          
                          <th scope="row">
                            <?= $solicitacao['id_solicitacao'] ?>
                          </th>
                          
                          <td>
                            <span id="nome_receptor">
                                <?= $solicitacao['nome_receptor'] ?>
                            </span>
                          </td>


                          <td>
                            <span class="text-primary">
                              <?= date('d/m/Y', strtotime($solicitacao['data_solicitacao'])); ?>
                            </span>
                          </td>

                          <td>
                            <span id="nome_receptor">
                                <?= $solicitacao['tipo_sanguineo'].$solicitacao['fator_rh'] ?>
                            </span>
                          </td>

                          <td>
                            <span class="text-primary">
                              <?= $solicitacao['nome_local']; ?>
                            </span>
                          </td>

                          <?php 

                             $totalDoadores = Constants::Qtde_doadores_a_selecionar;


                             $modelDoacao = new DoacaoModel();
                             $contaStatus = $modelDoacao->contaStatus($solicitacao['id_solicitacao']);

                             /*
                             var_dump( $contaStatus );
                             echo "<br>";
                             echo "<br>";
                             */
                             

                             $valores = ['1' => 0, '2' => 0, '3' => 0];
                             foreach ($contaStatus as $conta){
                              //var_dump($conta);
                              if ($conta['status'] == 1){
                                $valores[1] = $conta['total'];
                              } else if ($conta['status'] == 2){
                                $valores[2] = $conta['total'];
                              } else if ($conta['status'] == 3){
                                $valores[3] = $conta['total'];
                              }
                             }

                          ?>

                          <?php if($valores[1]+$valores[2]+$valores[3]==0): ?>
                          <td>
                              <span class="badge bg-danger">Não houve doadores suficientes!</span>
                          </td>
                          <?php else: ?>
                          <td>
                              <span class="badge bg-warning">Pendente</span>
                              <span class="badge bg-warning"><?= $valores[1] ?></span>
                              &nbsp;
                              <span class="badge bg-success">Doado</span>
                              <span class="badge bg-success"><?= $valores[2] ?></span>
                              &nbsp;
                              <span class="badge bg-danger">Rejeitado</span>
                              <span class="badge bg-danger"> <?= $valores[3] ?></span>
                          </td>
                          <?php endif; ?>                            

    

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

                  <div class="tab-pane fade profile-edit pt-3" id="doacao-solicitacao" role="tabpanel">

                    <!-- Form solicitação -->
                    <form action="solicitarDoacao" class="needs-validation" method="post">

                    <p class="small fst-italic">Área destinada a solicitar doação.</p>

                    <div class="row mb-3">
                        <label for="cpfReceptor" class="col-md-4 col-lg-3 col-form-label">CPF do receptor</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="cpfReceptor" type="text" class="form-control" id="cpfReceptor" pattern="\d{3}\.?\d{3}\.?\d{3}-\d{2}"                         placeholder="000.000.000-00" maxlength="14" value="111.111.111-11" required>
                        </div>
                      </div>


                      <div class="row mb-3">
                        <label for="nomeReceptor" class="col-md-4 col-lg-3 col-form-label">Nome do receptor</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="nomeReceptor" type="text" class="form-control" id="company" value="<?= $nomeAleatorio ?>" required>
                        </div>
                      </div>

                      <div class="row mb-3">
                          <label for="tipoSangue" class="col-md-4 col-lg-3 col-form-label">Tipo Sanguineo</label>
                          <div class="col-md-8 col-lg-9">
                              <select name="tipoSangue" class="form-select" id="tipoSangue" required>
                                  <option value="">Selecione o tipo sanguíneo</option>
                                  <option value="A">A</option>
                                  <option value="B">B</option>
                                  <option value="AB">AB</option>
                                  <option value="O">O</option>
                              </select>
                          </div>
                      </div>

                      <div class="row mb-3">
                          <label for="fatorRh" class="col-md-4 col-lg-3 col-form-label">Fator Rh</label>
                          <div class="col-md-8 col-lg-9">
                              <select name="fatorRh" class="form-select" id="fatorRh" required>
                                  <option value="">Selecione o fator Rh</option>
                                  <option value="+">+ (positivo)</option>
                                  <option value="-">- (negativo)</option>
                              </select>
                          </div>
                      </div>                      


              


                      
  
                      <div class="row mb-3">
                          <label for="localDoacao" class="col-md-4 col-lg-3 col-form-label">localDoacao</label>
                          <div class="col-md-8 col-lg-9">
                              <select name="localDoacao" class="form-select" id="localDoacao" required>
                                  <option value="">Selecione o local de doação</option>
                                  <option value="1">Hemocentro de Marília</option>
                                  <option value="2">Hemocentro de Jaú</option>

                              </select>
                          </div>
                      </div>



                      <div class="text-center">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                      </div>
                    </form><!-- End Form solicitacoa -->

                  </div>

              </div>
              <!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
</section>



</main><!-- End #main -->



