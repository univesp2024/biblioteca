<main id="main" class="main">

<?php if ($environment == 'development'): ?>
    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">
            <i>Debug:</i> View/Livro/FinalizaEmprestimoView.php 
            <i>Controller:</i> LivroController
          </li>
        </ol>
      </nav>
    </div>
<?php endif; ?>

<div class="pagetitle">
    <h1>Finalizar Empréstimo</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Início</a></li>
        <li class="breadcrumb-item">Finalizar empréstimo</li>
      </ol>
    </nav>
</div>

<section class="section dashboard">
    <div class="row">
      <div class="card">
        <div class="card-header">
          <h6>Livro escolhido</h6>
        </div>
        <div class="card-body">
          <h6 class="mt-2"><strong>Tombo:</strong> <?= $dados['id_livro'] ?> - 
          <strong>Título:</strong> <?= $dados['titulo'] ?> - 
          <strong>Autor:</strong> <?= $dados['autor'] ?></h6>
        </div>
      </div>
    </div>
</section>

<section class="section dashboard">
    <div class="row">
      <div class="col-lg-12">
        <div class="card info-card customers-card">
          <div class="card-body">
            <h5 class="card-title">Selecione o aluno</h5>
            <input type="text" id="search" placeholder="Pesquisar por ID ou Nome..." class="form-control mb-3">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>Email</th>
                  <th>Telefone</th>
                  <th class="text-center">Ação</th>
                </tr>
              </thead>
              <tbody id="aluno-table"></tbody>
            </table>
            <nav>
              <ul class="pagination justify-content-center" id="pagination"></ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
</section>

<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmModalLabel">Confirmar Empréstimo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Tem certeza de que deseja emprestar o livro para este aluno?
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
  const dados = <?= json_encode($dados_alunos) ?>;
  const rowsPerPage = 5;
  let currentPage = 1;
  let filteredData = [...dados];
  let selectedAlunoId = null;

  function renderTable(page = 1) {
    const tbody = document.getElementById('aluno-table');
    tbody.innerHTML = '';

    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    const pageData = filteredData.slice(start, end);

    pageData.forEach(aluno => {
      const row = `<tr>
        <td>${aluno.id_aluno_formatado}</td>
        <td>${aluno.nome}</td>
        <td>${aluno.email}</td>
        <td>${aluno.telefone}</td>
        <td class="text-center">
          <button class="btn btn-success" onclick="openModal(${aluno.id_aluno})">Emprestar</button>
        </td>
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

  function openModal(alunoId) {
    selectedAlunoId = alunoId;
    const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
    modal.show();
  }

  document.getElementById('confirmButton').addEventListener('click', function () {
    if (selectedAlunoId !== null) {
      const encodedAlunoId = btoa(unescape(encodeURIComponent(selectedAlunoId * 45687986546)));
      window.location.href = `/registra_emprestimo/<?= base64_encode($dados['id_livro'] * 43467323246) ?>/${encodedAlunoId}`;
    }
  });

  document.getElementById('search').addEventListener('input', function () {
    const searchTerm = this.value.toLowerCase();
    filteredData = dados.filter(aluno =>
      aluno.id_aluno_formatado.toLowerCase().includes(searchTerm) ||
      aluno.nome.toLowerCase().includes(searchTerm)
    );

    currentPage = 1;
    renderTable(currentPage);
  });

  renderTable();
</script>
