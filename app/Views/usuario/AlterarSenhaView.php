<main id="main" class="main">

    <div class="pagetitle">
        <h1>Alterar Senha</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('home')?>">Home</a></li>
                <li class="breadcrumb-item active">Alterar Senha</li>
            </ol>
        </nav>
    </div>

    <!-- Mostrando o caminho do arquivo apenas quando em desenvolvimento -->
    <?php if ($environment == 'development'): ?>
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Debug: View/Usuario/AlterarSenhaView.php Controller: UsuarioController
                    </li>
                </ol>
            </nav>
        </div>
    <?php endif; ?>
    <!-- Fim do debug -->    


    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="card info-card customers-card">

                <div class="container">
        <h4 class="text-muted mt-3">Mudar Senha:</h4>
        <form action="update_senha" class="needs-validation" method="post" id="formulario" novalidate>
            <div class="row mb-3">
                <div class="col">
                    <label for="velhaSenha" class="form-label">Digite a sua senha atual:</label>
                    <input type="password" name="velhaSenha" class="form-control" placeholder=""
                        minlength="8" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="novaSenha" class="form-label">Digite a sua nova senha:</label>
                    <input type="password" name="novaSenha" class="form-control" placeholder=""
                        minlength="8" required id="novaSenha">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="confirmarSenha" class="form-label">Confirme a sua nova senha:</label>
                    <input type="password" name="confirmarSenha" class="form-control"
                        placeholder="" minlength="8" required id="confirmarSenha">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col text-end">
                    <input type="submit" class="btn btn-success" id="submitButton" value="Salvar">
                </div>
            </div>
        </form>
    </div>

                </div>
            </div>
        </div>
    </section>









    <script>
        const novaSenha = document.getElementById("novaSenha");
        const confirmarSenha = document.getElementById("confirmarSenha");
        const submitButton = document.getElementById('submitButton');

        document.getElementById('formulario').addEventListener('input', () => {
            let eValido = novaSenha.value != "" && novaSenha.value === confirmarSenha.value
                && confirmarSenha.value != "";

            submitButton.disabled = !eValido;

            if (!eValido) {
                novaSenha.classList.add('is-invalid');
                confirmarSenha.classList.add('is-invalid');
                novaSenha.classList.remove('is-valid');
                confirmarSenha.classList.remove('is-valid');
            } else {
                novaSenha.classList.add('is-valid');
                confirmarSenha.classList.add('is-valid');
                novaSenha.classList.remove('is-invalid');
                confirmarSenha.classList.remove('is-invalid');
            }
        });


    </script>

</main>