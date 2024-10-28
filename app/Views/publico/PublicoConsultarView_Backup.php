<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Sistema de controle da Biblioteca</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/assets/img/favicon.png" rel="icon">
  <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Vendor CSS Files -->
  <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="/assets/css/publico.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

  <style>
    .alert {
      z-index: 9999;
      position: absolute;
      top: 2%;
      left: 50%;
      transform: translateX(-50%);
      width: 70%;
    }

    .navbar {
      background-color: #3498db;
    }

    .navbar-brand, .nav-link {
      color: white !important;
    }

    .nav-link:hover {
      color: #2980b9 !important;
    }
  </style>
</head>

<body>

<!-- Navbar Header -->
<header>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="/home">Sistema de Controle da Biblioteca</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">

          <li class="nav-item">
            <a class="nav-link" href="/administrar">Gerenciar</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

<main id="main" class="main container-custom">
  <?php if ($environment == 'development'): ?>
      <div class="debug-text">
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item active">
              <i>Debug:</i> View/Publico/PublicoConsultarView.php 
              <i>Controller:</i> LivroController
            </li>
          </ol>
        </nav>
      </div>
  <?php endif; ?>

  <div class="pagetitle">
    <h1>Consultar Livro</h1>
  </div>

  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-12">
        <div class="card info-card customers-card">
          <div class="card-body">
            <input type="text" id="search" placeholder="Pesquisar livros..." class="form-control mb-3 mt-4">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Tombo</th>
                  <th>Título</th>
                  <th>Autor</th>
                  <th>Gênero</th>
                  <th>Ano</th>
                  <th>Estante</th>
                  <th>Prateleira</th>
                  <th>Disponível</th>                  
                </tr>
              </thead>
              <tbody id="book-table"></tbody>
            </table>

            <nav>
              <ul class="pagination justify-content-center" id="pagination"></ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<script>
  const dados = <?= json_encode($dados) ?>;
  const rowsPerPage = 5;
  let currentPage = 1;
  let filteredData = [...dados];

  function renderTable(page = 1) {
    const tbody = document.getElementById('book-table');
    tbody.innerHTML = '';

    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    const pageData = filteredData.slice(start, end);

    pageData.forEach(livro => {
      const disponibilidade = (livro.quantidade_disponivel == 0) ? "Indisponível" : "Disponível";

      const row = `<tr>
        <td>${livro.id_livro_formatado}</td>
        <td>${livro.titulo}</td>
        <td>${livro.autor}</td>
        <td>${livro.genero}</td>
        <td>${livro.ano_publicacao}</td>
        <td class="text-center">${livro.estante}</td>
        <td class="text-center">${livro.prateleira}</td>
        <td class="text-center">${disponibilidade}</td>
      </tr>`;
      tbody.innerHTML += row;
    });

    renderPagination();
  }

  function renderPagination() {
    const totalPages = Math.max(Math.ceil(filteredData.length / rowsPerPage), 1);
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = '';

    for (let i = 1; i <= totalPages; i++) {
      const pageItem = document.createElement('li');
      pageItem.className = 'page-item' + (i === currentPage ? ' active' : '');
      pageItem.innerHTML = `<a class="page-link" href="#">${i}</a>`;
      pageItem.addEventListener('click', (e) => {
        e.preventDefault();
        currentPage = i;
        renderTable(currentPage);
      });
      pagination.appendChild(pageItem);
    }
  }

  document.getElementById('search').addEventListener('input', function () {
    const searchTerm = this.value.toLowerCase();
    filteredData = dados.filter(livro =>
      Object.values(livro).some(value =>
        value.toString().toLowerCase().includes(searchTerm)
      )
    );
    currentPage = 1;
    renderTable(currentPage);
  });

  renderTable();
</script>

<footer id="footer" class="footer">
  <div class="copyright">
    &copy; Copyright <strong><span>2024</span></strong>. Todos os direitos reservados
  </div>
  <div class="credits">
    Projeto Integrador - Univesp 2024
  </div>
</footer>

<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
<script>new window.VLibras.Widget('https://vlibras.gov.br/app');</script>
<script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
