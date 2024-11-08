<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha</title>
</head>
<body>
    <h2>Recuperar sua senha</h2>
    <section>
        <form action="processarRecuperacao.php" method="POST">
            <div class="campos">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Digite seu Email:" required>
            </div>
            <div class="campos">
                <input type="submit" value="Emviar">
            </div>
        </form>
    </section>
</body>
</html>