<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login e Cadastro</title>
    <link href="styles.css" rel="stylesheet">

  
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="form-box" id="login-box">
                <h2>Login</h2>
                <form action="#">
                    <div class="input-group">
                        <label for="login-email">Email:</label>
                        <input type="email" id="login-email" name="login-email" required>
                    </div>
                    <div class="input-group">
                        <label for="login-password">Senha:</label>
                        <input type="password" id="login-password" name="login-password" required>
                    </div>
                    <button type="submit">Entrar</button>
                    <p class="switch-form" onclick="switchForm()">Ainda não tem uma conta? Cadastre-se</p>
                </form>
            </div>
            <div class="form-box inactive" id="register-box">
                <h2>Cadastro</h2>
                <form action="#">
                    <div class="input-group">
                        <label for="register-name">Nome:</label>
                        <input type="text" id="register-name" name="register-name" required>
                    </div>
                    <div class="input-group">
                        <label for="register-email">Email:</label>
                        <input type="email" id="register-email" name="register-email" required>
                    </div>
                    <div class="input-group">
                        <label for="register-password">Senha:</label>
                        <input type="password" id="register-password" name="register-password" required>
                    </div>
                    <button type="submit">Cadastrar</button>
                    <p class="switch-form" onclick="switchForm()">Já tem uma conta? Faça login</p>
                </form>
            </div>
        </div>
    </div>

    <script>
        function switchForm() {
            document.getElementById('login-box').classList.toggle('inactive');
            document.getElementById('register-box').classList.toggle('inactive');
        }
    </script>
</body>
</html>
