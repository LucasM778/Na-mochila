<?php
include "conexao.php";
session_start();

$usuario = $_SESSION['usuario'] ?? null;

//  Restringe o acesso
if (!$usuario) {
  echo "<script>alert('Apenas usuários logados podem acessar esta página.'); window.location='login.php';</script>";
  exit;
}

//  Busca todas as reivindicações com dados do item e do usuário
$sql = "SELECT R.ID, R.NOME_REIVINDICACAO, R.CONTATO, R.MENSAGEM, R.DATA_REIVINDICACAO,
               I.NOME AS ITEM_NOME, L.NOME_LOCAL, U.LOGIN AS USUARIO
        FROM REIVINDICACAO R
        LEFT JOIN ITEM I ON R.ID_ITEM = I.ID
        LEFT JOIN LOCAIS L ON I.ID_LOCAL = L.ID
        LEFT JOIN USUARIOS U ON R.ID_USUARIO = U.ID
        ORDER BY R.DATA_REIVINDICACAO DESC";

$resultado = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Reivindicações - Na Mochila Errada</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body { background-color: #f8f9fa; }
    .table-container {
      background: white;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>
  <?php include "cabecalho.php"; ?>
<main class="container my-5">
  <div class="container mt-5 mb-5">
    <div class="table-container">
      <h3 class="text-center text-danger mb-4">
        <i class="fa-solid fa-hand-holding-heart me-2"></i>Reivindicações Recebidas
      </h3>

      <?php if ($resultado->num_rows > 0): ?>
        <div class="table-responsive">
          <table class="table table-striped align-middle">
            <thead class="table-danger">
              <tr>
                <th>ID</th>
                <th>Item</th>
                <th>Local Encontrado</th>
                <th>Reivindicado Por</th>
                <th>Contato</th>
                <th>Mensagem</th>
                <th>Data</th>
                <th>Usuário (Sistema)</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($r = $resultado->fetch_assoc()): ?>
                <tr>
                  <td><?= $r['ID'] ?></td>
                  <td><?= htmlspecialchars($r['ITEM_NOME']) ?></td>
                  <td><?= htmlspecialchars($r['NOME_LOCAL']) ?></td>
                  <td><?= htmlspecialchars($r['NOME_REIVINDICACAO']) ?></td>
                  <td><?= htmlspecialchars($r['CONTATO']) ?></td>
                  <td><?= htmlspecialchars($r['MENSAGEM']) ?></td>
                  <td><?= date("d/m/Y", strtotime($r['DATA_REIVINDICACAO'])) ?></td>
                  <td><?= htmlspecialchars($r['USUARIO']) ?></td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <p class="text-center text-muted mt-4">Nenhuma reivindicação registrada até o momento.</p>
      <?php endif; ?>
    </div>
  </div>
  </main>
</body>
</html>
<?php include "rodape.php"; ?>
