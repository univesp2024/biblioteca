<main id="main" class="main">

<style>
        /* Centraliza e destaca o alerta na tela */
        .alert-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            width: 60%; /* Largura maior para mais destaque */
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2); /* Sombra para destaque */
            opacity: 0;
            animation: fadeIn 1s forwards, fadeOut 1s 4s forwards; /* Animação */
        }

        /* Animação suave de entrada */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translate(-50%, -60%); /* Começa um pouco acima */
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }

        /* Animação suave de saída */
        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
            to {
                opacity: 0;
                transform: translate(-50%, -60%);
            }
        }

        /* Personalização do alerta */
        .alert {
            font-size: 1.5rem; /* Aumenta o tamanho do texto */
            padding: 20px; /* Mais espaço interno */
            border-radius: 12px; /* Bordas arredondadas */
        }
    </style>

<?php if ($environment == 'development'): ?>
    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">
            <i>Debug:</i> View/Livro/GerenciaLivroView.php 
            <i>Controller:</i> LivroController
          </li>
        </ol>
      </nav>
    </div>
  <?php endif; ?>


  <div class="pagetitle">
    <h1>Gerenciar livro</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('home')?>">Início</a></li>
        <li class="breadcrumb-item">Gerenciar livro</li>
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
                  <th>Estante</th>
                  <th>Prateleira</th>
                  <th class="text-center">Ações</th>
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

  <!-- Modal de Confirmação -->
  <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmModalLabel">Atenção!</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Você tem certeza que deseja excluir o livro?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
          <button type="button" id="confirmButton" class="btn btn-success">Sim</button>
        </div>
      </div>
    </div>
  </div>


     <!-- Exibe mensagem de sucesso -->
     <div class="container mt-4">
        <!-- Verifica e exibe mensagem de sucesso -->
        <?php if (session()->getFlashdata('success')): ?>
          <div class="alert-container">
            <div class="alert alert-success text-center" id="success-alert">
              <?= session()->getFlashdata('success') ?>
            </div>
          </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
          <div class="alert-container">
            <div class="alert alert-danger text-center" id="danger-alert">
              <?= session()->getFlashdata('error') ?>
            </div>
          </div>
        <?php endif; ?>      
      </div>  

</main>

<script>
  const dados = <?= json_encode($dados) ?>; // Converte os dados PHP para JSON em JS
  const rowsPerPage = 8; // Quantidade de livros por página
  let currentPage = 1;
  let filteredData = [...dados]; // Inicialmente contém todos os dados

  function openModal(livroId) {
    selectedLivroId = livroId;
    const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
    modal.show();
  }

    // Evento de clique no botão de confirmação no modal
    document.getElementById('confirmButton').addEventListener('click', function () {
    if (selectedLivroId !== null) {
      const encodedLivroId = btoa(unescape(encodeURIComponent(selectedLivroId * 54655345764678)));
      window.location.href = `<?= base_url('apaga_livro')?>/${encodedLivroId}`;
    }
  });

  // Função para renderizar uma página específica
  function renderTable(page = 1) {
    const tbody = document.getElementById('book-table');
    tbody.innerHTML = ''; // Limpa o conteúdo da tabela

    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    const pageData = filteredData.slice(start, end); // Dados da página atual

    pageData.forEach(livro => {
      const encodedLivroId = btoa(unescape(encodeURIComponent(livro.id_livro * 3329879632876)));
      const row = `<tr>
        <td>${livro.id_livro_formatado}</td>
        <td>${livro.titulo}</td>
        <td>${livro.autor}</td>
        <td>${livro.genero}</td>
        <td>${livro.ano_publicacao}</td>
        <td class="text-center">${livro.estante_formatado}</td>
        <td class="text-center">${livro.prateleira_formatado}</td>
        <td class="text-center">
            <button class="btn btn-success" onclick="window.location.href='<?= base_url('editar_livro')?>/${encodedLivroId}'">Editar</button>
            <button class="btn btn-danger" onclick="openModal(${livro.id_livro})">Delete</button>
        </td>
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

  window.onload = function() {
        setTimeout(function() {
            const successAlert = document.getElementById('success-alert');
            const errorAlert = document.getElementById('error-alert');
            if (successAlert) successAlert.style.display = 'none';
            if (errorAlert) errorAlert.style.display = 'none';
        }, 5000); // 5000 milissegundos = 5 segundos
    };


</script>