<main id="main" class="main">

<?php if ($environment == 'development'): ?>
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <i>Debug:</i> View/Aluno/CadastroAlunoView.php 
                    <i>Controller:</i> AlunoController
                </li>
            </ol>
        </nav>
    </div>
<?php endif; ?>




<div class="pagetitle">
    <h1>Cadastrar Aluno</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('home')?>">Início</a></li>
            <li class="breadcrumb-item">Cadastrar Aluno</li>
        </ol>
    </nav>
</div>


<section class="section dashboard">
    <div class="row">
      <div class="col-lg-12">
        <div class="card info-card customers-card">
        <div class="container">
    <h4 class="text-muted mt-3">Insira as informações do aluno:</h4>
    <form id="cadastroForm" action="cadastrar_aluno_post" method="post" class="needs-validation" novalidate>
        <div class="row mb-1">
            <div class="col">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" name="nome" class="form-control" id="nome" 
                    placeholder="Digite o nome do aluno" required>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-4">
                <label for="email" class="form-label">E-mail:</label>
                <input type="text" name="email" class="form-control" 
                    placeholder="Digite o e-mail" required>
            </div>
            <div class="col-md-4">
                <label for="telefone" class="form-label">Telefone:</label>
                <input type="text" name="telefone" class="form-control" 
                    placeholder="Digite o telefone" required>
            </div>
            <div class="col-md-4">
                <label for="ano_publicacao" class="form-label">Data nascimento:</label>
                <input type="date" name="data_nascimento" class="form-control" 
                    placeholder="Digite a data de nascimento" required>
            </div>
        </div>
        <div class="row mt-2">
        </div>
        <div class="row">
            <div class="col text-end mt-4">
                <input type="submit" class="btn btn-success" value="Cadastrar">
            </div>
        </div>
    </form>
</div>            
        </div>
      </div>
    </div>
</section>



<!-- Modal de Confirmação -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Atenção!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                Anote o tombo do livro:<br>
                <h1>11</h1>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>-->
                <button type="button" id="confirmButton" class="btn btn-success">Ok</button>
            </div>
        </div>
    </div>
</div>

<script>

    document.getElementById('confirmButton').addEventListener('click', function () {
        // Envia o formulário após a confirmação
        document.getElementById('cadastroForm').submit();
    });



</script>

<!-- JS Bootstrap (opcional, se não estiver carregado na página) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Plugin VLibras -->
<div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
        <div class="vw-plugin-top-wrapper"></div>
    </div>
</div>
<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
<script>
    new window.VLibras.Widget('https://vlibras.gov.br/app');
</script>
</main>