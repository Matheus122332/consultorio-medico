<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Faça seu login</h2>
    <section>
        <form action="processarLogin" method="post">
         <div class="campo">
            <label for="senha">Email:</label>
            <input type="email" id="email" name="email" placeholder="Digite seu email" required>
         </div>
         <div class="campos">
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" placeholder="senha" required>
         </div>  
         <input type="submit" value="Login">
        </form>
        <p>Não tem conta?<a href="criarConta.php"> Criar Conta</a></p>
        <a href="recuperarSenha.php">Esqueceu a Senha?</a>
    </section>
</body>
</html>