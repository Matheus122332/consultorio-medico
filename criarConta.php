<?php 
session_start(); 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Criar Conta</title>
</head>
<body>
    <!--Formulario para criar conta -->
    <section id="criarconta" class="formulario" aria-labelledby="form-title">
        <!-- Mensagem de erro --> 
        <?php
        if (isset($_SESSION['mensagemErro'])):
        ?>
            <div id="mensagemErro" class="mensagem-erro" role="alert"> 
                <?= htmlspecialchars($_SESSION['mensagemErro']) ?> 
            </div> 
        <?php unset($_SESSION['mensagemErro']); // Remove a mensagem de erro após exibi-la 
        endif; 
        ?>    
        <div class="titulo-login">
            <h1 id="form-title">Cadastrar-se:</h1>
        </div>
        <div>
            <form id="criarConta" action="criarCnt.php" method="POST">
                <div class="campos">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" placeholder="Digite seu nome completo:" required value="<?= htmlspecialchars($_SESSION['nome'] ?? '') ?>" aria-required="true">
                </div>
                <div class="campos">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Digite seu email:" required value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>" aria-required="true">
                </div>
                <div class="campos">
                    <label for="idade">Idade:</label>
                    <input type="number" name="idade" id="idade" placeholder="Idade:" required value="<?= htmlspecialchars($_SESSION['idade'] ?? '') ?>" aria-required="true">
                </div>
                <div class="campos">
                    <label for="fone">Telefone:</label>
                    <input type="tel" name="fone" id="fone" placeholder="Digite seu telefone:" required value="<?= htmlspecialchars($_SESSION['fone'] ?? '') ?>" aria-required="true">
                    <div id="rgError" class="erro-mensagem" aria-live="polite"></div>
                </div>
                <div class="campos">
                    <label for="rg">RG:</label>
                    <input type="text" name="rg" id="rg" placeholder="Digite seu rg:" required value="<?= htmlspecialchars($_SESSION['rg'] ?? '') ?>" aria-required="true">
                </div>
                <div class="campos">
                    <label for="cpf">CPF:</label>
                    <input type="text" name="cpf" id="cpf" placeholder="Digite seu cpf:" required value="<?= htmlspecialchars($_SESSION['cpf'] ?? '') ?>" aria-required="true">
                    <div id="cpfError" class="erro-mensagem" aria-live="polite"></div>
                </div>
                <div class="campos">
                    <label for="estado">Estado:</label>
                    <select id="estado" name="estado" placeholder="Selecione seu estado:" required aria-required="true">
                        <option value="AC" <?= (isset($_SESSION['estado']) && $_SESSION['estado'] == 'AC') ? 'selected' : '' ?>>Acre</option>
                        <option value="AL" <?= (isset($_SESSION['estado']) && $_SESSION['estado'] == 'AL') ? 'selected' : '' ?>>Alagoas</option>
                        <option value="AP" <?= (isset($_SESSION['estado']) && $_SESSION['estado'] == 'AP') ? 'selected' : '' ?>>Amapá</option>
                        <option value="AM" <?= (isset($_SESSION['estado']) && $_SESSION['estado'] == 'AM') ? 'selected' : '' ?>>Amazonas</option>
                        <option value="BA" <?= (isset($_SESSION['estado']) && $_SESSION['estado'] == 'BA') ? 'selected' : '' ?>>Bahia</option>
                        <option value="CE" <?= (isset($_SESSION['estado']) && $_SESSION['estado'] == 'CE') ? 'selected' : '' ?>>Ceará</option>
                        <option value="DF" <?= (isset($_SESSION['estado']) && $_SESSION['estado'] == 'DF') ? 'selected' : '' ?>>Distrito Federal</option>
                        <option value="ES" <?= (isset($_SESSION['estado']) && $_SESSION['estado'] == 'ES') ? 'selected' : '' ?>>Espírito Santo</option>
                        <option value="GO" <?= (isset($_SESSION['estado']) && $_SESSION['estado'] == 'GO') ? 'selected' : '' ?>>Goiás</option>
                        <option value="MA" <?= (isset($_SESSION['estado']) && $_SESSION['estado'] == 'MA') ? 'selected' : '' ?>>Maranhão</option>
                        <option value="MT" <?= (isset($_SESSION['estado']) && $_SESSION['estado'] == 'MT') ? 'selected' : '' ?>>Mato Grosso</option>
                        <option value="MS" <?= (isset($_SESSION['estado']) && $_SESSION['estado'] == 'MS') ? 'selected' : '' ?>>Mato Grosso do Sul</option>
                        <option value="MG" <?= (isset($_SESSION['estado']) && $_SESSION['estado'] == 'MG') ? 'selected' : '' ?>>Minas Gerais</option>
                        <option value="PA" <?= (isset($_SESSION['estado']) && $_SESSION['estado'] == 'PA') ? 'selected' : '' ?>>Pará</option>
                        <option value="PB" <?= (isset($_SESSION['estado']) && $_SESSION['estado'] == 'PB') ? 'selected' : '' ?>>Paraíba</option>
                        <option value="PR" <?= (isset($_SESSION['estado']) && $_SESSION['estado'] == 'PR') ? 'selected' : '' ?>>Paraná</option>
                        <option value="PE" <?= (isset($_SESSION['estado']) && $_SESSION['estado'] == 'PE') ? 'selected' : '' ?>>Pernambuco</option>
                        <option value="PI" <?= (isset($_SESSION['estado']) && $_SESSION['estado'] == 'PI') ? 'selected' : '' ?>>Piauí</option>
                        <option value="RJ" <?= (isset($_SESSION['estado']) && $_SESSION['estado'] == 'RJ') ? 'selected' : '' ?>>Rio de Janeiro</option>
                        <option value="RN" <?= (isset($_SESSION['estado']) && $_SESSION['estado'] == 'RN') ? 'selected' : '' ?>>Rio Grande do Norte</option>
                        <option value="RS" <?= (isset($_SESSION['estado']) && $_SESSION['estado'] == 'RS') ? 'selected' : '' ?>>Rio Grande do Sul</option>
                        <option value="RO" <?= (isset($_SESSION['estado']) && $_SESSION['estado'] == 'RO') ? 'selected' : '' ?>>Rondônia</option>
                        <option value="RR" <?= (isset($_SESSION['estado']) && $_SESSION['estado'] == 'RR') ? 'selected' : '' ?>>Roraima</option>
                        <option value="SC" <?= (isset($_SESSION['estado']) && $_SESSION['estado'] == 'SC') ? 'selected' : '' ?>>Santa Catarina</option>
                        <option value="SP" <?= (isset($_SESSION['estado']) && $_SESSION['estado'] == 'SP') ? 'selected' : '' ?>>São Paulo</option>
                        <option value="SE" <?= (isset($_SESSION['estado']) && $_SESSION['estado'] == 'SE') ? 'selected' : '' ?>>Sergipe</option>
                        <option value="TO" <?= (isset($_SESSION['estado']) && $_SESSION['estado'] == 'TO') ? 'selected' : '' ?>>Tocantins</option>
                    </select>
                </div>
                <div class="campos">
                    <label for="cep">Cep:</label> 
                    <input type="text" id="cep" name="cep" placeholder="Digite seu cep:" required value="<?= htmlspecialchars($_SESSION['cep'] ?? '') ?>" pattern="\d{5}-\d{3}" title="Formato esperado: 12345-678" aria-required="true">
                </div>
                 <div class="campos">
                    <label for="cidade">Cidade:</label> 
                    <input type="text" id="cidade" name="cidade" placeholder="Digite sua cidade:" required value="<?= htmlspecialchars($_SESSION['cidade'] ?? '') ?>" aria-required="true">
                </div> 
                <div class="campos">
                    <label for="rua">Rua:</label> 
                    <input type="text" id="rua" name="rua" placeholder="Digite sua rua:" required value="<?= htmlspecialchars($_SESSION['rua'] ?? '') ?>" aria-required="true">
                </div>
                <div class="campos">
                    <label for="bairro">Bairro:</label> 
                    <div class="campos">
                    <label for="bairro">Bairro:</label> 
                    <input type="text" id="bairro" name="bairro" placeholder="Digite seu bairro:" required value="<?= htmlspecialchars($_SESSION['bairro'] ?? '') ?>" aria-required="true">
                </div>
                <div class="campos">
                    <label for="numero-casa">Número da Casa:</label> 
                    <input type="text" id="numero-casa" name="numero-casa" placeholder="Digite numero-casa:" required value="<?= htmlspecialchars($_SESSION['numero-casa'] ?? '') ?>" aria-required="true"> 
                </div>
                <div class="campos">
                    <label for="tipo-residencia">Tipo de Residência:</label> 
                    <select id="tipo-residencia" name="tipo-residencia" aria-placeholder="Seleciona sua residência:" required aria-required="true">
                        <option value="casa" <?= (isset($_SESSION['tipo-residencia']) && $_SESSION['tipo-residencia'] == 'Casa') ? 'selected' : '' ?>>Casa</option> 
                        <option value="apartamento" <?= (isset($_SESSION['tipo-residencia']) && $_SESSION['tipo-residencia'] == 'Apartamento') ? 'selected' : '' ?>>Apartamento</option>
                    </select>
                </div>
                <div class="campos">
                    <label for="senha">Senha:</label> 
                    <input type="password" id="senha" name="senha" placeholder="Crie uma senha: (mínimo 8 caracteres)" pattern="(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{8,}" title="A senha deve ter pelo menos 8 caracteres, incluindo uma letra maiúscula, um número e um caractere especial." required aria-required="true">
                </div>
                <div class="campos"> 
                    <label for="confirmar_senha">Confirmar Senha:</label> 
                    <input type="password" id="confirmar_senha" name="confirmar_senha" placeholder="Confirme sua senha:" required aria-required="true"> 
                    <div id="senhaError" class="erro-mensagem" aria-live="polite"></div>
                </div>
                <div class="campos">
                    <input type="submit" value="Criar conta" aria-label="Criar Conta">
                </div>
            </form>
            <p>Já tem uma conta? <a href="login.php">Faça login aqui</a></p>
            <script src="../js/script.js"></script>
        </div>
    </section>
    <!--fim do formulario -->
</body>
</html>
