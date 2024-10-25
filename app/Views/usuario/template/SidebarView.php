 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="home">
      <i class="bi bi-grid"></i>
      <span>Início</span>
    </a>
  </li><!-- End Dashboard Nav -->


  <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav-1" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Doações</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav-1" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="minhasdoacoes">
              <i class="bi bi-circle"></i><span>Minhas doações</span>
            </a>
          </li>
          <li>
            <a href="inserirdoacao">
              <i class="bi bi-circle"></i>
              <span>
                Inserir doação
              </span>
            </a>
          </li>


        </ul>
      </li>

  



  
  <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav-2" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Pedido de doação</span>
          <i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav-2" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="listasolicitacao">
              <i class="bi bi-circle"></i><span>Minhas solicitações</span>
            </a>
          </li>
          <li>
            <a href="solicitadoacao">
              <i class="bi bi-circle"></i><span>Solicitar doação</span>
            </a>
          </li>


        </ul>
      </li>




  <li class="nav-item">
    <a class="nav-link collapsed" href="logout">
      <i class="bi bi-box-arrow-right"></i>
      <span>Sair</span>
    </a>
  </li><!-- End Blank Page Nav -->

  

  <?php if ($environment== 'development'): ?>
      <hr></hr>
      <h6>O menu abaixo será mostrado apenas durante o desenvolvimento</h6>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav-3" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Manutenção</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav-3" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="limpatabela">
              <i class="bi bi-circle"></i><span>Limpar tabelas</span>
            </a>
          </li>
          <?php if(!$hasData): ?>
          <li>
            <a href="ficticios">
              <i class="bi bi-circle"></i><span>Inserir usuários fictícios</span>
            </a>
          </li>
          <?php endif; ?>
          <li>
            <a href="limpacookie">
              <i class="bi bi-circle"></i><span>Limpar e-mail de teste</span>
            </a>
          </li>          

        </ul>
      </li><!-- End Forms Nav -->
  <?php endif;?>

</ul>

</aside><!-- End Sidebar-->