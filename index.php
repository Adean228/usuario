<?php
session_start();
require 'conexao.php'; // Inclua a conexão com o banco de dados, se necessário
// require "perfil.php";

?>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Início - Estética Automotiva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="styles.css" rel="stylesheet">

 
   
</head>
<body>

    <?php include('navbar.php'); 
 
    ?>

    <div class="container mt-4">
        <?php if (isset($_GET['mensagem']) && $_GET['mensagem'] === 'logout'): ?>
            <div class="alert alert-info">
                Você foi desconectado com sucesso.
            </div>
        <?php endif; ?>

        
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  
</body>
</html>
