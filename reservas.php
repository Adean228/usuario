<?php
// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "serviço";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Processar o formulário de reserva
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $servico = $_POST["servico"]; // Nome ajustado para corresponder ao HTML
    $data_reserva = $_POST["data_reserva"]; // Nome ajustado para corresponder ao HTML

    // Preparar e vincular
    $stmt = $conn->prepare("INSERT INTO reservas (nome, email, telefone, servico, data_reserva) VALUES (?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Erro na preparação da consulta: " . $conn->error);
    }

    $stmt->bind_param("sssss", $nome, $email, $telefone, $servico, $data_reserva); // 'sssss' indica que todas as variáveis são strings

    // Executar e verificar sucesso
    if ($stmt->execute()) {
        echo "<div class='alert alert-success' role='alert'>Reserva adicionada com sucesso!</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Erro ao adicionar reserva: " . $stmt->error . "</div>";
    }
    $stmt->close();
}

// Buscar reservas
$sql = "SELECT id, nome, email, telefone, servico, data_reserva FROM reservas ORDER BY data_reserva DESC";
$result = $conn->query($sql);

if (!$result) {
    die("Erro na consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Estética Automotiva</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Início</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Formulário para adicionar novas reservas -->
        <div class="reservation-form">
            <h3>Reserve sua Vaga</h3>
            <form action="reservas.php" method="post">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome Completo</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="tel" class="form-control" id="telefone" name="telefone" required>
                </div>
                <div class="mb-3">
                    <label for="data_reserva" class="form-label">Data Desejada</label>
                    <input type="date" class="form-control" id="data_reserva" name="data_reserva" required>
                </div>
                <div class="mb-3">
                    <label for="servico" class="form-label">Serviço Desejado</label>
                    <select class="form-select" id="servico" name="servico" required>
                        <option value="" disabled selected>Escolha um serviço</option>
                        <option value="lavagem">Lavagem Completa</option>
                        <option value="polimento">Polimento e Enceramento</option>
                        <option value="pintura">Correção de Pintura</option>
                        <option value="protecao">Proteção Solar</option>
                        <option value="inspecao">Inspeção e Manutenção</option>
                        <option value="detalhamento">Detalhamento para Transporte</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Reservar</button>
            </form>
        </div>

        <!-- Lista de reservas -->
        <div>
            <h2>Reservas Existentes</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Serviço</th>
                        <th>Data da Reserva</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row["id"]) . "</td>
                                    <td>" . htmlspecialchars($row["nome"]) . "</td>
                                    <td>" . htmlspecialchars($row["email"]) . "</td>
                                    <td>" . htmlspecialchars($row["telefone"]) . "</td>
                                    <td>" . htmlspecialchars($row["servico"]) . "</td>
                                    <td>" . date("d/m/Y", strtotime($row["data_reserva"])) . "</td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Nenhuma reserva encontrada</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>

</html>
