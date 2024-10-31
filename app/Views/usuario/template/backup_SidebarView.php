 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="/home">
      <i class="bi bi-grid"></i>
      <span>Início</span>
    </a>
  </li><!-- End Dashboard Nav -->


  
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav-1" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Livros</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav-1" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="<?= base_url('cadastrar_livro')?>">
            <i class="bi bi-circle"></i><span>Cadastrar</span>
          </a>
        </li>        
        <li>
          <a href="<?= base_url('consultar_livro')?>">
            <i class="bi bi-circle"></i><span>Consultar</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url('emprestar_livro')?>">
            <i class="bi bi-circle"></i><span>Emprestar</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url('devolver_livro')?>">
            <i class="bi bi-circle"></i><span>Devolver</span>
          </a>
        </li>          
      </ul>
    </li>

  
  
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav-2" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Alunos</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav-2" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?= base_url('cadastrar_aluno')?>">
              <i class="bi bi-circle"></i><span>Cadastrar</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('GerenciaAluno')?>">
              <i class="bi bi-circle"></i><span>Gerenciar</span>
            </a>
          </li>
        </ul>
      </li>


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav-3" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Empréstimos</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav-3" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?= base_url('historico_emprestimos')?>">
              <i class="bi bi-circle"></i><span>Histórico</span>
            </a>
          </li>
        </ul>
      </li>      









  <li class="nav-item">
    <a class="nav-link collapsed" href="<?= base_url('logout')?>">
      <i class="bi bi-box-arrow-right"></i>
      <span>Sair</span>
    </a>
  </li><!-- End Blank Page Nav -->

  



</ul>

</aside><!-- End Sidebar-->