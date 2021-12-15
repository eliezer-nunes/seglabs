<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container-fluid">
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?=(!isset($_GET['page']) || $_GET['page'] == 'servicos') ? 'active' : '' ?>" aria-current="page" href="?page=servicos">Serviços</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link <?=$_GET['page'] == 'transportes' ? 'active' : '' ?> dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Cadastro
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="?page=transportes">Realizar Transporte</a></li>
            <li><a class="dropdown-item" href="?page=tipo_transporte">Tipo Transporte</a></li>
          </ul>
        </li>
      </ul>
		</div>
	</div>
	</nav>