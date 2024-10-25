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
      <p>
        <?= session()->getFlashdata('msgSolicitaDoacao') ?>
      </p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>
  <?php endif; ?>


  <div class="pagetitle">
    <h1>Inserir doação</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home">Home</a></li>
        <li class="breadcrumb-item active">Doações</li>
        <li class="breadcrumb-item active">Inserir doação</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <!-- Mostrando o caminho do arquivo apenas quando em desenvolvimento -->
  <?php if ($environment == 'development'): ?>
    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">Debug: View/Usuario/Doacao/InserirDoacaoView.php Controller: DoacaoController
          </li>
        </ol>
      </nav>
    </div>
  <?php endif; ?>
  <!-- Fim do debug -->


  <section class="section profile">
    <div class="row">

      <div class="col-xl-12">

        <div class="card">
          <div class="card-body pt-2">
            <!-- Form solicitação -->
            <form action="inserirdoacaopost" class="needs-validation" method="post">
              <p class="small fst-italic">Área destinada a inserir uma doação manualmente.</p>
              <div class="row">
                <div class="col-sm-6 mb-2">
                  <label for="cpf" class="form-label">CPF do receptor</label>
                  <input name="cpfReceptor" type="text" class="form-control" id="cpfReceptor"
                    pattern="\d{3}\.?\d{3}\.?\d{3}-\d{2}" placeholder="000.000.000-00" maxlength="14"
                    value="111.111.111-11" required>
                </div>
                <div class="col mb-2">
                  <label for="nomeReceptor" class="form-label">Nome do receptor</label>
                  <input name="nomeReceptor" type="text" class="form-control" id="nomeReceptor"
                    value="<?= $nomeAleatorio ?>" required>
                </div>
              </div>
              <div class="row mb-2">

                <div class="col-sm-6">
                  <label for="tipoSanguineo" class="form-label">Tipo Sanguíneo</label>
                  <select name="tipoSangue" class="form-select" id="tipoSangue" required>
                    <option value="">Selecione o tipo sanguíneo</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="AB">AB</option>
                    <option value="O">O</option>
                  </select>
                </div>

                <div class="col">
                  <label for="fatorRh" class="form-label">Fator Rh:</label>
                  <select name="fatorRh" class="form-select" id="fatorRh" required>
                    <option value="">Selecione o fator Rh</option>
                    <option value="+">+ (positivo)</option>
                    <option value="-">- (negativo)</option>
                  </select>
                </div>

              </div>

              <div class="row mb-3">
                <div class="col">
                  <label for="dataDoacao" class="form-label">Data que doou</label>
                  <input name="dataDoacao" type="date" class="form-control" id="dataDoacao" value="" required>
                </div>
              </div>

              <div class="row">
                <div class="col text-end">
                  <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
              </div>
          </div>

          </form><!-- End Form solicitacoa -->
        </div>
      </div>
    </div>
    </div>
  </section>
</main>