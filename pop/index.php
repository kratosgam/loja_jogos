<?php
session_start();

$error_message = isset($_SESSION['error']) ? $_SESSION['error']:"";
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>blum</title>
    <style>
        /* Resetando margens e preenchimentos */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Corpo da página */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url(js-de-nintendo-switch.jpg);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        /* Centralizando conteúdo do formulário */
        .container {
            width: 100%;
            max-width: 400px;
            background-color: #fdfbfb;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Estilos da navbar */
        .navbar-fixer {
            width: 100%;
            background-color: #4CAF50;
            padding: 10px 0;
            text-align: center;
        }

        .navbar-fixer .brand-logo {
            color: #fff;
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
        }

        /* Títulos */
        h1 {
            font-size: 26px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        /* ESTILO DA MENSAGEM DE ERRO (Agora fora da media query para funcionar em tudo) */
      .error {
        color: #ff0000;
        background-color: #ffe6e6;
        padding: 10px;
        border-radius: 4px;
        border: 1px solid #ffcccc;
        text-align: center;
        margin-bottom: 15px;
        font-size: 14px;
        font-weight: bold;
      }
        /* Estilos do formulário */
        .input-field {
            margin-bottom: 20px;
        }

        .input-field label {
            display: block;
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }

        .input-field input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
        }

        .input-field input:focus {
            border-color: #4CAF50;
            outline: none;
        }

        /* Botão de submit */
        .form-actions {
            text-align: center;
        }

        .form-actions button {
            background-color: #4CAF50;
            color: #fff;
            font-size: 16px;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%; // Botão ocupa toda a largura do container
            transition: background-color 0.3s ease;
        }

        .form-actions button:hover {
            background-color: #45a049;
        }

        /* Estilo do rodapé */
        footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #777;
        }

        footer p {
            font-size: 14px;
        }

        /* Media query para dispositivos pequenos */
        @media (max-width: 600px) {
            /* Ajusta o tamanho do container em telas pequenas */
            .container {
                width: 90%;
                padding: 20px;
            }

            /* Ajusta o tamanho da fonte dos títulos */
            h1 {
                font-size: 22px;
            }

            .input-field input {
                padding: 8px;
                font-size: 14px;
            }

            .form-actions button {
                padding: 10px 18px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <main>
        <div class="container">
            <h1>Login</h1>
               
            <?php if ($error_message): ?>
                <p class="error"><?= $error_message ?></p>
            <?php endif; ?>    

            <form action="login.php" method="post">
                <div class="input-field">
                    <label for="Login">Login:</label>
                    <input type="text" id="Login" name="Login" required>
                </div>

                <div class="input-field">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>

                <div class="form-actions">
                    <button type="submit">Entrar</button>
                </div>
            </form>
            <p style="text-align: center; margin-top: 15px;"><a href="cadastro.php">ainda não tem conta? cadrastre-se</a></p> 
        </div>
    </main>

    <footer>
        <div class="container">
            <h1>Atenção</h1>
            <p>Para criar a senha, é necessário incluir números, letras e símbolos.</p>
        </div>
    </footer>
</body>
</html>
