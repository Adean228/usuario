<?php
session_start();
require 'conexao.php'; // Inclua a conexão com o banco de dados

// Função para redirecionar com uma mensagem
function redirecionar($url, $mensagem) {
    $_SESSION['mensagem'] = $mensagem;

    exit();
}

// Ação para adicionar um novo usuário
if (isset($_POST['add_usuario'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $data_nascimento = $_POST['data_nascimento'];
    $cpf = $_POST['cpf'];
 

    // Sanitize inputs
    $nome = mysqli_real_escape_string($conexao, $nome);
    $email = mysqli_real_escape_string($conexao, $email);
    $senha = mysqli_real_escape_string($conexao, $senha);
    $data_nascimento = mysqli_real_escape_string($conexao, $data_nascimento);
    $cpf = mysqli_real_escape_string($conexao, $cpf);
    $lavagens = mysqli_real_escape_string($conexao, $lavagens);

    // Hash password
    $senha_hash = sha1($senha);

    // Check if email already exists
    $check_email_sql = "SELECT * FROM usuario WHERE Email='$email'";
    $check_email_result = mysqli_query($conexao, $check_email_sql);
    if (mysqli_num_rows($check_email_result) > 0) {
        redirecionar('usuario-create.php', 'O email já está em uso.');
    } else {
        // Insert new user
        $sql = "INSERT INTO usuario (Nome, Email, Senha, Data_Nascimento, CPF, Lavagens, endereco, horario, telefone, ) VALUES ('$nome', '$email', '$senha_hash', '$data_nascimento', '$cpf', '$lavagens', '$endereco', '$horario', '$telefone')";
        if (mysqli_query($conexao, $sql)) {
            redirecionar('usuario-create.php', 'Cadastro realizado com sucesso!');
        } else {
            redirecionar('usuario-create.php', 'Erro ao cadastrar o usuário: ' . mysqli_error($conexao));
        }
    }
}

// Ação para editar um usuário
if (isset($_POST['edit_usuario'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['data_nascimento'];
    $cpf = $_POST['cpf'];


    // Sanitize inputs
    $id = mysqli_real_escape_string($conexao, $id);
    $nome = mysqli_real_escape_string($conexao, $nome);
    $email = mysqli_real_escape_string($conexao, $email);
    $data_nascimento = mysqli_real_escape_string($conexao, $data_nascimento);
    $cpf = mysqli_real_escape_string($conexao, $cpf);


    // Update user
    $sql = "UPDATE usuario SET Nome='$nome', Email='$email', Data_Nascimento='$data_nascimento', CPF='$cpf', Lavagens='$lavagens' WHERE id='$id'";
    if (mysqli_query($conexao, $sql)) {
        redirecionar('usuario-view.php?id=' . $id, 'Dados atualizados com sucesso!');
    } else {
        redirecionar('usuario-edit.php?id=' . $id, 'Erro ao atualizar o usuário: ' . mysqli_error($conexao));
    }
}

// Ação para excluir um usuário
if (isset($_POST['delete_usuario'])) {
    $id = $_POST['delete_usuario'];

    // Sanitize input
    $id = mysqli_real_escape_string($conexao, $id);

    // Delete user
    $sql = "DELETE FROM usuario WHERE id='$id'";
    if (mysqli_query($conexao, $sql)) {
        redirecionar('index.php', 'Usuário excluído com sucesso!');
    } else {
        redirecionar('index.php', 'Erro ao excluir o usuário: ' . mysqli_error($conexao));
    }
}

// Ação para adicionar uma reserva
if (isset($_POST['add_reservas'])) {
    $usuario_id = $_POST['usuario_id'];
    $data_reserva = $_POST['data_reserva'];
    $horario = $_POST['horario'];
    $servico = $_POST['serviço'];

    // Sanitize inputs
    $usuario_id = mysqli_real_escape_string($conexao, $usuario_id);
    $data_reserva = mysqli_real_escape_string($conexao, $data_reserva);
    $horario = mysqli_real_escape_string($conexao, $horario);
    $servico = mysqli_real_escape_string($conexao, $serviço);

    // Insert reservation
    $sql = "INSERT INTO reservas (usuario_id, data_reserva, horario, servico) VALUES ('$usuario_id', '$data_reserva', '$horario', '$servico')";
    if (mysqli_query($conexao, $sql)) {
        redirecionar('reservas.php', 'Reserva realizada com sucesso!');
    } else {
        redirecionar('reservas.php', 'Erro ao realizar a reservas: ' . mysqli_error($conexao));
    }
}

// Ação para excluir uma reserva
if (isset($_POST['delete_reserva'])) {
    $id = $_POST['delete_reserva'];

    // Sanitize input
    $id = mysqli_real_escape_string($conexao, $id);

    // Delete reservation
    $sql = "DELETE FROM reservas WHERE id='$id'";
    if (mysqli_query($conexao, $sql)) {
        redirecionar('index.php', 'Reservas excluída com sucesso!');
    } else {
        redirecionar('index.php', 'Erro ao excluir a reserva: ' . mysqli_error($conexao));
    }
}
?>
