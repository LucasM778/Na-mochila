<?php
include "conexao.php";

//  garante que funcione em todos os includes
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Se já estiver logado, volta para o index
if (isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

// Verifica login
if (isset($_POST['entrar'])) {
    $login = trim($_POST['login']);
    $senha = trim($_POST['senha']);

    if (empty($login) || empty($senha)) {
        $erro = "Por favor, preencha todos os campos.";
    } else {
        $sql = "SELECT * FROM USUARIOS WHERE LOGIN = ? AND ATIVO = 1";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($usuario = $resultado->fetch_assoc()) {
            if ($usuario['SENHA'] == $senha) {
                $_SESSION['usuario'] = $usuario['LOGIN'];
                header("Location: index.php");
                exit;
            } else {
                $erro = "Senha incorreta!";
            }
        } else {
            $erro = "Usuário não encontrado ou inativo!";
        }

        $stmt->close();
    }
}
?>

<?php include "cabecalho.php"; ?>
<main class="container my-5">
<div class="container mt-5 col-md-4">
  <h3 class="text-center mb-4">Acesse sua conta</h3>

  <?php if (isset($_GET['erro']) && $_GET['erro'] == 'loginnecessario'): ?>
    <div class="alert alert-warning">⚠️ Faça login para cadastrar um item.</div>
  <?php endif; ?>

  <?php if (isset($erro)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
  <?php endif; ?>

  <form method="POST" class="bg-white p-4 shadow rounded">
    <div class="mb-3">
      <label>Usuário</label>
      <input type="text" name="login" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Senha</label>
      <input type="password" name="senha" class="form-control" required>
    </div>
    <button class="btn btn-primary w-100" name="entrar">Entrar</button>
  </form>
</div>
</main>

<?php include "rodape.php"; ?>
