
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" id="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo URL_BASE?>" class="nav-link">Home</a>
      </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      
      <li class="nav-item">
      <div class="image" style="padding-left: 10px; border-left: 1px grey solid" >
          <img src="<?php echo URL_BASE."lib/dist/img/user2-160x160.jpg"?>" class="img-circle" alt="User Image" style="width: 30px;" >
        </div>
      </li>
      

    </ul>
  </nav>
  <!-- /.navbar --> 
  

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="brand-logo">
    <a href="index.php" class="brand-link" style="display:grid; place-items:center;" >
     <span class="brand-text font-weight-light"></span>
    </a>
    </div> 

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="display: grid; place-items:center" >
        <div class="image">
          <img src="<?php echo URL_BASE?>lib/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block" style="color:whitesmoke"><p class="paragrafo">teste</p></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-nurse"></i>
              <p class="paragrafo">
                Empresa
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="<?php echo URL_BASE?>emitente" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p class="paragrafo">
                Lista              
              </p>
            </a>
          </li>
              <li class="nav-item">
          <a href="<?php echo URL_BASE?>emitente/create" class="nav-link">
              <i class="nav-icon fas fa-plus"></i>
              <p class="paragrafo">
                 Novo cadastro
              </p>
            </a>
          </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p class="paragrafo">
                Cliente
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="<?php echo URL_BASE?>cliente" class="nav-link">
              <i class="nav-icon fas fa-plus"></i>
              <p class="paragrafo">
                Lista          
              </p>
            </a>
          </li>
              <li class="nav-item">
          <a href="<?php echo URL_BASE?>cliente/create" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p class="paragrafo">
               Cadastro
              </p>
            </a>
          </li>
            </ul>
          </li> 
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-nurse"></i>
              <p class="paragrafo">
                Médicos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="<?php echo URL_BASE?>medico" class="nav-link">
              <i class="nav-icon fas fa-plus"></i>
              <p class="paragrafo">
                Lista          
              </p>
            </a>
          </li>
              <li class="nav-item">
          <a href="<?php echo URL_BASE?>medico/create" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p class="paragrafo">
               Cadastro
              </p>
            </a>
          </li>
            </ul>
          </li>                   
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-circle"></i>
              <p class="paragrafo">
                Produto
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">          
              <li class="nav-item">
          <a href="<?php echo URL_BASE?>produto" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p class="paragrafo">
                lista
              </p>
            </a>
          </li>
            </ul>
            <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cash-register"></i>
              <p class="paragrafo">
                Vendas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="<?php echo URL_BASE?>venda" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p class="paragrafo">
                Lista              
              </p>
            </a>
          </li>
              <li class="nav-item">
          <a href="<?php echo URL_BASE?>venda/create" class="nav-link">
              <i class="nav-icon fas fa-plus"></i>
              <p class="paragrafo">
                 Nova venda
              </p>
            </a>
          </li>
            </ul>
          </li> 
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-money-bill"></i>
              <p class="paragrafo">
                Notafiscal
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="<?php echo URL_BASE?>notafiscal" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p class="paragrafo">
                Lista              
              </p>
            </a>
          </li>
              <li class="nav-item">
          <a href="<?php echo URL_BASE?>notafiscal/create" class="nav-link">
              <i class="nav-icon fas fa-plus"></i>
              <p class="paragrafo">
                 Nova nota
              </p>
            </a>
          </li>
            </ul>
          </li>
        
          <li class="nav-item">
            <a href="<?php echo URL_BASE."consulta"?>" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p class="paragrafo">
                Consultas                
              </p>
            </a>
           
          </li>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-newspaper"></i>
              <p class="paragrafo">
                Tributação 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="<?php echo URL_BASE?>tributacao" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p class="paragrafo">
                Lista              
              </p>
            </a>
          </li>
              <li class="nav-item">
          <a href="<?php echo URL_BASE?>tributacao/create" class="nav-link">
              <i class="nav-icon fas fa-plus"></i>
              <p class="paragrafo">
                 Novo
              </p>
            </a>
          </li>
            </ul>
          </li>
            
            <li class="nav-item">
          <a href="<?php echo URL_BASE?>" class="nav-link">
              <i class="nav-icon fas fa-code"></i>
              <p class="paragrafo">
                Página inicial
              </p>
            </a>
          </li>
            
          </li>
          <li class="nav-item">
          <a href="sair.php" class="nav-link" style="margin-top:50px; color:red">
              <i class="nav-icon fas fa-trash" ></i>
              <p class="paragrafo">
                Sair
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    <!-- /.sidebar -->
</aside>
</header>