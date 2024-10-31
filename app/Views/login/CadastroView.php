<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>

    <!-- Bootstrap CSS V5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- css -->
    <link rel="stylesheet" href="<?= base_url('/assets/css/cadastroUsuario.css')?>">
</head>

<body class="d-flex justify-content-center align-items-center">

    <div class="container">
        <h1>Cadastro de Usuário</h1>
        <h4 class="text-muted">Insira as informações abaixo:</h4>
        <form action="salvar_usuario" class="needs-validation" method="post" novalidate>
            <div class="row mb-1">
                <div class="col-md-7">
                    <label for="nome_completo" class="form-label">Nome:</label>
                    <input type="text" name="nome_completo" class="form-control" placeholder="Digite o seu nome" value="<?= ($environment== 'development')?$nome:'';?>"
                        required>
                </div>
                <div class="col ">
                    <label for="cpf" class="form-label">CPF:</label>
                    <input type="text" name="cpf" class="form-control" id="cpf" pattern="\d{3}\.?\d{3}\.?\d{3}-\d{2}"
                        placeholder="000.000.000-00" maxlength="14" value="<?= ($environment== 'development')?'111.111.111-11':'';?>" required>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-7">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" placeholder="Digite o seu e-mail" value='<?= ($environment== 'development')?$email:'';?>' required>
                </div>
                <div class="col">
                    <label for="senha" class="form-label">senha:</label>
                    <input type="password" name="senha" class="form-control" placeholder="**********" minlength="8" value='<?= ($environment== 'development')?'a1234567':'';?>'
                        required>
                </div>
            </div>

            


            <div class="row mb-1">
                <div class="col">
                    <label for="sexo" class="form-label">Sexo:</label>
                    <select class="form-select" name="sexo" required>
                        <option value="">Selecione</option>
                        <option value="F" <?= ($environment== 'development')? ($sexo=='F')? 'Selected' : '' : '';?>>Feminino</option>
                        <option value="M" <?= ($environment== 'development')? ($sexo=='M')? 'Selected' : '' : '';?>>Masculino</option>
                        <option value="O">Outro</option>
                    </select>
                </div>
                <div class="col">
                    <label for="data_nascimento" class="form-label">Data de nascimento:</label>
                    <input type="date" name="data_nascimento" class="form-control" value='<?= ($environment== 'development')?$dataNascimento:'';?>' required>
                </div>
                <div class="col-md-4 col-sm-6">
                    <label for="telefone" class="form-label">Telefone:</label>
                    <input type="tel" name="telefone" class="form-control" pattern="^\([0-9]{2}\) [0-9]{5}-[0-9]{4}$"
                        maxlength="11" placeholder="(00) 00000-0000" id="telefone" value='<?= ($environment== 'development')?$telefone:'';?>' required>
                </div>
            </div>

     



            <div class="row mb-1">
                <div class="col-md-7">
                    <label for="endereco" class="form-label">Endereço:</label>
                    <input type="text" name="endereco" class="form-control" placeholder="Digite o seu endereço" value='<?= ($environment== 'development')?$endereco:'';?>'
                        required>
                </div>
                <div class="col">
                    <label for="municipio" class="form-label">Município:</label>
                    <input type="text" name="municipio" class="form-control" placeholder="Digite o seu município" value='<?= ($environment== 'development')?'Marília':'';?>'
                        required>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col text-end">
                    <input type="submit" class="btn btn-success" value="Cadastrar">
                    <input type="Reset" class="btn btn-danger" value="Cancelar">
                </div>
            </div>
        </form>
    </div>

    <!-- JS -->
    <script src="<?= base_url('/assets/js/cadastro.js')?>"></script>

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
</body>

</html>