<?php 
session_start();
require 'conexao.php'; 

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("location: index.php");
    exit;
}

// Captura os dados do formulário (vêm do index.php)
$username = trim($_POST['Login'] ?? '');
$password = $_POST['senha'] ?? '';

// 1. Busca o usuário no banco
$sql = "SELECT username, password_hash FROM users WHERE username = :username";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

// 2. Verifica se o usuário existe
if ($user) {
    
    // 3. Verifica a senha criptografada
    if (password_verify($password, $user['password_hash'])) {
        // Login bem-sucedido
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $user['username']; 

        // ALTERADO: Redireciona para a página que você realmente tem
        header("location: admin_gerenciar.php"); 
        exit;
    }
}

// 4. Se falhar, volta para o index com mensagem de erro
$_SESSION['error'] = "Usuário ou senha inválidos.";
header("location: index.php");
exit;
?>