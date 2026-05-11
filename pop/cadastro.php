<?php
session_start(); // Ponto e vírgula adicionado

$error_message = isset($_SESSION['reg_error']) ? $_SESSION['reg_error']:"";
unset($_SESSION['reg_error']);
// ... (Restante do arquivo)
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cadrastro - blum</title>
    <style>
        /* ... COLOQUE AQUI TODO O CONTEÚDO DO SEU BLOCO <style> DO index.php ... */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background-color: #f4f7fc; display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100vh; margin: 0; background-image: url(js-de-nintendo-switch.jpg); background-size: cover; background-position: center; background-attachment: fixed; }
        .container { width: 100%; max-width: 400px; background-color: #fdfbfb; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); }
        .navbar-fixer { width: 100%; background-color: #4CAF50; padding: 10px 0; text-align: center; }
        .navbar-fixer .brand-logo { color: #fff; font-size: 24px; font-weight: bold; text-decoration: none; }
        h1 { font-size: 26px; color: #333; margin-bottom: 20px; text-align: center; }
        .input-field { margin-bottom: 20px; }
        .input-field label { display: block; font-size: 14px; color: #666; margin-bottom: 5px; }
        .input-field input { width: 100%; padding: 10px; font-size: 16px; border: 1px solid #ddd; border-radius: 4px; background-color: #f9f9f9; }
        .input-field input:focus { border-color: #4CAF50; outline: none; }
        .form-actions { text-align: center; }
        .form-actions button { background-color: #4CAF50; color: #fff; font-size: 16px; padding: 12px 20px; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s ease; }
        .form-actions button:hover { background-color: #45a049; }
        footer { text-align: center; margin-top: 30px; font-size: 12px; color: #777; }
        footer p { font-size: 14px; }
        @media (max-width: 600px) {
            .container { width: 90%; padding: 20px; }
            h1 { font-size: 22px; }
            .input-field input { padding: 8px; font-size: 14px; }
            .form-actions button { padding: 10px 18px; font-size: 14px; }
        }
        .error { color: red; text-align: center; margin-bottom: 15px; } /* Estilo para mensagens de erro */
  </style>
</head>
<body>
    <main>
        <div class="container">
            <h1>cadrastro de Usuário</h1>

            <?php if ($error_message): ?>
                <p class="error"><?= $error_message ?></p>
            <?php endif; ?>
            
            <form action="register.php" method="post">
                <div class="input-field">
                    <label for="login">login (Nome de Usuário):</label>
                    <input type="text" id="login" name="login" required>
            </div>
            
            <div class="input-field">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
                
                <div class="input-field">
                    <label for="confirmar_senha">Confirmar Senha:</label>
                    <input type="password" id="confirmar_senha" name="confirmar_senha" required>
                </div>

                <div class="form-actions">
                    <button type="submit">Cadastrar</button>
                </div>
            </form>
            <p style="text-align: center; margin-top: 15px;"><a href="index.php">Já tenho conta</a></p>
        </div>
    </main>

    <footer>
        <div class="container">
            <h1>Atenção</h1>
            <p>Para criar a senha, é necessário incluir números, letras e símbolos (Recomendação).</p>
        </div>
    </footer>
</body>
</html>
