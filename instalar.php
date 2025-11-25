<?php include "conexao.php";
// Cria o banco de dados se não existir
$conexao->query("CREATE DATABASE IF NOT EXISTS mochila_errada");
$conexao->select_db("mochila_errada");


// TABELA: USUÁRIOS

$sql = "CREATE TABLE IF NOT EXISTS USUARIOS (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    LOGIN VARCHAR(50) NOT NULL,
    SENHA VARCHAR(80) NOT NULL,
    ATIVO BIT DEFAULT 1
) ENGINE=InnoDB";
if ($conexao->query($sql)) {
    echo " Tabela USUARIOS criada ou já existente.<br>";
} else {
    echo " Erro ao criar USUARIOS: " . $conexao->error . "<br>";
}


// TABELA: LOCAIS

$sql = "CREATE TABLE IF NOT EXISTS LOCAIS (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    NOME_LOCAL VARCHAR(100) NOT NULL
) ENGINE=InnoDB";
if ($conexao->query($sql)) {
    echo " Tabela LOCAIS criada ou já existente.<br>";
} else {
    echo " Erro ao criar LOCAIS: " . $conexao->error . "<br>";
}


// TABELA: ITEM (com IMAGEM e STATUS)

$sql = "CREATE TABLE IF NOT EXISTS ITEM (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    NOME VARCHAR(100) NOT NULL,
    DESCRICAO VARCHAR(255),
    STATUS VARCHAR(50) DEFAULT 'Achado',
    DATA_ENCONTRADO DATE,
    ID_LOCAL INT,
    IMAGEM VARCHAR(255),
    CONSTRAINT FK_LOCAL FOREIGN KEY (ID_LOCAL) REFERENCES LOCAIS(ID) ON DELETE CASCADE
) ENGINE=InnoDB";
if ($conexao->query($sql)) {
    echo " Tabela ITEM criada ou já existente.<br>";
} else {
    echo " Erro ao criar ITEM: " . $conexao->error . "<br>";
}


// TABELA: REIVINDICACAO

$sql = "CREATE TABLE IF NOT EXISTS REIVINDICACAO (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    NOME_REIVINDICACAO VARCHAR(100),
    CONTATO VARCHAR(100),
    MENSAGEM VARCHAR(255),
    DATA_REIVINDICACAO DATE,
    ID_ITEM INT,
    ID_USUARIO INT,
    CONSTRAINT FK_ITEM FOREIGN KEY (ID_ITEM) REFERENCES ITEM(ID) ON DELETE CASCADE,
    CONSTRAINT FK_USUARIO FOREIGN KEY (ID_USUARIO) REFERENCES USUARIOS(ID) ON DELETE CASCADE
) ENGINE=InnoDB";
if ($conexao->query($sql)) {
    echo " Tabela REIVINDICACAO criada ou já existente.<br>";
} else {
    echo " Erro ao criar REIVINDICACAO: " . $conexao->error . "<br>";
}


// INSERÇÃO DE USUÁRIOS PADRÃO

$sql_insert = "INSERT INTO USUARIOS (LOGIN, SENHA) VALUES 
('ADMIN', '123'),
('FELIPE ', '123'),
('LEONEL ', '123'),
('LUCAS', '123'),
('MATHEUS ', '123'),
('MURILLO ', '123')";

$check = $conexao->query("SELECT COUNT(*) as total FROM USUARIOS");
$row = $check->fetch_assoc();
if ($row['total'] == 0) {
    if ($conexao->query($sql_insert)) {
        echo " Usuários padrão inseridos com sucesso.<br>";
    } else {
        echo " Erro ao inserir usuários: " . $conexao->error . "<br>";
    }
} else {
    echo " Usuários já existem, inserção ignorada.<br>";
};
$conexao->close();
echo "<br><strong> Banco e tabelas criadas com sucesso!</strong>";
?>
