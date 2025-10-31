<?php

// cabecalho.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "conexao.php";

// Verifica se há login ativo
$usuario_logado = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;
$primeiro_nome = $usuario_logado ? explode(' ', trim($usuario_logado))[0] : null;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Na Mochila Errada</title>


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    :root {
      --primary-color: #c62828;
      --secondary-color: #ffffff;
      --hover-color: #ff7043;
    }

    body {
      background-color: #f8f9fa;
    }

    /* Cabeçalho principal */
    .navbar {
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand img {
      width: 55px;
      height: 55px;
      border-radius: 50%;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      transition: transform 0.3s ease;
    }

    .navbar-brand img:hover {
      transform: scale(1.07);
    }

    .navbar-brand span {
      font-weight: 600;
      font-size: 1.25rem;
      color: #fff;
      letter-spacing: 0.5px;
    }

    /* Links do menu */
    .navbar-nav .nav-link {
      color: #fff !important;
      font-weight: 500;
      margin-right: 10px;
      transition: 0.3s;
    }

    .navbar-nav .nav-link:hover {
      color: var(--hover-color) !important;
    }

    /* Dropdown */
    .dropdown-menu {
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      min-width: 200px;
      padding: 0.5rem;
      border: none;
    }

    .dropdown-item {
      border-radius: 8px;
      transition: background-color 0.3s;
    }

    .dropdown-item:hover {
      background-color: var(--hover-color);
      color: #fff;
    }

    .dropdown-item.disabled {
      color: #aaa;
    }

    /* Campo de busca */
    .search-box {
      display: flex;
      align-items: center;
      background: #fff;
      border-radius: 30px;
      padding: 3px 10px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      border: 1px solid #ddd;
    }

    .search-box input {
      border: none;
      outline: none;
      flex: 1;
      font-size: 0.9rem;
      padding: 4px 8px;
    }

    .search-box button {
      background: none;
      border: none;
      color: var(--primary-color);
      cursor: pointer;
    }

    .search-box button:hover {
      color: var(--hover-color);
    }

    /* Área do usuário */
    .user-area {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .user-area span {
      color: #fff;
      font-weight: 500;
    }

    html, body { height: 100%; }
body {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}
main { flex: 1; }

  .navbar .nav-link {
  color: #fff !important;
  transition: all 0.3s ease;
}
.navbar .nav-link:hover {
  color: #ffd5cf !important;
}
.dropdown-menu .dropdown-item:hover {
  background-color: #f8d7da;
}
.input-group input {
  border: none;
  box-shadow: inset 0 0 3px rgba(0,0,0,0.2);
}
    
</style>
</head>

<body>

<!-- Cabeçalho  -->
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background: linear-gradient(90deg, #8b0000, #c0392b);">
  <div class="container py-1">

    <!-- Logo -->
    <a class="navbar-brand d-flex align-items-center" href="index.php">
      <img src="./imagem/mochila.png" alt="Logo Na Mochila Errada" style="height: 45px;">
      <span class="ms-2 fw-bold fs-5">Na Mochila Errada</span>
    </a>

    <!-- Botão  -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Alternar navegação">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Itens da Navbar -->
    <div class="collapse navbar-collapse" id="menu">

      <!-- Menu Principal -->
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item mx-2">
          <a class="nav-link fw-semibold" href="index.php">
            <i class="fa-solid fa-house me-1"></i>Início
          </a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link fw-semibold" href="achados.php">
            <i class="fa-solid fa-bag-shopping me-1"></i>Achados e Perdidos
          </a>
        </li>

        <!-- Dropdown Área Restrita -->
        <li class="nav-item dropdown mx-2">
          <a class="nav-link dropdown-toggle fw-semibold" href="#" id="areaUsuario" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-user-gear me-1"></i>Área Restrita
          </a>
          <ul class="dropdown-menu shadow border-0 rounded-3" aria-labelledby="areaUsuario">
            <?php if ($usuario_logado): ?>
              <li><a class="dropdown-item" href="cadastrar.php"><i class="fa-solid fa-plus me-2 text-danger"></i>Cadastrar Item</a></li>
              <li><a class="dropdown-item" href="listar.php"><i class="fa-solid fa-list me-2 text-danger"></i>Lista de Itens</a></li>
              <li><a class="dropdown-item" href="reivindicacoes.php"><i class="fa-solid fa-hand-holding-heart me-2 text-danger"></i>Reivindicações</a></li>
            <?php else: ?>
              <li><a class="dropdown-item disabled" href="#"><i class="fa-solid fa-lock me-2 text-secondary"></i>Cadastrar Item (restrito)</a></li>
              <li><a class="dropdown-item disabled" href="#"><i class="fa-solid fa-list me-2 text-secondary"></i>Lista de Itens</a></li>
            <?php endif; ?>
          </ul>
        </li>
      </ul>

      <!-- Campo de Busca -->
      <form class="d-flex me-3" method="GET" action="achados.php" style="max-width: 250px;">
        <div class="input-group">
          <input type="search" name="busca" class="form-control form-control-sm rounded-start-pill" placeholder="Pesquisar..." aria-label="Search">
          <button class="btn btn-light btn-sm rounded-end-pill" type="submit"><i class="fa-solid fa-magnifying-glass text-danger"></i></button>
        </div>
      </form>

      <!--Área do Usuário -->
      <div class="user-area d-flex align-items-center gap-2">
        <?php if ($usuario_logado): ?>
          <span><i class="fa-solid fa-user"></i> <?= htmlspecialchars($primeiro_nome) ?></span>

          <a href="logout.php" class="btn btn-outline-light btn-sm rounded-pill px-3">Sair</a>
        <?php else: ?>
          <a href="login.php" class="btn btn-light btn-sm rounded-pill px-3">Login</a>
        <?php endif; ?>
      </div>

    </div>
  </div>
</nav>





