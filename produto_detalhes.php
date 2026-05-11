<?php 
require 'conexao.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $produto = $stmt->fetch();

    if (!$produto) {
        die("Produto não encontrado");
    }
} else {
    header("location: p.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($produto['nome']) ?> - blum</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            background-image: url(js-de-nintendo-switch.jpg); /* Mesma imagem do seu login */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 800px;
            background-color: #fdfbfb;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
        }

        .produto-imagem {
            flex: 1;
            min-width: 300px;
        }

        .produto-imagem img {
            width: 100%;
            border-radius: 8px;
            border: 2px solid #ddd;
        }

        .produto-info {
            flex: 1;
            min-width: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        h1 {
            color: #333;
            margin-bottom: 15px;
            font-size: 28px;
        }

        .preco {
            font-size: 32px;
            color: #28a745; /* Verde do seu tema */
            font-weight: bold;
            margin-bottom: 20px;
        }

        .btn-comprar {
            background-color: #28a745;
            color: white;
            padding: 15px 25px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background 0.3s;
        }

        .btn-comprar:hover {
            background-color: #218838;
        }

        .voltar {
            margin-top: 20px;
            display: inline-block;
            color: #666;
            text-decoration: none;
            font-size: 14px;
        }

        .voltar:hover { text-decoration: underline; }
    </style>
</head>
<body>
    
<div class="container">
        <div class="produto-imagem">
            <img src="<?= htmlspecialchars($produto['imagem_path']) ?>" alt="<?= htmlspecialchars($produto['alt_text']) ?>">
        </div>

        <div class="produto-info">
            <h1><?= htmlspecialchars($produto['nome']) ?></h1>
            <p class="preco">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
            
            <a href="#" class="btn-comprar">Adicionar ao Carrinho</a>
            
            <a href="p.php" class="voltar">← Voltar para a loja</a>
        </div>
    </div>

</body>
</html>