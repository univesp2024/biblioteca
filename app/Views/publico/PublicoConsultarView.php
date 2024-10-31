<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Sistema de Controle da Biblioteca</title>
  <link href="<?= base_url('/assets/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
  <link href="<?= base_url('/assets/vendor/bootstrap-icons/bootstrap-icons.css')?>" rel="stylesheet">
  <link href="<?= base_url('/assets/vendor/simple-datatables/style.css')?>" rel="stylesheet">
  <link href="<?= base_url('/assets/css/publico.css')?>" rel="stylesheet">

  <style>
    .alert {
      z-index: 9999;
      position: absolute;
      top: 2%;
      left: 50%;
      transform: translateX(-50%);
      width: 70%;
    }
  </style>
</head>

<body>

<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?= base_url('home')?>">Sistema de Controle da Biblioteca</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('administrar')?>">Área Restrita</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

<main id="main" class="main container-custom">
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
  const rowsPerPage = 8;
  let currentPage = 1;
  let filteredData = [...dados];

  function renderTable(page = 1) {
    const tbody = document.getElementById('book-table');
    tbody.innerHTML = '';

    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    const pageData = filteredData.slice(start, end);

    pageData.forEach(livro => {
      const disponibilidade = livro.quantidade_disponivel > 0 ? "Disponível" : "Indisponível";
      const row = `<tr>
        <td>${livro.id_livro_formatado}</td>
        <td>${livro.titulo}</td>
        <td>${livro.autor}</td>
        <td>${livro.genero}</td>
        <td>${livro.ano_publicacao}</td>
        <td>${livro.estante_formatado}</td>
        <td>${livro.prateleira_formatado}</td>
        <td>${disponibilidade}</td>
      </tr>`;
      tbody.innerHTML += row;
    });

    renderPagination();
  }

  function renderPagination() {
    const totalPages = Math.max(Math.ceil(filteredData.length / rowsPerPage), 1);
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = '';

    const prevPage = document.createElement('li');
    prevPage.className = 'page-item' + (currentPage === 1 ? ' disabled' : '');
    prevPage.innerHTML = `<a class="page-link" href="#">Anterior</a>`;
    prevPage.addEventListener('click', (e) => {
      e.preventDefault();
      if (currentPage > 1) {
        currentPage--;
        renderTable(currentPage);
      }
    });
    pagination.appendChild(prevPage);

    if (totalPages <= 5) {
      for (let i = 1; i <= totalPages; i++) createPageItem(i);
    } else {
      createPageItem(1);
      pagination.appendChild(createDots());
    }

    const nextPage = document.createElement('li');
    nextPage.className = 'page-item' + (currentPage === totalPages ? ' disabled' : '');
    nextPage.innerHTML = `<a class="page-link" href="#">Próximo</a>`;
    nextPage.addEventListener('click', (e) => {
      e.preventDefault();
      if (currentPage < totalPages) {
        currentPage++;
        renderTable(currentPage);
      }
    });
    pagination.appendChild(nextPage);
  }

  function createPageItem(page) {
    const pageItem = document.createElement('li');
    pageItem.className = 'page-item' + (page === currentPage ? ' active' : '');
    pageItem.innerHTML = `<a class="page-link" href="#">${page}</a>`;
    pageItem.addEventListener('click', (e) => {
      e.preventDefault();
      currentPage = page;
      renderTable(currentPage);
    });
    return pageItem;
  }

  function createDots() {
    const dots = document.createElement('li');
    dots.className = 'page-item disabled';
    dots.innerHTML = `<span class="page-link"> ${currentPage} </span>`;
    return dots;
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

<footer class="footer">
  <div class="copyright">
    &copy; 2024. Todos os direitos reservados.<br>
    Projeto Integrador II
  </div>
</footer>

<script src="<?= base_url('/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>

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
