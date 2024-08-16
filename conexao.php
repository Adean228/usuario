 <?php


define('HOST', '127.0.0.1');
define('USUARIO', 'root');
define('SENHA', '');
define('DB', 'app');

$conexao = new mysqli(HOST, USUARIO, SENHA, DB,);


if ($conexao->connect_error) {
    die('Não foi possível conectar: ' . $conexao->connect_error);
}
?>

