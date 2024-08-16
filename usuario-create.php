<?php
session_start();
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $data_nascimento = $_POST['data_nascimento'];
    $cpf = $_POST['cpf'];
    // $lavagens = $_POST['lavagens'];

    // Sanitize inputs
    $nome = mysqli_real_escape_string($conexao, $nome);
    $email = mysqli_real_escape_string($conexao, $email);
    $data_nascimento = mysqli_real_escape_string($conexao, $data_nascimento);
    $cpf = mysqli_real_escape_string($conexao, $cpf);
    $senha = mysqli_real_escape_string($conexao, $senha);
    // $lavagens = mysqli_real_escape_string($conexao, $lavagens);

    // Hash password
    $senha = sha1($senha);

    // Check if email already exists
    $check_email_sql = "SELECT * FROM usuario WHERE Email='$email'";
    $check_email_result = mysqli_query($conexao, $check_email_sql);
    if (mysqli_num_rows($check_email_result) > 0) {
        $error = "O email já está em uso.";
    } else {
        // Insert new user
        $sql = "INSERT INTO usuario (nome, email, senha, data_nascimento, cpf) VALUES ('$nome', '$email', '$senha', '$data_nascimento', '$cpf')";
        if (mysqli_query($conexao, $sql)) {
            $success = "Cadastro realizado com sucesso! Você pode fazer login agora.";
        } else {
            $error = "Erro ao cadastrar o usuário: " . mysqli_error($conexao);
        }
    }
}
?>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro - Estética Automotiva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">

   
</head>
<body>

<?php include('navbar.php'); ?>

<div class="cadastro-container">
    <h1>Cadastro</h1>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
    <?php elseif (isset($success)): ?>
        <div class="alert alert-success">
            <?php echo $success; ?>
        </div>
    <?php endif; ?>

    <form action="usuario-create.php" method="POST">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
        </div>
        <div class="mb-3">
            <label for="data_nascimento" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
        </div>
        <div class="mb-3">
            <label for="cpf" class="form-label">CPF</label>
            <input type="text" class="form-control" id="cpf" name="cpf" required>
        </div>
       
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
