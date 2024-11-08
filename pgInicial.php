<!DOCTYPE html>
<html>
<head>
    <title>Página Inicial</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Bem-vindo ao Consultório</h2>
    <p>Olá, <?php echo $_SESSION['nome']; ?>!</p>
    <nav>
        <ul>
            <li><a href="informacoes_consultorio.php">Informações do Consultório</a></li>
            <li><a href="perfil_paciente.php">Meu Perfil</a></li>
            <li><a href="agendar_consulta.php">Agendar Consulta</a></li>
            <li><a href="mensagens.php">Suporte</a></li>
        </ul>
    </nav>
</body>
</html>
