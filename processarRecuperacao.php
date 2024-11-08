<?php
require '../vendor/autoload.php'; // Inclua o autoload do Composer
include 'conexao.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$email = $_POST['email'];
$token = bin2hex(random_bytes(50));

$sql = "UPDATE usuario SET token='$token' WHERE email='$email'";

if ($conn->query($sql) === TRUE) {
    $resetLink = "http://seusite.com/resetarSenha.php?token=$token";

    // Configuração do PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Especifica o servidor SMTP principal (Gmail neste exemplo)
        $mail->SMTPAuth = true;
        $mail->Username = 'seuemail@gmail.com'; // Seu email Gmail
        $mail->Password = 'suasenha'; // Sua senha do Gmail
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Recipientes
        $mail->setFrom('seuemail@gmail.com', 'Seu Nome');
        $mail->addAddress($email); // Adiciona um destinatário

        // Conteúdo
        $mail->isHTML(true); // Define o formato do email para HTML
        $mail->Subject = 'Resetar Senha';
        $mail->Body    = "Clique no link para resetar sua senha: <a href='$resetLink'>$resetLink</a>";
        $mail->AltBody = "Clique no link para resetar sua senha: $resetLink"; // Texto alternativo para clientes sem suporte HTML

        $mail->send();
        echo 'Um email de recuperação foi enviado.';
    } catch (Exception $e) {
        echo 'Erro ao enviar email: ' . $mail->ErrorInfo;
    }
} else {
    echo "Erro ao processar pedido de recuperação.";
}

$conn->close();
?>
