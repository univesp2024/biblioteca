<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link <?= $rotaAtual == 'home' ? '' : 'collapsed' ?>" href="/home">
        <i class="bi bi-grid"></i><span>Início</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?= in_array($rotaAtual, ['cadastrar_livro', 'consultar_livro', 'emprestar_livro', 'devolver_livro']) ? '' : 'collapsed' ?>" 
         data-bs-target="#forms-nav-1" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Livros</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav-1" class="nav-content collapse <?= in_array($rotaAtual, ['cadastrar_livro', 'consultar_livro', 'emprestar_livro', 'devolver_livro']) ? 'show' : '' ?>" 
          data-bs-parent="#sidebar-nav">
        <li><a href="cadastrar_livro" class="<?= $rotaAtual == 'cadastrar_livro' ? 'active' : '' ?>">
          <i class="bi bi-circle"></i><span>Cadastrar</span></a>
        </li>
        <li><a href="consultar_livro" class="<?= $rotaAtual == 'consultar_livro' ? 'active' : '' ?>">
          <i class="bi bi-circle"></i><span>Consultar</span></a>
        </li>
        <li><a href="emprestar_livro" class="<?= $rotaAtual == 'emprestar_livro' ? 'active' : '' ?>">
          <i class="bi bi-circle"></i><span>Emprestar</span></a>
        </li>
        <li><a href="devolver_livro" class="<?= $rotaAtual == 'devolver_livro' ? 'active' : '' ?>">
          <i class="bi bi-circle"></i><span>Devolver</span></a>
        </li>
      </ul>
    </li>

    <li class="nav-item">
      <a class="nav-link <?= in_array($rotaAtual, ['cadastrar_aluno', 'GerenciaAluno']) ? '' : 'collapsed' ?>" 
         data-bs-target="#forms-nav-2" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Alunos</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav-2" class="nav-content collapse <?= in_array($rotaAtual, ['cadastrar_aluno', 'GerenciaAluno']) ? 'show' : '' ?>" 
          data-bs-parent="#sidebar-nav">
        <li><a href="cadastrar_aluno" class="<?= $rotaAtual == 'cadastrar_aluno' ? 'active' : '' ?>">
          <i class="bi bi-circle"></i><span>Cadastrar</span></a>
        </li>
        <li><a href="GerenciaAluno" class="<?= $rotaAtual == 'GerenciaAluno' ? 'active' : '' ?>">
          <i class="bi bi-circle"></i><span>Gerenciar</span></a>
        </li>
      </ul>
    </li>

    <li class="nav-item">
      <a class="nav-link <?= $rotaAtual == 'historico_emprestimos' ? '' : 'collapsed' ?>" 
         data-bs-target="#forms-nav-3" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Empréstimos</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav-3" class="nav-content collapse <?= $rotaAtual == 'historico_emprestimos' ? 'show' : '' ?>" 
          data-bs-parent="#sidebar-nav">
        <li><a href="historico_emprestimos" class="<?= $rotaAtual == 'historico_emprestimos' ? 'active' : '' ?>">
          <i class="bi bi-circle"></i><span>Histórico</span></a>
        </li>
      </ul>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="/logout">
        <i class="bi bi-box-arrow-right"></i><span>Sair</span>
      </a>
    </li>

  </ul>
</aside>
