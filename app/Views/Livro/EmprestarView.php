<main id="main" class="main">

  <div class="pagetitle">
    <h1>Escolha o livro para emprestar</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home">Início</a></li>
        <li class="breadcrumb-item">Emprestar livro</li>
      </ol>
    </nav>
  </div>

  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-12">
        <div class="card info-card customers-card">
          <div class="card-body">
            <h5 class="card-title">Livros <span>| Disponíveis</span></h5>
            <input type="text" id="search" placeholder="Pesquisar livros..." class="form-control mb-3">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Título</th>
                  <th>Autor</th>
                  <th>Gênero</th>
                  <th>Ano</th>
                  <th>Disponível</th>
                  <th>Estante</th>
                  <th>Prateleira</th>
                  <th class="text-center">Ação</th>
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

  // Função para renderizar uma página específica
  function renderTable(page = 1) {
    const tbody = document.getElementById('book-table');
    tbody.innerHTML = ''; // Limpa o conteúdo da tabela

    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    const pageData = dados.slice(start, end); // Dados da página atual

    pageData.forEach(livro => {
      const row = `<tr>
        <td>${livro.id_livro}</td>
        <td>${livro.titulo}</td>
        <td>${livro.autor}</td>
        <td>${livro.genero}</td>
        <td class="text-center">${livro.ano_publicacao}</td>
        <td class="text-center">${livro.quantidade_disponivel}</td>
        <td class="text-center">${livro.estante}</td>
        <td class="text-center">${livro.prateleira}</td>
            <td>
              <a href="finaliza_emprestimo/${livro.id_livro}" class="btn btn-success">Selecionar</a>
            </td>
      </tr>`;
      tbody.innerHTML += row;
    });

    renderPagination();
  }

  // Função para renderizar a paginação
  function renderPagination() {
    const totalPages = Math.ceil(dados.length / rowsPerPage);
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
  document.getElementById('search').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const filteredData = dados.filter(livro =>
      Object.values(livro).some(value =>
        value.toString().toLowerCase().includes(searchTerm)
      )
    );

    renderFilteredTable(filteredData);
  });

  // Renderiza a tabela filtrada
  function renderFilteredTable(filteredData) {
    const tbody = document.getElementById('book-table');
    tbody.innerHTML = ''; // Limpa a tabela

    const totalPages = Math.ceil(filteredData.length / rowsPerPage);
    const start = (currentPage - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    const pageData = filteredData.slice(start, end);

    pageData.forEach(livro => {
      const row = `<tr>
        <td>${livro.id_livro}</td>
        <td>${livro.titulo}</td>
        <td>${livro.autor}</td>
        <td>${livro.genero}</td>
        <td class="text-center">${livro.ano_publicacao}</td>
        <td class="text-center">${livro.quantidade_disponivel}</td>
        <td class="text-center">${livro.estante}</td>
        <td class="text-center">${livro.prateleira}</td>
            <td>
              <a href="finaliza_emprestimo/${livro.id_livro}" class="btn btn-success">Selecionar</a>
            </td>
      </tr>`;
      tbody.innerHTML += row;
    });

    renderPagination(filteredData);
  }

  // Inicializa a tabela
  renderTable();
</script>
