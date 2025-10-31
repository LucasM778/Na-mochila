<?php
include "conexao.php";

// Variáveis para controle do modal
$excluido = false;
$erro_excluir = false;
$mensagemErro = '';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Exclui reivindicações relacionadas
    $conexao->query("DELETE FROM REIVINDICACAO WHERE ID_ITEM = $id");

    //  Depois exclui o item
    $stmt = $conexao->prepare("DELETE FROM ITEM WHERE ID = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $excluido = true; // para mostrar modal de sucesso
    } else {
        $erro_excluir = true;
        $mensagemErro = $stmt->error;
    }

    $stmt->close();
}

$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Excluir Item</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>



<!-- confirmação -->
<div class="modal fade" id="excluirModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      
      <div class="modal-header bg-danger text-white">
        <h3 class="modal-title">Confirmação</h3>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      
      <div class="modal-body text-center fs-5">
        Item excluído com sucesso!
      </div>
      
      <div class="modal-footer justify-content-center">
        <button id="fecharModal" type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
      </div>
      
    </div>
  </div>
</div>

<!-- Para abrir o modal e redirecionar ao fechar -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const modalElement = document.getElementById('excluirModal');
    const modal = new bootstrap.Modal(modalElement);
    modal.show();
 
    // Quando clicar no botão "Fechar", redireciona
    document.getElementById('fecharModal').addEventListener('click', function() {
      window.location.href = 'listar.php';
    });

    //  Se o usuário clicar fora do modal ou apertar ESC, também redireciona
    modalElement.addEventListener('hidden.bs.modal', function () {
      window.location.href = 'listar.php';
    });
  });
</script>


</body>
</html>
