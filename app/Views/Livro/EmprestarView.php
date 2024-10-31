<main id="main" class="main">

  <?php if ($environment == 'development'): ?>
    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">
            <i>Debug:</i> View/Livro/EmprestarView.php <i>Controller:</i> LivroController
          </li>
        </ol>
      </nav>
    </div>
  <?php endif; ?>

  <div class="pagetitle">
    <h1>Escolha o livro para emprestar</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('home')?>">Início</a></li>
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
                  <th>Tombo</th>
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
  const dados = <?= json_encode($dados) ?>; // Dados passados do PHP para JavaScript
  const rowsPerPage = 5; // Número de registros por página
  let currentPage = 1; // Página inicial

  // Renderiza a tabela com base na página e nos dados fornecidos
  function renderTable(page = 1, data = dados) {
    const tbody = document.getElementById('book-table');
    tbody.innerHTML = ''; // Limpa a tabela

    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    const pageData = data.slice(start, end); // Obtém os registros para a página atual

    pageData.forEach(livro => {
      const encodedlivroId = btoa(unescape(encodeURIComponent(livro.id_livro*44787654548)));
      const link = livro.quantidade_disponivel > 0 
        ? `<a href="<?= base_url('finaliza_emprestimo')?>/${encodedlivroId}" class="btn btn-success">Selecionar</a>`
        : `<span class="btn btn-secondary disabled">Indisponível</span>`;
      const dispo = (livro.quantidade_disponivel == 0)? 'Não': 'Sim';  

      const row = `<tr>
        <td>${livro.id_livro_formatado}</td>
        <td>${livro.titulo}</td>
        <td>${livro.autor}</td>
        <td>${livro.genero}</td>
        <td class="text-center">${livro.ano_publicacao}</td>
        <td class="text-center">${dispo}</td>
        <td class="text-center">${livro.estante_formatado}</td>
        <td class="text-center">${livro.prateleira_formatado}</td>
        <td class="text-center">${link}</td>
      </tr>`;
      
      tbody.innerHTML += row;
    });

    renderPagination(data); // Renderiza a paginação para os dados atuais
  }

  // Renderiza a paginação com base no total de páginas
  function renderPagination(data) {
    const totalPages = Math.ceil(data.length / rowsPerPage);
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = ''; // Limpa a paginação anterior

    for (let i = 1; i <= totalPages; i++) {
      const pageItem = document.createElement('li');
      pageItem.className = 'page-item' + (i === currentPage ? ' active' : '');
      pageItem.innerHTML = `<a class="page-link" href="#">${i}</a>`;
      pageItem.addEventListener('click', (e) => {
        e.preventDefault();
        currentPage = i;
        renderTable(currentPage, data); // Renderiza a nova página
      });
      pagination.appendChild(pageItem);
    }
  }

  // Função de pesquisa para filtrar os dados
  document.getElementById('search').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const filteredData = dados.filter(livro =>
      Object.values(livro).some(value =>
        value.toString().toLowerCase().includes(searchTerm)
      )
    );

    currentPage = 1; // Reseta para a primeira página
    renderTable(currentPage, filteredData); // Renderiza a tabela com os dados filtrados
  });

  // Inicializa a tabela na primeira carga
  renderTable();
</script>
