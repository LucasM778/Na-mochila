<?php include "cabecalho.php"; ?>
<?php
include "conexao.php";
$id = $_GET['id'] ?? 0;

// Busca o item atual
$sql = "SELECT * FROM ITEM WHERE ID = $id";
$item = $conexao->query($sql)->fetch_assoc();

if (!$item) {
  echo "<script>alert('Item não encontrado!'); window.location='index.php';</script>";
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Item</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <main class="container my-5">
    <div class="bg-white p-4 rounded shadow">
      <h2 class="text-center mb-4">Editar Item</h2>

      <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $item['ID'] ?>">

        <div class="mb-3">
          <label>Nome do Item</label>
          <input type="text" name="NOME" class="form-control" value="<?= htmlspecialchars($item['NOME']) ?>" required>
        </div>

        <div class="mb-3">
          <label>Descrição</label>
          <textarea name="DESCRICAO" class="form-control" required><?= htmlspecialchars($item['DESCRICAO']) ?></textarea>
        </div>

          <div class="mb-3">
          <label>Data Encontrado</label>
          <input type="date" name="DATA_ENCONTRADO" class="form-control" 
                 value="<?= htmlspecialchars($item['DATA_ENCONTRADO']) ?>">
        </div>

        <div class="mb-3">
          <label>Status</label>
          <select name="status" class="form-control">
            <option value="Achado" <?= ($item['STATUS'] ?? '') == 'Achado' ? 'selected' : '' ?>>Achado</option>
            <option value="Perdido" <?= ($item['STATUS'] ?? '') == 'Perdido' ? 'selected' : '' ?>>Perdido</option>
            <option value="Reivindicado" <?= ($item['STATUS'] ?? '') == 'Reivindicado' ? 'selected' : '' ?>>Reivindicado</option>
          </select>
        </div>

        <div class="mb-3">
          <label>Imagem Atual</label><br>
          <?php if (!empty($item['IMAGEM']) && file_exists($item['IMAGEM'])): ?>
            <img src="<?= $item['IMAGEM'] ?>" alt="Imagem do item" class="img-thumbnail" style="max-height: 150px;">
          <?php else: ?>
            <p class="text-muted">Sem imagem</p>
          <?php endif; ?>
        </div>

        <div class="mb-3">
          <label>Alterar Imagem (opcional)</label>
          <input type="file" name="imagem" accept="image/*" class="form-control">
        </div>

        <button type="submit" name="salvar" class="btn btn-warning w-100">Salvar Alterações</button>
      </form>
    </div>
  </main>
</body>
</html>

<?php
if (isset($_POST['salvar'])) {
  $id = $_POST['id'];
  $nome = $_POST['NOME'];
  $descricao = $_POST['DESCRICAO'];
  $status = $_POST['status'];
  $data = $_POST['DATA_ENCONTRADO'];

  // Se o usuário enviou nova imagem
  $imagem_nova = $item['IMAGEM'];
  if (!empty($_FILES['imagem']['name'])) {
    $pasta = "uploads/";
    if (!is_dir($pasta)) mkdir($pasta, 0777, true);

    // Verifica tipo do arquivo
    $tipo = mime_content_type($_FILES['imagem']['tmp_name']);
    if (str_starts_with($tipo, "image/")) {
      $imagem_nova = $pasta . basename($_FILES["imagem"]["name"]);
      move_uploaded_file($_FILES["imagem"]["tmp_name"], $imagem_nova);
    } else {
      echo "<script>alert('Envie apenas arquivos de imagem!');</script>";
    }
  }

  // Atualiza o item
  $sql = "UPDATE ITEM SET NOME=?, DESCRICAO=?, STATUS=?, IMAGEM=?,  DATA_ENCONTRADO=? WHERE ID=?";
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("sssssi", $nome, $descricao, $status, $imagem_nova, $data, $id);

  if ($stmt->execute()) {
        echo "
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          var modal = new bootstrap.Modal(document.getElementById('atualizado'));
          modal.show();
        });
      </script>
    "; 
    
   // "<script>alert('Item atualizado com sucesso!'); window.location='listar.php';</script>";
  } else {
    echo "<script>alert('Erro ao atualizar: " . $stmt->error . "');</script>";
  }
}
?>

<!-- sucesso -->
<div class="modal fade" id="atualizado" tabindex="-1" aria-labelledby="atualizadoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 border-0 shadow-lg">
      <div class="modal-header bg-success text-white rounded-top-4">
        <h5 class="modal-title" id="atualizadoLabel">
          <i class="fa-solid fa-circle-check me-2"></i>Item atualizado com sucesso!
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center py-4">
        <img src="./uploads/sucesso.jpg" alt="Sucesso" width="100" class="mb-3">
        <p>O item foi atualizado com sucesso e já está disponível na lista de achados.</p>
        <div class="d-flex justify-content-center gap-3 mt-4">
          <a href="listar.php" class="btn btn-success rounded-pill px-4">Voltar </a>
   
        </div>
      </div>
    </div>
  </div>
</div>

<?php include "rodape.php"; ?>
