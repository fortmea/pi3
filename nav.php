<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php" ><img class="logo-nav" src="resources/Moview_1.png"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Início</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Catálogo
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="filmes.php">Filmes</a></li>
            <li><a class="dropdown-item" href="series.php">Séries</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="lista.php">Lista completa</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?#sobre">Sobre</a>
        </li>
      </ul>
      <form class="d-flex" action="pesquisa.php">
        <input class="form-control me-2" type="search" placeholder="Pesquisa" name="k" aria-label="Pesquisa">
        <button class="btn btn-outline-light" type="submit">Pesquisa</button>
      </form>
    </div>
  </div>
</nav>