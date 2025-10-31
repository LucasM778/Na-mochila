<?php include "conexao.php";
if (session_status() === PHP_SESSION_NONE) session_start();

// Verifica login
if (!isset($_SESSION['usuario'])) {
  header("Location: login.php?erro=loginnecessario");
  exit;
}

$usuario_logado = $_SESSION['usuario'];

// Cadastro do item
if (isset($_POST['cadastrar'])) {
  $nome = trim($_POST['nome']);
  $descricao = trim($_POST['descricao']);
  $data = $_POST['data'];
  $status = $_POST['status'];
  $local_nome = trim($_POST['local']);

  // Verifica se o local já existe, se não existir, insere
  $sql_local = "SELECT ID FROM LOCAIS WHERE NOME_LOCAL = ?";
  $stmt_local = $conexao->prepare($sql_local);
  $stmt_local->bind_param("s", $local_nome);
  $stmt_local->execute();
  $result_local = $stmt_local->get_result();

  if ($result_local->num_rows > 0) {
      $id_local = $result_local->fetch_assoc()['ID'];
  } else {
      $sql_insert_local = "INSERT INTO LOCAIS (NOME_LOCAL) VALUES (?)";
      $stmt_insert_local = $conexao->prepare($sql_insert_local);
      $stmt_insert_local->bind_param("s", $local_nome);
      $stmt_insert_local->execute();
      $id_local = $stmt_insert_local->insert_id;
  }


  // Upload da imagem
  $imagem = "";
  if (!empty($_FILES['imagem']['name'])) {
    $extensoes_permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $extensao = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));

    if (in_array($extensao, $extensoes_permitidas)) {
      $pasta = "uploads/";
      if (!is_dir($pasta)) mkdir($pasta, 0777, true);
      $imagem = $pasta . uniqid("item_") . "." . $extensao;
      move_uploaded_file($_FILES["imagem"]["tmp_name"], $imagem);
    } else {
      echo "<script>alert('Por favor, envie apenas imagens (jpg, png, gif, webp).');</script>";
      $imagem = "./uploads/mochila.png"; // ícone padrão
    }
  } else {
    $imagem = "./uploads/mochila.png"; // imagem padrão
  }

  // Insere o item no banco
  $sql = "INSERT INTO ITEM (NOME, DESCRICAO, DATA_ENCONTRADO, ID_LOCAL, IMAGEM, STATUS)
          VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $conexao->prepare($sql);
  $stmt->bind_param("sssiss", $nome, $descricao, $data, $id_local, $imagem, $status);

  if ($stmt->execute()) {
    echo "
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          var modal = new bootstrap.Modal(document.getElementById('cadastroSucesso'));
          modal.show();
        });
      </script>
    ";
  } else {
    echo "<script>alert('Erro ao cadastrar: {$stmt->error}');</script>";
  }
}



include "cabecalho.php";
?>


<main class="container my-5 col-md-6 ">




  <div class="card shadow p-4 rounded-4">
    <h3 class="text-center mb-4 text-danger">
      <i class="fa-solid fa-box-open me-2"></i>Cadastrar Novo Item
    </h3>
    <form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
      <div class="mb-3">
        <label>Nome do Item</label>
        <input type="text" name="nome" class="form-control" required>
      </div>

      <div class="mb-3">
        <label>Descrição</label>
        <textarea name="descricao" class="form-control" rows="3" required></textarea>
      </div>

      <div class="mb-3">
        <label>Local</label>
        <input type="text" name="local" class="form-control" placeholder="Digite o local onde o item foi encontrado" required>
      </div>

      <div class="mb-3">
        <label>Data Encontrado</label>
        <input type="date" name="data" class="form-control">
      </div>

      <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control">
          <option value="Achado">Achado</option>
          <option value="Perdido">Perdido</option>
        </select>
      </div>

      <div class="mb-3">
        <label>Imagem</label>
        <input type="file" name="imagem" class="form-control" accept="image/*">
      </div>

      <button name="cadastrar" class="btn btn-danger w-100 rounded-pill py-2">
        <i class="fa-solid fa-upload me-2"></i>Cadastrar
      </button>
    </form>
  </div>
</main>

<!--  sucesso -->
<div class="modal fade" id="cadastroSucesso" tabindex="-1" aria-labelledby="cadastroSucessoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 border-0 shadow-lg">
      <div class="modal-header bg-success text-white rounded-top-4">
        <h5 class="modal-title" id="cadastroSucessoLabel">
          <i class="fa-solid fa-circle-check me-2"></i>Cadastro realizado com sucesso!
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center py-4">
        <img src="./uploads/sucesso.jpg" alt="Sucesso" width="100" class="mb-3">
        <p>O item foi cadastrado com sucesso e já está disponível na lista de achados.</p>
        <div class="d-flex justify-content-center gap-3 mt-4">
          <a href="index.php" class="btn btn-success rounded-pill px-4">Voltar ao Início</a>
          <a href="cadastrar.php" class="btn btn-outline-success rounded-pill px-4">Cadastrar Outro</a>
        </div>
      </div>
    </div>
  </div>
</div>

  <style>
  main {
    margin-top: 80px;
    margin-bottom: 80px ;
  }

  .card {
    min-height: 750px; 
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding-top: 40px ;
    padding-bottom: 40px ;
  }

  form .form-control, 
  form textarea {
    min-height: 50px; 
    font-size: 1rem;
    padding: 10px 14px;
  }

  form .mb-3 {
    margin-bottom: 1.5rem ; 
  }

  button.btn-danger {
    padding: 14px 0 ;
    font-size: 1.1rem;
  }
</style>

<?php include "rodape.php"; ?>
