<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina inicial</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
     <script src="./js/bootstrap.bundle.min.js"></script>
  

    
    <style>
    :root {
      --bs-primary: #094e94ff; 
      --bs-secondary: #4caf50; 
      --bs-danger: #003366;
    }
    .bg-primary {
      background-color: var(--bs-primary) !important;
    }

    .bg-danger {
      background-color: var(--bs-danger) !important;
    }

    .dropdown-menu {
      background-color: var(--bs-danger);
    }

    .dropdown-menu .dropdown-item {
      color: #fff;
    }

    .dropdown-menu .dropdown-item:hover {
      background-color: var(--bs-primary);
    }
  </style>
    
</head>
<body>



   <!-- Imagem Logo  -->
    <div class="bg-primary">
  
     
    </div>
  
   <!-- Menu  -->
  <nav class="navbar navbar-expand-lg bg-primary "  data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand text-light" href="index.php">Menu</a>
        <button class="navbar-toggler"  type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active text-light" aria-current="page" href="achados.php">Achado</a>
          </li> 
          <li class="nav-item">
            <a class="nav-link text-light" href="cadastrar.php">Cadastrar</a>
          </li>

          

          

          <!--Categorias -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Categorias
            </a>
            <ul class="dropdown-menu text-light">
              <li><a class="dropdown-item" href="#">Vestuario</a></li>
              <li><a class="dropdown-item" href="#">Eletronicos</a></li>
              <li><a class="dropdown-item" href="#">Livros</a></li>
              <li><a class="dropdown-item" href="#">Material Escolar</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Outros</a></li>
            </ul>
          </li>

          
            <a class="nav-link" href="instalar.php" > 
              Instalar o banco 
            </a>
      
  
        
        </ul>

             <div class ="container col-3 ">
              <img src="./Imagem/mochila.png" class="img-fluid rounded-circle "alt="Logo na Mochila Errada" width =100 height=68/>
          </div>
       

        

        <!--Pesquisar -->
        <form class="d-flex " role="search">
          <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search"/>
          <button class="btn btn btn-primary" type="submit">Buscar</button>
        </form>
      </div>
    </div>
  </nav>
