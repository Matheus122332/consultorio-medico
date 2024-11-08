<!DOCTYPE html>
<html>
<head>
    <title>Redefinir Senha</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Redefinir Senha</h2>
    <form action="processarRedefinicao.php" method="POST">
        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
        Nova Senha: <input type="password" name="senha" required><br>
        Confirmar Senha: <input type="password" name="confirmar_senha" required><br>
        <input type="submit" value="Redefinir">
    </form>
</body>
</html>
