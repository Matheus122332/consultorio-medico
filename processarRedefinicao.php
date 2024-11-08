<?php
include 'conexao.php';

$token = $_POST['token'];
$senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);

if ($_POST['senha'] !== $_POST['confirmar_senha']) {
    echo "As senhas não coincidem.";
    exit();
}

$sql = "UPDATE usuarios SET senha='$senha', token=NULL WHERE token='$token'";

if ($conn->query($sql) === TRUE) {
    echo "Senha redefinida com sucesso!";
    // Redirecionar para a página de login
    header("Location: login.php");
    exit();
} else {
    echo "Erro ao redefinir a senha: " . $conn->error;
}

$conn->close();
?>
