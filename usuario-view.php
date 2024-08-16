<?php
session_start();
require 'conexao.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$usuario_id = $_GET['id'];
$sql = "SELECT * FROM usuario WHERE id='$usuario_id'";
$result = mysqli_query($conexao, $sql);
$usuario = mysqli_fetch_assoc($result);

if (!$usuario) {
    echo "Usuário não encontrado.";
    exit();
}
?>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visualizar Usuário - Estética Automotiva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">

        
</head>
<body>

<?php include('navbar.php'); ?>

<div class="usuario-view-container">
    <h1>Detalhes do Usuário</h1>
    <p><strong>Nome:</strong> <?php echo htmlspecialchars($usuario['Nome']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario['Email']); ?></p>
    <p><strong>Data de Nascimento:</strong> <?php echo htmlspecialchars($usuario['Data_Nascimento']); ?></p>
    <p><strong>CPF:</strong> <?php echo htmlspecialchars($usuario['CPF']); ?></p>
    <a href="perfil.php" class="btn btn-primary">Voltar</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
