<?php

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("location: index.php");
    exit;
}

// Inclui o arquivo de conexão PDO
require 'conexao.php'; 

// Variável para armazenar mensagens de ação (exclusão bem-sucedida)
$mensagem = '';

// --- 1. Lógica de EXCLUSÃO ---
if (isset($_GET['acao']) && $_GET['acao'] == 'excluir' && isset($_GET['id'])) {
    $id_para_excluir = $_GET['id'];
    
    // Prepara a query SQL de Exclusão
    $sql_delete = "DELETE FROM produtos WHERE id = :id";
    
    try {
        $stmt_delete = $pdo->prepare($sql_delete);
        $stmt_delete->bindValue(':id', $id_para_excluir, PDO::PARAM_INT);
        $stmt_delete->execute();
        
        $mensagem = "Produto ID $id_para_excluir excluído com sucesso!";
        
    } catch (\PDOException $e) {
        $mensagem = "Erro ao excluir produto: " . $e->getMessage();
    }
}

// --- 2. Lógica de VISUALIZAÇÃO ---
// Consulta todos os produtos após qualquer exclusão
try {
    $stmt = $pdo->query('SELECT id, nome, preco, imagem_path FROM produtos ORDER BY id DESC');
    $produtos = $stmt->fetchAll();
} catch (\PDOException $e) {
    // Caso a tabela não exista ou haja erro de conexão
    $mensagem = "Erro ao carregar produtos: " . $e->getMessage();
    $produtos = []; // Garante que a variável esteja definida
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Admin - Gerenciar Produtos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { max-width: 900px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn-edit { background-color: #3b82f6; color: white; padding: 5px 10px; border-radius: 4px; text-decoration: none; font-size: 0.9em; }
        .btn-delete { background-color: #ef4444; color: white; padding: 5px 10px; border-radius: 4px; text-decoration: none; font-size: 0.9em; }
        .btn-delete:hover { background-color: #dc2626; }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-2xl font-bold mb-5">Gerenciar Produtos</h1>
        <a href="admin_adicionar.php" class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-green-600">
            + Adicionar Novo Produto
        </a>

        <?php if (!empty($mensagem)): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <?= htmlspecialchars($mensagem) ?>
            </div>
        <?php endif; ?>

        <?php if (count($produtos) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Imagem Path</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td><?= htmlspecialchars($produto['id']) ?></td>
                        <td><?= htmlspecialchars($produto['nome']) ?></td>
                        <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                        <td><?= htmlspecialchars($produto['imagem_path']) ?></td>
                        <td>
                            <a href="admin_editar.php?id=<?= $produto['id'] ?>" class="btn-edit">
                                Editar
                            </a>
                            <a href="admin_gerenciar.php?acao=excluir&id=<?= $produto['id'] ?>" 
                               onclick="return confirm('Tem certeza que deseja excluir este produto?')" 
                               class="btn-delete">
                                Excluir
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhum produto encontrado. Adicione um novo produto para começar.</p>
        <?php endif; ?>
    </div>
</body>
</html>