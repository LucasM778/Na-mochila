<?php include "cabecalho.php"; ?>

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-primary text-light text-center">
          <h4 class="mb-0">Cadastro de Item Perdido</h4>
        </div>
        <div class="card-body p-4">
          <form action="processa_cadastro.php" method="POST" enctype="multipart/form-data">

            <!-- Nome do item -->
            <div class="mb-3">
              <label for="nome_item" class="form-label">Nome do Item</label>
              <input type="text" class="form-control" id="nome_item" name="nome_item" placeholder="Ex: Mochila Azul" required>
            </div>

            <!-- Categoria -->
            <div class="mb-3">
              <label for="categoria" class="form-label">Categoria</label>
              <select class="form-select" id="categoria" name="categoria" required>
                <option value="" selected disabled>Selecione...</option>
                <option value="vestuario">Vestuário</option>
                <option value="eletronicos">Eletrônicos</option>
                <option value="livros">Livros</option>
                <option value="material_escolar">Material Escolar</option>
                <option value="outros">Outros</option>
              </select>
            </div>

            <!-- Local encontrado -->
            <div class="mb-3">
              <label for="local" class="form-label">Local onde foi encontrado</label>
              <input type="text" class="form-control" id="local" name="local" placeholder="Ex: Sala 5, pátio..." required>
            </div>

            <!-- Data -->
            <div class="mb-3">
              <label for="data" class="form-label">Data do achado</label>
              <input type="date" class="form-control" id="data" name="data" required>
            </div>

            <!-- Descrição -->
            <div class="mb-3">
              <label for="descricao" class="form-label">Descrição</label>
              <textarea class="form-control" id="descricao" name="descricao" rows="3" placeholder="Detalhes sobre o item..." required></textarea>
            </div>

            <!-- Upload de imagem -->
            <div class="mb-3">
              <label for="imagem" class="form-label">Foto do Item (opcional)</label>
              <input class="form-control" type="file" id="imagem" name="imagem" accept="image/*">
            </div>

            <!-- Botões -->
            <div class="d-grid">
              <button type="submit" class="btn btn-success">Cadastrar</button>
              <a href="index.php" class="btn btn-secondary mt-2">Cancelar</a>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include "rodape.php"; ?>
