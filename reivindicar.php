<?php
include "conexao.php";
session_start();

// ID do item
$id_item = $_GET['id_item'] ?? $_GET['id'] ?? null;
if (!$id_item) {
    echo "<script>alert('Item não especificado!'); window.location='index.php';</script>";
    exit;
}

// Verifica login
$usuario = $_SESSION['usuario'] ?? null;
if (!$usuario) {
    echo "<script>alert('Faça login para reivindicar o item.'); window.location='login.php';</script>";
    exit;
}

// Verifica se o item já foi reivindicado
$sql_verifica = "SELECT * FROM REIVINDICACAO WHERE ID_ITEM = ?";
$stmt_verifica = $conexao->prepare($sql_verifica);
$stmt_verifica->bind_param("i", $id_item);
$stmt_verifica->execute();
$resultado_verifica = $stmt_verifica->get_result();
$ja_reivindicado = $resultado_verifica->num_rows > 0;

// Busca dados do item
$sql_item = "SELECT I.ID, I.NOME, I.DESCRICAO, I.STATUS, L.NOME_LOCAL, I.IMAGEM
             FROM ITEM I 
             LEFT JOIN LOCAIS L ON I.ID_LOCAL = L.ID
             WHERE I.ID = ?";
$stmt_item = $conexao->prepare($sql_item);
$stmt_item->bind_param("i", $id_item);
$stmt_item->execute();
$item = $stmt_item->get_result()->fetch_assoc();
if (!$item) {
    echo "<script>alert('Item não encontrado!'); window.location='index.php';</script>";
    exit;
}

// Envio do formulário
$sucesso = false;
if (isset($_POST['confirmar'])) {
    $nome = trim($_POST['nome']);
    $contato = trim($_POST['contato']);
    $mensagem = trim($_POST['mensagem']);
    $data = date('Y-m-d');

    // Busca ID do usuário
    $sql_user = "SELECT ID FROM USUARIOS WHERE LOGIN = ?";
    $stmt_user = $conexao->prepare($sql_user);
    $stmt_user->bind_param("s", $usuario);
    $stmt_user->execute();
    $user = $stmt_user->get_result()->fetch_assoc();
    $id_user = $user['ID'] ?? null;

    if ($id_user && !$ja_reivindicado) {
        $sql_insert = "INSERT INTO REIVINDICACAO (NOME_REIVINDICACAO, CONTATO, MENSAGEM, DATA_REIVINDICACAO, ID_ITEM, ID_USUARIO)
                       VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_insert = $conexao->prepare($sql_insert);
        $stmt_insert->bind_param("ssssii", $nome, $contato, $mensagem, $data, $id_item, $id_user);
        if ($stmt_insert->execute()) {
            $sql_update = "UPDATE ITEM SET STATUS='Reivindicado' WHERE ID=?";
            $stmt_update = $conexao->prepare($sql_update);
            $stmt_update->bind_param("i", $id_item);
            $stmt_update->execute();
            $sucesso = true;
        }
    }
}
?>

<?php include "cabecalho.php"; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Reivindicar Item</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body { background-color: #f8f9fa; }
    .card { border-radius: 12px; overflow: hidden; }
  </style>
</head>

<body>
<main class="container my-5">
  <div class="col-md-6 mx-auto">
    <div class="card shadow p-4">
      <h3 class="text-center text-danger mb-3">
        <i class="fa-solid fa-hand-holding-heart me-2"></i>Reivindicar Item
      </h3>

      <div class="text-center mb-3">
        <img src="<?= $item['IMAGEM'] ?: 'imagem/placeholder.png' ?>" class="img-fluid rounded" style="max-height:200px;object-fit:cover;">
      </div>

      <div class="alert alert-info">
        <strong>Item:</strong> <?= htmlspecialchars($item['NOME']) ?><br>
        <strong>Local:</strong> <?= htmlspecialchars($item['NOME_LOCAL']) ?><br>
        <strong>Status:</strong> <?= htmlspecialchars($item['STATUS']) ?><br>
        <small class="text-muted"><?= htmlspecialchars($item['DESCRICAO']) ?></small>
      </div>

      <?php if (!$ja_reivindicado): ?>
      <form method="POST">
        <div class="mb-3">
          <label class="form-label">Seu Nome Completo</label>
          <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Contato (E-mail ou Telefone)</label>
          <input type="text" name="contato" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Mensagem (opcional)</label>
          <textarea name="mensagem" rows="3" class="form-control" placeholder="Detalhes que comprovem ser o dono..."></textarea>
        </div>
        <button name="confirmar" class="btn btn-success w-100">
          <i class="fa-solid fa-paper-plane me-2"></i>Enviar Reivindicação
        </button>
      </form>
      <?php else: ?>
        <div class="alert alert-warning text-center">
          <i class="fa-solid fa-triangle-exclamation me-2"></i>Este item já foi reivindicado!
        </div>
      <?php endif; ?>
    </div>
  </div>
</main>

<!--   sucesso ou aviso -->
<div class="modal fade" id="mensagemModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg text-center">
      <div class="modal-header <?= $sucesso ? 'bg-success text-white' : 'bg-warning' ?> border-0">
        <h5 class="modal-title w-100">
          <?= $sucesso ? '<i class="fa-solid fa-circle-check me-2"></i>Sucesso!' : '<i class="fa-solid fa-triangle-exclamation me-2"></i>Aviso' ?>
        </h5>
      </div>
      <div class="modal-body fs-5">
        <?= $sucesso ? 'Sua reivindicação foi registrada com sucesso.' : 'Este item já foi reivindicado!' ?>
      </div>
      <div class="modal-footer border-0 justify-content-center">
        <a href="listar.php" class="btn <?= $sucesso ? 'btn-success' : 'btn-warning' ?>">Voltar à Página Inicial</a>
      </div>
    </div>
  </div>
</div>

<?php if ($sucesso || $ja_reivindicado): ?>
<script>
  const modal = new bootstrap.Modal(document.getElementById('mensagemModal'));
  modal.show();
</script>
<?php endif; ?>

<?php include "rodape.php"; ?>
</body>
</html>
