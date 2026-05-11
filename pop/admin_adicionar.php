<?php
session_start(); // Inicia a sessão
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("location: index.php");
    exit;
}

// Inclui o arquivo de conexão PDO
require 'conexao.php'; 

$mensagem_sucesso = '';
$mensagem_erro = '';

// Verifica se o formulário foi submetido
if (isset($_POST['submit'])) {
    
    // 1. Coleta e sanitiza os dados do formulário
    $nome = trim($_POST['nome']);
    $preco = $_POST['preco'];
    $imagem_path = trim($_POST['imagem_path']);
    $alt_text = trim($_POST['alt_text']);

    // 2. Prepara a query SQL de Inserção (INSERT)
    $sql = "INSERT INTO produtos (nome, preco, imagem_path, alt_text) VALUES (:nome, :preco, :imagem_path, :alt_text)";
            
    try {
        $stmt = $pdo->prepare($sql);

        // 3. Vincula os valores
        $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindValue(':preco', $preco);
        $stmt->bindValue(':imagem_path', $imagem_path, PDO::PARAM_STR);
        $stmt->bindValue(':alt_text', $alt_text, PDO::PARAM_STR);
        
        // 4. Executa a inserção
        $stmt->execute();

        $mensagem_sucesso = "Produto '$nome' adicionado com sucesso ao banco de dados!";
        
    } catch (\PDOException $e) {
        $mensagem_erro = "Erro ao adicionar produto: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Admin - Adicionar Produto</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        input, textarea { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background-color: #f10f0f; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #d10c0c; }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-2xl font-bold mb-5">Adicionar Novo Produto</h1>
        <a href="admin_gerenciar.php" class="bg-gray-500 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-gray-600">
            Voltar ao Gerenciador
        </a>
        
        <?php if (!empty($mensagem_sucesso)): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <?= htmlspecialchars($mensagem_sucesso) ?>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($mensagem_erro)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <?= htmlspecialchars($mensagem_erro) ?>
            </div>
        <?php endif; ?>
        
        <form action="admin_adicionar.php" method="POST">
            
            <label for="nome">Nome do Produto:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="preco">Preço (Ex: 199.90):</label>
            <input type="number" id="preco" name="preco" step="0.01" required>

            <label for="imagem_path">Caminho da Imagem:</label>
            <input type="text" id="imagem_path" name="imagem_path" placeholder="Ex: imagens/novo_jogo.jpg" required>

            <label for="alt_text">Texto Alternativo (Alt Text):</label>
            <input type="text" id="alt_text" name="alt_text" required>

            <button type="submit" name="submit">Adicionar Produto</button>
        </form>
    </div>
</body>
</html>