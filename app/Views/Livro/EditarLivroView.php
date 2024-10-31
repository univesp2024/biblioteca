<main id="main" class="main">

<?php if ($environment == 'development'): ?>
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">
                    <i>Debug:</i> View/Livro/EditarLivroView.php 
                    <i>Controller:</i> LivroController
                </li>
            </ol>
        </nav>
    </div>
<?php endif; ?>

<?php 
//var_dump($dados); 
?>

<div class="pagetitle">
    <h1>Editar Livro</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('home')?>">Início</a></li>
            <li class="breadcrumb-item">Editar Livro</li>
        </ol>
    </nav>
</div>

<div class="container">
    <h4 class="text-muted">Insira as informações do livro:</h4>

    <form id="cadastroForm" action="<?= base_url('editar_livro_post'); ?>" method="post" class="needs-validation" novalidate>
        <div class="row mb-1">
            <div class="col-md-2">
                <label for="tombo" class="form-label">Tombo:</label>
                <input type="text" name="tombo" class="form-control" id="tombo" 
                     value="<?= $dados->id_livro_formatado; ?>" readonly>
                <input type="hidden" name="id_livro" class="form-control" id="id_livro" 
                     value="<?= $dados->id_livro; ?>">
             
            </div>            
            <div class="col-md-10">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" name="titulo" class="form-control" id="titulo" 
                    placeholder="Digite o título do livro" value="<?= $dados->titulo; ?>" required>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <label for="autor" class="form-label">Autor:</label>
                <input type="text" name="autor" class="form-control" 
                    placeholder="Digite o autor"  value="<?= $dados->autor; ?>" required>
            </div>

            <div class="col-md-6">
                <label for="genero" class="form-label">Gênero:</label>
                <input type="text" name="genero" class="form-control" 
                    placeholder="Digite o gênero"  value="<?= $dados->genero; ?>" required>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-4">
                <label for="ano_publicacao" class="form-label">Ano Publicação:</label>
                <input type="number" name="ano_publicacao" class="form-control" 
                    placeholder="Digite o ano da publicação"  value="<?= $dados->ano_publicacao; ?>" required>
            </div>

            <div class="col-md-4">
                <label for="estante" class="form-label">Estante:</label>
                <input type="text" name="estante" class="form-control" 
                    placeholder="Qual estante o livro ficará?"   value="<?= $dados->estante; ?>" required>
            </div>

            <div class="col-md-4">
                <label for="prateleira" class="form-label">Prateleira:</label>
                <input type="text" name="prateleira" class="form-control" 
                    placeholder="Qual a prateleira?"   value="<?= $dados->prateleira; ?>" required>
            </div>
        </div>

        <div class="row">
            <div class="col text-end mt-4">
                <input type="submit" class="btn btn-success" value="Salvar">
            </div>
        </div>
    </form>
</div>

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
                <h1>1</h1>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>-->
                <button type="button" id="confirmButton" class="btn btn-success">Ok</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('cadastroForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Impede o envio imediato do formulário

        // Verifica se o formulário é válido
        if (this.checkValidity()) {
            //const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
            //modal.show(); // Exibe o modal se todos os campos estiverem preenchidos
            document.getElementById('cadastroForm').submit();
        } else {
            // Se o formulário não for válido, exibe as mensagens de erro
            this.classList.add('was-validated');
        }
    });

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
