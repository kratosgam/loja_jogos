<?php
session_start(); // Inicia a sessão
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("location: index.php");
    exit;
}
// Inclui o arquivo de conexão PDO
require 'conexao.php'; 

$produto = null;
$mensagem = '';

// --- 1. Lógica de CARREGAMENTO (GET) ---
// Verifica se um ID foi fornecido na URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_produto = $_GET['id'];
    
    // Prepara a consulta para buscar o produto pelo ID
    $sql_fetch = "SELECT id, nome, preco, imagem_path, alt_text FROM produtos WHERE id = :id";
    
    try {
        $stmt_fetch = $pdo->prepare($sql_fetch);
        $stmt_fetch->bindValue(':id', $id_produto, PDO::PARAM_INT);
        $stmt_fetch->execute();
        
        $produto = $stmt_fetch->fetch(); // Obtém os dados do produto
        
        // Se o produto não for encontrado, redireciona para a lista
        if (!$produto) {
            header('Location: admin_gerenciar.php');
            exit;
        }
        
    } catch (\PDOException $e) {
        $mensagem = "Erro ao carregar dados do produto: " . $e->getMessage();
    }
} else {
    // Se o ID não foi fornecido, redireciona para a lista
    header('Location: admin_gerenciar.php');
    exit;
}

// --- 2. Lógica de ATUALIZAÇÃO (POST) ---
if (isset($_POST['submit'])) {
    
    // Coleta e sanitiza os dados do formulário
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $imagem_path = $_POST['imagem_path'];
    $alt_text = $_POST['alt_text'];

    // Prepara a query SQL de Atualização (UPDATE)
    $sql_update = "UPDATE produtos SET 
                    nome = :nome, 
                    preco = :preco, 
                    imagem_path = :imagem_path, 
                    alt_text = :alt_text 
                   WHERE id = :id";
    
    try {
        $stmt_update = $pdo->prepare($sql_update);

        // Vincula os valores
        $stmt_update->bindValue(':nome', $nome, PDO::PARAM_STR);
        $stmt_update->bindValue(':preco', $preco, PDO::PARAM_STR); 
        $stmt_update->bindValue(':imagem_path', $imagem_path, PDO::PARAM_STR);
        $stmt_update->bindValue(':alt_text', $alt_text, PDO::PARAM_STR);
        $stmt_update->bindValue(':id', $id, PDO::PARAM_INT);
        
        // Executa a atualização
        $stmt_update->execute();

        // Atualiza a variável $produto para mostrar os novos dados no formulário
        $produto['nome'] = $nome;
        $produto['preco'] = $preco;
        $produto['imagem_path'] = $imagem_path;
        $produto['alt_text'] = $alt_text;


        $mensagem = "Produto '$nome' atualizado com sucesso!";
        
    } catch (\PDOException $e) {
        $mensagem = "Erro ao atualizar produto: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Admin - Editar Produto</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        input, textarea { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background-color: #f10f0f; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #d10c0c; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-2xl font-bold mb-5">Editar Produto (ID: <?= htmlspecialchars($produto['id']) ?>)</h1>

        <?php if (!empty($mensagem)): ?>
            <div class="px-4 py-3 rounded relative mb-4 <?= (strpos($mensagem, 'sucesso') !== false) ? 'alert-success' : 'alert-error' ?>" role="alert">
                <?= htmlspecialchars($mensagem) ?>
            </div>
        <?php endif; ?>

        <form action="admin_editar.php?id=<?= $produto['id'] ?>" method="POST">
            
            <input type="hidden" name="id" value="<?= htmlspecialchars($produto['id']) ?>">
            
            <label for="nome">Nome do Produto:</label>
            <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required>

            <label for="preco">Preço (Ex: 199.90):</label>
            <input type="number" id="preco" name="preco" step="0.01" value="<?= htmlspecialchars($produto['preco']) ?>" required>

            <label for="imagem_path">Caminho da Imagem:</label>
            <input type="text" id="imagem_path" name="imagem_path" value="<?= htmlspecialchars($produto['imagem_path']) ?>" required>

            <label for="alt_text">Texto Alternativo (Alt Text):</label>
            <input type="text" id="alt_text" name="alt_text" value="<?= htmlspecialchars($produto['alt_text']) ?>" required>

            <button type="submit" name="submit">Salvar Alterações</button>
            <a href="admin_gerenciar.php" class="bg-gray-500 text-white px-4 py-2 rounded ml-2 inline-block hover:bg-gray-600">Voltar</a>
        </form>
    </div>
</body>
</html>