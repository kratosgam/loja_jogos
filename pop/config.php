<?php
// config.php

//Detalhes da Conexão
$servername = "localhost";
$db_username = "seu_usuário_do_banco"; //Ex: root
$db_password = "sua_senha_do_banco"; //Ex: (deixe em banco se for XAMPP/WAMP padrão)
$dbname = "nome_do_seu_banco"; //Ex: frem_db

//Cria a conexão
$conn = new mysqli($servername, $db_username, $db_password, $dbname)

//verifica a conexão
if ($conn->connect_error) {
    die("conexão falhou: " . $conn->connect_error);
}
?>

