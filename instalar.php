<?php

include "conexao.php";

$sql = "CREATE TABLE IF NOT EXISTS USUARIOS (
            ID INT PRIMARY KEY AUTO_INCREMENT,
            LOGIN VARCHAR(50) NOT NULL,
            SENHA VARCHAR(80) NOT NULL,
            ATIVO BIT DEFAULT 1
        );"
;$conexao->query($sql); $sql=
        "CREATE TABLE IF NOT EXISTS LOCAIS(
            ID INT PRIMARY KEY AUTO_INCREMENT,
            NOME_LOCAL VARCHAR(100)        
        );";
$conexao->query($sql); $sql=
        "CREATE TABLE IF NOT EXISTS ITEM (
            ID INT PRIMARY KEY AUTO_INCREMENT,
            NOME VARCHAR(100) NOT NULL,
            DESCRICAO VARCHAR(100),
            DATA_ENCONTRADO DATE,
            ID_LOCAL INT,
            CONSTRAINT FK_LOCAL FOREIGN KEY (ID_LOCAL) REFERENCES LOCAIS(ID)
        );";
        
$conexao->query($sql); $sql=
        "CREATE TABLE IF NOT EXISTS REINVIDICACAO(
            ID INT PRIMARY KEY AUTO_INCREMENT,
            NOME_REINVIDICACAO VARCHAR(100),
            CONTATO VARCHAR(100),
            DATA_REINVIDICACAO DATE,
            ID_ITEM INT,
            ID_USUARIO INT,
             CONSTRAINT FK_ITEM FOREIGN KEY (ID_ITEM)  REFERENCES ITEM(ID),
            CONSTRAINT FK_USUARIO FOREIGN KEY (ID_USUARIO) REFERENCES USUARIOS(ID)
        );";


if ($conexao->query($sql)) {
    echo "Tabela criada com sucesso.<br>";
} else {
    echo "Erro ao criar a tabela: " . $conexao->error . "<br>";
}


//////////////////////////// BLOCO PARA INSERIR USUARIO////////////////////////////
// Inserindo uma linha na tabela
$sql_insert = "INSERT INTO USUARIOS (LOGIN, SENHA) VALUES 
    ('ADMIN','123'),
    ('FELIPE MATHEUS YOSHIDA LAZARI', '123senha'),		
    ('LEONEL FRANCISCO DAMIAO', '123senha'),
    ('LUCAS MATHEUS DE SOUZA DOS SANTOS', '123senha'),
    ('MATHEUS DA CRUZ SAITU HIGA', '123senha'),
    ('MURILLO DE PAULA PEREIRA', '123senha')

    ;";


// Executando a inserção
if ($conexao->query($sql_insert)) {
    echo "Nova linha inserida com sucesso.<br>";
} else {
    echo "Erro ao inserir dados: " . $conexao->error . "<br>";
}
///////////////////////////FIM DO BLOCO PARA INSERIR USUARIO///////////////////////

// Fechando a conexão
$conexao->close();





?>