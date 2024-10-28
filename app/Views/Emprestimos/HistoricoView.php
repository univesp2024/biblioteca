<main id="main" class="main">

  <?php
    // var_dump($dados);
  ?>

  <?php if ($environment == 'development'): ?>
    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">
            <i>Debug:</i> View/Emprestimo/HistoricoView.php <i>Controller:</i> EmprestimoController
          </li>
        </ol>
      </nav>
    </div>
  <?php endif; ?>

  <div class="pagetitle">
    <h1>Histórico de empréstimo de livros</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home">Início</a></li>
        <li class="breadcrumb-item">Histórico Empréstimos</li>
      </ol>
    </nav>
  </div>

  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-12">
        <div class="card info-card customers-card">
          <div class="card-body">
            <h5 class="card-title">Livros <span>| Disponíveis</span></h5>
            <input type="text" id="search" placeholder="Pesquisar..." class="form-control mb-3">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Empréstimo</th>
                  <th class="text-center">Tombo</th>
                  <th>Título</th>
                  <th>RA</th>
                  <th>Nome</th>
                  <th>E-mail</th>
                  <th>Status</th>
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

    function formatarData(dataString) {
      const data = new Date(dataString);
      const dia = String(data.getDate()).padStart(2, '0');
      const mes = String(data.getMonth() + 1).padStart(2, '0');
      const ano = data.getFullYear();
      return `${dia}/${mes}/${ano}`;
    }




    pageData.forEach(livro => {

      const nomeFormatado = (livro.status === 'inativo')
        ? `<s>${livro.nome}</s>`
        : livro.nome;

        const tituloFormatado = (livro.li_status === 'inativo')
        ? `<s>${livro.titulo}</s>`
        : livro.titulo;        
        
      const statusLivro = (livro.em_status === 'pendente')
      ? `<strong style="color:red;">${livro.em_status}</strong>`
      : livro.em_status;

      const row = `<tr>
                   <td>${livro.id_emprestimo}</td>
                   <td>${formatarData(livro.data_emprestimo)}</td>
                   <td class="text-center">${livro.id_livro_formatado}</td>
                   <td>${tituloFormatado}</td>
                   <td>${livro.id_aluno_formatado}</td>
                   <td>${nomeFormatado}</td>
                   <td>${livro.email}</td>
                   <td>${statusLivro}</td>
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
  document.getElementById('search').addEventListener('input', function () {
    const searchTerm = this.value.toLowerCase();
    const filteredData = dados.filter(livro =>
      Object.values(livro).some(value =>
        (value ? value.toString().toLowerCase() : "").includes(searchTerm)
      )
    );


    currentPage = 1; // Reseta para a primeira página
    renderTable(currentPage, filteredData); // Renderiza a tabela com os dados filtrados
  });

  // Inicializa a tabela na primeira carga
  renderTable();
</script>