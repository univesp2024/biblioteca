<main id="main" class="main">

  <?php if ($environment == 'development'): ?>
    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">
            <i>Debug:</i> View/Livro/DevolverView.php 
            <i>Controller:</i> LivroController
          </li>
        </ol>
      </nav>
    </div>
  <?php endif; ?>

  <div class="pagetitle">
    <h1>Escolha o livro para devolução</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('home')?>">Início</a></li>
        <li class="breadcrumb-item">Devolver livro</li>
      </ol>
    </nav>
  </div>

  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-12">
        <div class="card info-card customers-card">
          <div class="card-body">
            <h5 class="card-title">Livros <span>| Emprestados</span></h5>
            <input type="text" id="search" placeholder="Pesquisar..." class="form-control mb-3">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Tombo</th>
                  <th>Título</th>
                  <th>Emprestado</th>
                  <th>Cód Aluno</th>
                  <th>Nome aluno</th>
                  <th>Telefone</th>
                  <th>E-mail</th>
                  <th class="text-center">Ação</th>
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

  <!-- Modal de Confirmação -->
  <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmModalLabel">Confirmar Devolução</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Tem certeza de que deseja devolver o livro?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
          <button type="button" id="confirmButton" class="btn btn-success">Sim</button>
        </div>
      </div>
    </div>
  </div>

</main>

<script>
  const dados = <?= json_encode($dados) ?>; // Dados passados do PHP para JavaScript
  const rowsPerPage = 5; // Número de registros por página
  let currentPage = 1; // Página inicial
  let selectedAlunoId = null;
  let selectedLivroId = null;

  // Função para abrir o modal e armazenar os IDs do livro e aluno
  function openModal(alunoId, livroId) {
    selectedAlunoId = alunoId;
    selectedLivroId = livroId;
    const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
    modal.show();
  }

  // Evento de clique no botão de confirmação no modal
  document.getElementById('confirmButton').addEventListener('click', function () {
    if (selectedAlunoId !== null && selectedLivroId !== null) {
      const encodedLivroId = btoa(unescape(encodeURIComponent(selectedLivroId * 44787654548)));
      const encodedAlunoId = btoa(unescape(encodeURIComponent(selectedAlunoId * 54652154678)));
      window.location.href = `<?= base_url('aluno_devolver')?>/${encodedLivroId}/${encodedAlunoId}`;
    }
  });

  // Função para formatar a data no formato d/m/Y H:i:s
  function formatarData(dataString) {
    const data = new Date(dataString);
    const dia = String(data.getDate()).padStart(2, '0');
    const mes = String(data.getMonth() + 1).padStart(2, '0');
    const ano = data.getFullYear();
    const horas = String(data.getHours()).padStart(2, '0');
    const minutos = String(data.getMinutes()).padStart(2, '0');
    const segundos = String(data.getSeconds()).padStart(2, '0');
    return `${dia}/${mes}/${ano} ${horas}:${minutos}:${segundos}`;
  }

  // Renderiza a tabela com base na página e nos dados fornecidos
  function renderTable(page = 1, data = dados) {
    const tbody = document.getElementById('book-table');
    tbody.innerHTML = ''; // Limpa a tabela

    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    const pageData = data.slice(start, end); // Obtém os registros para a página atual

    pageData.forEach(livro => {
      const dataFormatada = formatarData(livro.data_emprestimo);
      const row = `
        <tr>
          <td class="text-center">${livro.id_livro_formatado}</td>
          <td>${livro.titulo}</td>
          <td class="text-center">${dataFormatada}</td>
          <td class="text-center">${livro.id_aluno_formatado}</td>
          <td>${livro.nome}</td>
          <td>${livro.telefone}</td>
          <td>${livro.email}</td>
          <td class="text-center">
            <button class="btn btn-success" onclick="openModal(${livro.id_aluno}, ${livro.id_livro})">Devolver</button>
          </td>
        </tr>`;
      tbody.innerHTML += row;
    });

    renderPagination(data); // Atualiza a paginação
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
        renderTable(currentPage, data); // Renderiza a página correspondente
      });
      pagination.appendChild(pageItem);
    }
  }

  // Função de pesquisa para filtrar os dados
  document.getElementById('search').addEventListener('input', function () {
    const searchTerm = this.value.toLowerCase();

    const filteredData = dados.filter(livro =>
      Object.values(livro).some(value =>
        value && value.toString().toLowerCase().includes(searchTerm)
      )
    );

    currentPage = 1; // Reinicia para a primeira página ao pesquisar
    renderTable(currentPage, filteredData); // Renderiza a tabela com os dados filtrados
  });

  // Inicializa a tabela na primeira execução
  renderTable();
</script>
