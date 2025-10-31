<?php
include "conexao.php";
include "cabecalho.php";



$sql = "SELECT I.ID AS id, I.NOME AS nome, L.NOME_LOCAL AS local, I.DATA_ENCONTRADO AS data, I.IMAGEM AS imagem
        FROM ITEM I
        LEFT JOIN LOCAIS L ON I.ID_LOCAL = L.ID
        ORDER BY I.ID DESC";
$result = $conexao->query($sql);
?>
<main class="container my-5">
<div class="container mt-4">
  <h3 class="mb-4">Itens Cadastrados</h3>

  <div class="table-responsive">
          <table class="table table-striped align-middle">
            <thead class="table-danger">
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Local</th>
        <th>Data</th>
        <th>Imagem</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($item = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $item['id'] ?></td>
        <td><?= htmlspecialchars($item['nome']) ?></td>
        <td><?= htmlspecialchars($item['local']) ?></td>
        <td><?= $item['data'] ?></td>
        <td>
          <?php if (!empty($item['imagem'])): ?>
            <img src="<?= $item['imagem'] ?>" width="60" height="60" style="object-fit:cover;">
          <?php else: ?>
            <span class="text-muted">Sem imagem</span>
          <?php endif; ?>
        </td>
        <td>
          <a href="editar.php?id=<?= $item['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
         <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmExcluirModal<?= $item['id'] ?>">
  Excluir
</button>

<!-- confirmação -->
<div class="modal fade" id="confirmExcluirModal<?= $item['id'] ?>" tabindex="-1" aria-labelledby="confirmExcluirLabel<?= $item['id'] ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="confirmExcluirLabel<?= $item['id'] ?>"><i class="fa-solid fa-triangle-exclamation me-2"></i>Confirmação</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        Tem certeza que deseja excluir este item?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <a href="excluir.php?id=<?= $item['id'] ?>" class="btn btn-danger">Excluir</a>
      </div>
    </div>
  </div>
</div>
          <a href="reivindicar.php?id=<?= $item['id'] ?>" class="btn btn-success btn-sm">Reivindicar</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</main>

<?php include "rodape.php"; ?>
