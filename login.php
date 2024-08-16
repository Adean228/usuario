<?php
// Conectar ao banco de dados
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco_de_dados = 'app';

$conn = new mysqli($servidor, $usuario, $senha, $banco_de_dados);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Processar o formulário de login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["password"];

    // Aqui você deve fazer a validação da senha, isso é um exemplo básico
    $stmt = $conn->prepare("SELECT * FROM usuario WHERE email = ? AND senha = ?");
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login bem-sucedido
        header("Location: login.php");
        exit();
    } else {
        echo "<div class='alert alert-danger' role='alert'>Email ou senha incorretos.</div>";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">

 
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <div class="form-text"></div>
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
         
        </form>
        <div class="mt-3">
            <a href="esqueceu a senha">esqueceu a senha</a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>

</html>