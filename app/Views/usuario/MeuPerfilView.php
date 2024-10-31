<main id="main" class="main">




    <div class="pagetitle">
        <h1>Meu perfil</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('home')?>">Home</a></li>
                <li class="breadcrumb-item active">Meu Perfil</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <!-- Mostrando o caminho do arquivo apenas quando em desenvolvimento -->
    <?php if ($environment == 'development'): ?>
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Debug: View/Usuario/MeuPerfilView.php Controller: UsuarioController
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
                        <h4 class="text-muted mt-3">Suas informações:</h4>
                        <form action="update_usuario" class="needs-validation" method="post" novalidate>
                            <div class="row mb-1">
                                <div class="col-md-7">
                                    <label for="nome_completo" class="form-label">Nome:</label>
                                    <input type="text" name="nome_completo" class="form-control"
                                        placeholder="Digite o seu nome" value="<?= $dadosUsuario['nome_completo'] ?>"
                                        required>
                                </div>
                                <div class="col ">
                                    <label for="cpf" class="form-label">CPF:</label>
                                    <input type="text" name="cpf" class="form-control" id="cpf" value="<?= substr($dadosUsuario['cpf'], 0, 3) . '.' . substr($dadosUsuario['cpf'], 3, 3) . '.' . substr($dadosUsuario['cpf'], 6, 3) . '-' . substr($dadosUsuario['cpf'], 9, 2) ?>" readonly>
                                </div>


                            </div>
                            <div class="row mb-1">
                                <div class="col">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" name="email" class="form-control"
                                        value="<?= $dadosUsuario['email'] ?>" placeholder="Digite o seu município"
                                        required>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col">
                                    <label for="sexo" class="form-label">Sexo:</label>
                                    <select class="form-select" name="sexo" required>
                                        <option value="">Selecione</option>
                                        <option value="F" <?= $dadosUsuario['sexo'] == "F" ? 'selected' : '' ?>>Feminino
                                        </option>
                                        <option value="M" <?= $dadosUsuario['sexo'] == "M" ? 'selected' : '' ?>>Masculino
                                        </option>
                                        <option value="O" <?= $dadosUsuario['sexo'] == "O" ? 'selected' : '' ?>>Outro
                                        </option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="data_nascimento" class="form-label">Data de nascimento:</label>
                                    <input type="date" name="data_nascimento" class="form-control"
                                        value="<?= $dadosUsuario['data_nascimento'] ?>" required>
                                </div>
                                <div class=" col-md-4 col-sm-6">
                                    <label for="telefone" class="form-label">Telefone:</label>
                                    <input type="tel" name="telefone" class="form-control"
                                        pattern="^\([0-9]{2}\) [0-9]{5}-[0-9]{4}$" maxlength="11"
                                        value="<?= $dadosUsuario['telefone'] ?>" placeholder="(00) 00000-0000"
                                        id="telefone" required>
                                </div>
                            </div>


                            <div class="row mb-1">
                                <div class="col-md-7">
                                    <label for="endereco" class="form-label">Endereço:</label>
                                    <input type="text" name="endereco" class="form-control"
                                        placeholder="Digite o seu endereço" value="<?= $dadosUsuario['endereco'] ?>"
                                        required>
                                </div>
                                <div class="col">
                                    <label for="municipio" class="form-label">Município:</label>
                                    <input type="text" name="municipio" class="form-control"
                                        placeholder="Digite o seu município" value="<?= $dadosUsuario['municipio'] ?>"
                                        required>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col text-end">
                                    <input type="submit" class="btn btn-success" value="Salvar">
                                </div>
                            </div>
                        </form>
                    </div>



                </div>
            </div>
        </div>
    </section>






</main>