<main id="main" class="main">

<?php if ($environment == 'development'): ?>
    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">
            <i>Debug:</i> View/Livro/ConsultarView.php 
            <i>Controller:</i> LivroController
          </li>
        </ol>
      </nav>
    </div>
  <?php endif; ?>


  <div class="pagetitle">
    <h1>Consultar livro</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('home')?>">Início</a></li>
        <li class="breadcrumb-item">Consultar livro</li>
      </ol>
    </nav>
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
                  <th>Disponível</th>
                  <th>Estante</th>
                  <th>Prateleira</th>
                </tr>
              </thead>
              <tbody id="book-table"></tbody>
            </table>

            <!-- Controles de Paginação -->
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
  const dados = <?= json_encode($dados) ?>; // Converte os dados PHP para JSON em JS
  const rowsPerPage = 10; // Quantidade de livros por página
  let currentPage = 1;
  let filteredData = [...dados]; // Inicialmente contém todos os dados

  // Função para renderizar uma página específica
  function renderTable(page = 1) {
    const tbody = document.getElementById('book-table');
    tbody.innerHTML = ''; // Limpa o conteúdo da tabela

    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    const pageData = filteredData.slice(start, end); // Dados da página atual

    pageData.forEach(livro => {
      const dispo = (livro.quantidade_disponivel == 0)? 'Não': 'Sim';
      const row = `<tr>
        <td>${livro.id_livro_formatado}</td>
        <td>${livro.titulo}</td>
        <td>${livro.autor}</td>
        <td>${livro.genero}</td>
        <td>${livro.ano_publicacao}</td>
        <td class="text-center">${dispo}</td>
        <td class="text-center">${livro.estante_formatado}</td>
        <td class="text-center">${livro.prateleira_formatado}</td>
      </tr>`;
      tbody.innerHTML += row;
    });

    renderPagination();
  }

  // Função para renderizar a paginação
  function renderPagination() {
    const totalPages = Math.max(Math.ceil(filteredData.length / rowsPerPage), 1); // No mínimo 1 página
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = ''; // Limpa a paginação anterior

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

  // Função de pesquisa
  document.getElementById('search').addEventListener('input', function () {
    const searchTerm = this.value.toLowerCase();
    filteredData = dados.filter(livro =>
      Object.values(livro).some(value =>
        value.toString().toLowerCase().includes(searchTerm)
      )
    );

    currentPage = 1; // Reseta para a primeira página ao pesquisar
    renderTable(currentPage);
  });

  // Inicializa a tabela
  renderTable();
</script>