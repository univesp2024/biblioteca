

<main id="main" class="main">




    <div class="pagetitle">
        <h1>Minhas perfil</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home">Home</a></li>
                <li class="breadcrumb-item active">Meu Perfil</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


<!-- Mostrando o caminho do arquivo apenas quando em desenvolvimento -->
<?php if ($environment== 'development'): ?>
<div class="pagetitle">
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Debug: View/Usuario/MeuPerfilView.php  Controller: UsuarioController</li>
    </ol>
  </nav>
</div>
<?php endif; ?>
<!-- Fim do debug -->


    <div class="container">
        <h4 class="text-muted">Suas informações:</h4>
        <form action="update_usuario" class="needs-validation" method="post" novalidate>
            <div class="row mb-1">
                <div class="col-md-7">
                    <label for="nome_completo" class="form-label">Nome:</label>
                    <input type="text" name="nome_completo" class="form-control" placeholder="Digite o seu nome"
                        value="<?= $dadosUsuario['nome_completo'] ?>" required>
                </div>
                <div class="col ">
                    <label for="cpf" class="form-label">CPF:</label>
                    <input type="text" name="cpf" class="form-control" id="cpf" value="<?= substr($dadosUsuario['cpf'], 0, 3) . '.' . substr($dadosUsuario['cpf'], 3, 3) . '.' . substr($dadosUsuario['cpf'], 6, 3) . '-' . substr($dadosUsuario['cpf'], 9, 2) ?>
"
                        readonly>
                </div>


            </div>
            <div class="row mb-1">
                <div class="col">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" value="<?= $dadosUsuario['email'] ?>"
                        placeholder="Digite o seu município" required>
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
                        <option value="O" <?= $dadosUsuario['sexo'] == "O" ? 'selected' : '' ?>>Outro</option>
                    </select>
                </div>
                <div class="col">
                    <label for="data_nascimento" class="form-label">Data de nascimento:</label>
                    <input type="date" name="data_nascimento" class="form-control"
                        value="<?= $dadosUsuario['data_nascimento'] ?>" required>
                </div>
                <div class=" col-md-4 col-sm-6">
                    <label for="telefone" class="form-label">Telefone:</label>
                    <input type="tel" name="telefone" class="form-control" pattern="^\([0-9]{2}\) [0-9]{5}-[0-9]{4}$"
                        maxlength="11" value="<?= $dadosUsuario['telefone'] ?>" placeholder="(00) 00000-0000"
                        id="telefone" required>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-4  col-sm-5">
                    <label for="e_doador" class="form-label">Você é doador?</label>
                    <select class="form-select" name="e_doador" required>
                        <option value="S" <?= ($dadosUsuario['e_doador'] == 'S') ? 'selected' : '' ?>>Sim</option>
                        <option value="N" <?= ($dadosUsuario['e_doador'] == 'N') ? 'selected' : '' ?>>Não</option>
                    </select>
                </div>
                <div class="col">
                    <label for="tipo_sanguineo" class="form-label">Tipo sanguineo:</label>
                    <select class="form-select" name="tipo_sanguineo" required>
                        <option value="A" <?= $dadosUsuario['tipo_sanguineo'] == "A" ? 'selected' : '' ?>>A
                        </option>
                        <option value="B" <?= $dadosUsuario['tipo_sanguineo'] == "B" ? 'selected' : '' ?>>B
                        </option>
                        <option value="AB" <?= $dadosUsuario['tipo_sanguineo'] == "AB" ? 'selected' : '' ?>>AB
                        </option>
                        <option value="O" <?= $dadosUsuario['tipo_sanguineo'] == "O" ? 'selected' : '' ?>>O
                        </option>
                    </select>
                </div>
                <div class="col">
                    <label for="fator_rh" class="form-label">Fator RH:</label>
                    <select class="form-select" name="fator_rh" required>
                        <option value="-" <?= $dadosUsuario['fator_rh'] == "-" ? 'selected' : '' ?>>Negativo (-)
                        </option>
                        <option value="+" <?= $dadosUsuario['fator_rh'] == "+" ? 'selected' : '' ?>>Positivo (+)
                        </option>
                    </select>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-7">
                    <label for="endereco" class="form-label">Endereço:</label>
                    <input type="text" name="endereco" class="form-control" placeholder="Digite o seu endereço"
                        value="<?= $dadosUsuario['endereco'] ?>" required>
                </div>
                <div class="col">
                    <label for="municipio" class="form-label">Município:</label>
                    <input type="text" name="municipio" class="form-control" placeholder="Digite o seu município"
                        value="<?= $dadosUsuario['municipio'] ?>" required>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col text-end">
                    <input type="submit" class="btn btn-success" value="Salvar">
                </div>
            </div>
        </form>
    </div>
</main>