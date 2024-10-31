<!doctype html>
<html lang="pt-br">

<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS V5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Estilo customizado -->
    <link rel="stylesheet" href="<?= base_url('/assets.old/css/signin.css')?>">

    <title>Sistema de doação de sangue</title>
</head>

<body>


<!-- Será mostrado somente em desenvolvimento ///////////////////////// -->
<?php if ($environment != 'production'): ?>
	<style>
		table {
			border-collapse: collapse;
			position: fixed;
			left: 10px;
			top: 10px;
			z-index: 9999;
			background-color: #fffff2;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
		}

		th,
		td {
			border: 1px solid black;
			padding-left: 8px;
			padding-right: 8px;
			text-align: center;
		}
	</style>
	<table border=1>
        <tr>
			<th colspan="3">* Será mostrado somente em desenvolvimento</th>
		</tr>
		<tr>
			<th>CPF</th>
			<th>Senha</th>
			<th>Status</th>
		</tr>
		<tr>
			<td>111.111.111-11</td>
			<td>a1234567</td>
			<td>Usuário</td>
		</tr>
                         
	</table>
<?php endif; ?>
<!-- ///////////////////////////////////////////// -->




    <?php if (session()->getFlashdata('msg')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('msg') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <body>
        <div class="container h-100">
            <div class="d-flex justify-content-center h-100">
                <div class="user_card">
                    <div class="d-flex justify-content-center">
                        <div class="brand_logo_container">
                            <img src="<?= base_url('/assets/img/logo.PNG')?>"
                                class="brand_logo" alt="Logo">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center form_container">
                        <form action="autenticar" method="POST" id="formulario">
                            <label for="cpf">Digite o CPF:</label>
                            <div class="input-group mb-3">
                                <input type="text" name="cpf" class="form-control input_cpf" placeholder="CPF"
                                    required id="cpf" maxlength="14" value="<?= isset($_COOKIE['cpf']) ? $_COOKIE['cpf'] : '' ?>">
                            </div>
                            <label for="senha">Digite a senha:</label>
                            <div class="input-group mb-2">
                                <input type="password" name="senha" class="form-control input_pass" id="senha"
                                    placeholder="Senha" value="<?= isset($_COOKIE['senha']) ? $_COOKIE['senha'] : '' ?>">
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="lembrar" class="custom-control-input" name="lembrar"
                                        <?= isset($_COOKIE['cpf']) && isset($_COOKIE['senha']) ? 'checked' : '' ?>>
                                    <label class="custom-control-label" for="lembrar">Lembrar</label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-3 login_container">
                                <input type="submit" name="button" class="btn login_btn" value="Entrar">
                            </div>
                        </form>
                    </div>

                    <!--
                    <div class="mt-4">
                        <div class="d-flex justify-content-center links">
                            Não tem uma conta?&nbsp;<a href="cadastro" class="ml-2">Cadastre-se</a>
                        </div>
                        <div class="d-flex justify-content-center links">
                            <a href="#"><strike>Esqueceu a senha?</strike></a>
                        </div>
                    </div>
                    -->


                </div>
            </div>
        </div>


        <!-- BoostrapJs V5.3 -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
            crossorigin="anonymous"></script>
        <!-- JS -->
        <script src="<?= base_url('/assets/js/login.js')?>"></script>

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

        <script>
            // Function to set cookies
            function setCookie(cname, cvalue, exdays) {
                var d = new Date();
                d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                var expires = "expires=" + d.toUTCString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            }

            // Function to get cookies
            function getCookie(cname) {
                var name = cname + "=";
                var decodedCookie = decodeURIComponent(document.cookie);
                var ca = decodedCookie.split(';');
                for (var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                }
                return "";
            }

            // Check if "Lembrar" checkbox is checked, if yes, save CPF and senha in cookies
            document.getElementById("lembrar").addEventListener("change", function () {
                var cpf = document.getElementById("cpf").value;
                var senha = document.getElementById("senha").value;
                if (this.checked) {
                    setCookie("cpf", cpf, 30); // 30 days expiration
                    setCookie("senha", senha, 30
); // 30 days expiration
                } else {
                    // If "Lembrar" checkbox is unchecked, remove CPF and senha cookies
                    document.cookie = "cpf=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "senha=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                }
            });

            // On page load, check if cookies exist for CPF and senha, if yes, fill the form fields
            window.onload = function () {
                var cpfCookie = getCookie("cpf");
                var senhaCookie = getCookie("senha");
                if (cpfCookie != "" && senhaCookie != "") {
                    document.getElementById("cpf").value = cpfCookie;
                    document.getElementById("senha").value = senhaCookie;
                    document.getElementById("lembrar").checked = true;
                }
            };
        </script>
    </body>

</html>
