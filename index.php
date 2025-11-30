<?php include "cabecalho.php";?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Na Mochila Errada - Bem-vindo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      background: linear-gradient(to bottom right, #fff5f5, #ffe0e0);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .welcome-section {
      text-align: center;
      padding: 80px 20px 40px;
    }

    .welcome-section h1 {
      color: #b71c1c;
      font-weight: 700;
      font-size: 2.8rem;
    }

    .welcome-section p {
      color: #444;
      font-size: 1.2rem;
      margin-top: 10px;
    }

    .btn-main {
      background-color: #c62828;
      color: #fff;
      border-radius: 30px;
      padding: 12px 30px;
      font-weight: 500;
      transition: 0.3s;
    }

    .btn-main:hover {
      background-color: #ff5252;
      transform: scale(1.05);
    }

    .card-section {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 25px;
      margin: 60px auto;
      max-width: 1100px;
    }

    .feature-card {
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      padding: 30px;
      text-align: center;
      width: 300px;
      transition: 0.3s;
    }

    .feature-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 18px rgba(0,0,0,0.15);
    }

    .feature-card i {
      font-size: 40px;
      color: #c62828;
      margin-bottom: 15px;
    }

    footer {
      margin-top: auto;
    }

    .feature-card {
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  padding: 30px;
  text-align: center;
  height: 100%; 
  display: flex;
  flex-direction: column;
  justify-content: space-between; 
  transition: transform 0.3s, box-shadow 0.3s;
}

.feature-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 18px rgba(0,0,0,0.15);
}

.feature-card i {
  font-size: 40px;
  color: #c62828;
  margin-bottom: 15px;
}

.feature-card h5 {
  margin-top: 10px;
  font-weight: bold;
  color: #333;
}

.feature-card p {
  flex-grow: 1; 
  color: #555;
}

  </style>
</head>
<body >


<main class="container my-5 ">
  <!-- boas-vindas -->
  <section class="welcome-section pt-0">
    <img src="./imagem/LogoSemFundo.png" alt="Logo Na Mochila Errada" width="200" height="200" class="mb-3">
    <h1>Bem-vindo ao <span style="color:#c62828;">Na Mochila Errada</span></h1>
    <p>O lugar certo para registrar, encontrar e devolver itens perdidos de forma fácil e solidária.</p>
    <a href="achados.php" class="btn btn-main mt-3"><i class="fa-solid fa-bag-shopping me-2"></i>Ver Itens Achados</a>
  </section>

 <section class="container text-center mt-5">
  <div class="row justify-content-center align-items-stretch g-4">
    <div class="col-md-3">
      <div class="feature-card">
        <i class="fa-solid fa-magnifying-glass"></i>
        <h5 class="fw-bold mt-2">Ache seu item</h5>
        <p>Visualize objetos achados por outras pessoas.</p>
        <a href="achados.php" class="btn btn-outline-danger rounded-pill">Explorar</a>
      </div>
    </div>

    <div class="col-md-3">
      <div class="feature-card">
        <i class="fa-solid fa-lightbulb"></i>
        <h5 class="fw-bold mt-2">Como funciona?</h5>
        <p>Entenda em poucos passos como o sistema conecta quem perdeu e quem encontrou.</p>
        <a href="#" class="btn btn-outline-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#comoFuncionaModal">Ver mais</a>
      </div>
    </div>

    <div class="col-md-3">
      <div class="feature-card">
        <i class="fa-solid fa-star"></i>
        <h5 class="fw-bold mt-2">Benefícios</h5>
        <p>Veja como o Na Mochila Errada facilita a devolução de itens e fortalece a comunidade escolar.</p>
        <a href="#" class="btn btn-outline-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#beneficiosModal">Ver mais</a>
      </div>
    </div>

    <div class="col-md-3">
      <div class="feature-card">
        <i class="fa-solid fa-shield-heart"></i>
        <h5 class="fw-bold mt-2">Dicas de prevenção</h5>
        <p>Saiba como evitar perder objetos e proteger seus pertences no dia a dia.</p>
        <a href="#" class="btn btn-outline-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#dicasModal">Ler dicas</a>
      </div>
    </div>
  </div>
</section>



  <!--  Como funciona -->
  <div class="modal fade" id="comoFuncionaModal" tabindex="-1" aria-labelledby="comoFuncionaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-4">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="comoFuncionaModalLabel"><i class="fa-solid fa-lightbulb me-2"></i>Como funciona?</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <ol>
            <li>📷 A escola registra um item achado com foto e descrição.</li>
            <li>🔍 Os alunos pesquisam por objetos  encontrados.</li>
            <li>💬 Entram em contato com a escola.</li>
            <li>🎒 Combinam a devolução </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!--  Beneficios -->
<div class="modal fade" id="beneficiosModal" tabindex="-1" aria-labelledby="beneficiosModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="beneficiosModalLabel">
          <i class="fa-solid fa-star me-2"></i>Benefícios do Na Mochila Errada
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <ul>
          <li>✅ Ajuda quem perdeu a encontrar rapidamente seus pertences.</li>
          <li>✅ Incentiva a honestidade e o senso de comunidade entre os alunos.</li>
          <li>✅ Simplifica o processo de registro e devolução de objetos.</li>
          <li>✅ Garante um ambiente mais organizado e colaborativo na escola.</li>
        </ul>
        <p class="mt-3">
          Com o <strong>Na Mochila Errada</strong>, todos ganham , quem encontra, quem perde e toda a comunidade escolar! 🎒
        </p>
      </div>
    </div>
  </div>
</div>


  <!--  Dicas -->
  <div class="modal fade" id="dicasModal" tabindex="-1" aria-labelledby="dicasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-4">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="dicasModalLabel"><i class="fa-solid fa-shield-heart me-2"></i>Dicas de Prevenção</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <ul>
            <li>✅ Identifique seus objetos com etiquetas ou adesivos personalizados.</li>
            <li>✅ Guarde documentos sempre no mesmo compartimento da mochila.</li>
            <li>✅ Evite deixar pertences desacompanhados em locais públicos.</li>
            <li>✅ Fotografe itens importantes — facilita na busca em caso de perda.</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  </main>
  </body>
  </html>

  <?php include "rodape.php"; ?>

  
