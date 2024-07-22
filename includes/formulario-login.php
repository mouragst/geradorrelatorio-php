<?php
$alertLogin = !empty($alertLogin) ? '<div class="alert alert-danger">'.$alertLogin.'</div>' : '';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Link para o CSS do Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .login-container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
        }

        .form-control {
            height: 50x;
            width: 350px; /* Aumenta a altura dos campos */
            font-size: 16px; /* Aumenta o tamanho da fonte dos campos */
        }

        .btn-primary {
            width: 100%; /* Faz com que o botão ocupe toda a largura disponível */
            height: 50px; /* Ajusta a altura do botão */
            font-size: 16px; /* Aumenta o tamanho da fonte do botão */
        }

        .form-label {
            text-align: center; /* Centraliza o texto da label */
            display: block; /* Faz com que a label ocupe toda a largura disponível */
        }
    </style>
</head>
<body class="bg-secondary d-flex justify-content-center align-items-center vh-100">
    <div class="login-container bg-dark text-light rounded">
        <form method="post">
            <h2 class="text-center mb-4">Login</h2>

            <?= $alertLogin; ?>

            <div class="form-group">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" id="email" name="email" class="form-control form-control-lg" required>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Senha</label>
                <input type="password" id="password" name="password" class="form-control form-control-lg" required>
            </div>

            <div class="form-group mt-4">
                <button class="btn btn-primary" type="submit" name="acao" value="logar">Logar</button>
            </div>
        </form>
    </div>

    <!-- Scripts do Bootstrap e dependências -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

