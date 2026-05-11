<?php
session_start();
require 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['login'] ?? '');
    $password = $_POST['senha'] ?? '';
    $confirm_password = $_POST['confirmar_senha'] ?? '';

    // Verifica se as senhas coincidem
    if ($password !== $confirm_password) {
        $_SESSION['reg_error'] = "As senhas não coincidem.";
        header("Location: cadastro.php");
        exit;
    }

    // Criptografa a senha para ser compatível com o seu login.php
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    try {
        $sql = "INSERT INTO users (username, password_hash) VALUES (:username, :password_hash)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':password_hash' => $password_hash
        ]);

        $_SESSION['error'] = "Cadastro realizado com sucesso! Faça login.";
        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Erro de duplicidade
            $_SESSION['reg_error'] = "Este nome de usuário já existe.";
        } else {
            $_SESSION['reg_error'] = "Erro ao cadastrar. Tente novamente.";
        }
        header("Location: cadastro.php");
        exit;
    }
}