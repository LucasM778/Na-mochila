<?php include "cabecalho.php"; ?>
<main class="container my-5">
<div class="container mt-5">
  <h2 class="text-center mb-4">Itens Cadastrados</h2>

  <form method="GET" class="mb-4 d-flex justify-content-center">
    <input type="text" name="busca" class="form-control w-50 me-2" placeholder="Buscar item...">
    <button class="btn btn-primary">Buscar</button>
  </form>

  <div class="row">
    <?php
    $busca = $_GET['busca'] ?? '';
    $sql = "SELECT I.*, L.NOME_LOCAL 
            FROM ITEM I 
            LEFT JOIN LOCAIS L ON I.ID_LOCAL = L.ID
            WHERE I.NOME LIKE '%$busca%' OR L.NOME_LOCAL LIKE '%$busca%'
            ORDER BY I.ID DESC";

    $res = $conexao->query($sql);

    if ($res && $res->num_rows > 0) {
      while ($item = $res->fetch_assoc()) {
       echo "
          <div class='col-md-4 mb-4'>
            <div class='card border-0 shadow-lg h-100 rounded-4 overflow-hidden'>
              <div class='position-relative'>
                <img src='".(!empty($item['IMAGEM']) ? $item['IMAGEM'] : "imagem/padrao.png")."' 
                    class='card-img-top' 
                    alt='Imagem do item' 
                    style='height:220px; object-fit:cover;'>
                <span class='badge bg-danger position-absolute top-0 end-0 m-2 px-3 py-2 rounded-pill'>
                  {$item['STATUS']}
                </span>
              </div>
              <div class='card-body d-flex flex-column'>
                <h5 class='card-title text-danger fw-bold mb-2'>
                  <i class='fa-solid fa-tag me-2'></i>{$item['NOME']}
                </h5>
                <p class='card-text text-muted small mb-2'>
                  <i class='fa-solid fa-location-dot me-1 text-danger'></i>
                  <strong>Local:</strong> {$item['NOME_LOCAL']}
                </p>
                <p class='text-muted small mb-2'>
                  <i class='fa-solid fa-calendar-days me-1 text-danger'></i>
                  <strong>Data:</strong> {$item['DATA_ENCONTRADO']}
                </p>
                <p class='card-text mb-3 text-secondary' style='min-height: 50px;'>
                  {$item['DESCRICAO']}
                </p>
              
              </div>
            </div>
          </div>
          ";

      }
    } else {
      echo "<p class='text-center text-muted'>Nenhum item encontrado.</p>";
    }
    ?>
  </div>
</div>
</main>

<?php include "rodape.php"; ?>
