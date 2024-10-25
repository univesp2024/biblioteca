 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="dashboard">
      <i class="bi bi-grid"></i>
      <span>Menu</span>
    </a>
  </li><!-- End Dashboard Nav -->

  <?php if ($environment!= 'production'): ?>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Desenvolvimento</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="limpatabela">
              <i class="bi bi-circle"></i><span>Limpar tabelas</span>
            </a>
          </li>
          <?php if(!$hasData): ?>
          <li>
            <a href="ficticios">
              <i class="bi bi-circle"></i><span>Inserir dados fictícios</span>
            </a>
          </li>
          <?php endif; ?>

        </ul>
      </li><!-- End Forms Nav -->
  <?php endif;?>


  
  <li class="nav-item">
    <a class="nav-link collapsed" href="#">
      <i class="bi bi-person"></i>
      <span><strike>Inserir doação</strike></span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#">
      <i class="bi bi-person"></i>
      <span><strike>Solicitar doação</strike></span>
    </a>
  </li>  




  <li class="nav-item">
    <a class="nav-link collapsed" href="logout">
      <i class="bi bi-box-arrow-right"></i>
      <span>Sair</span>
    </a>
  </li><!-- End Blank Page Nav -->

</ul>

</aside><!-- End Sidebar-->