<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Criar Conta</title>
</head>
<body>
    <!--Formulario para criar conta -->
    <section id="criarconta" class="formulario">
        <div class="titulo-login">
            <h1>Cadastrar-se:</h1>
        </div>
        <!-- Mensagem de erro --> 
        <?php
        session_start(); 
        if (isset($_SESSION['mensagemErro'])):
        ?>
            <div class="mensagem-erro"> 
                <?= htmlspecialchars($_SESSION['mensagemErro']) ?> 
            </div> 
        <?php unset($_SESSION['mensagemErro']); // Remove a mensagem de erro após exibi-la 
        endif; 
        ?>    
        <div>
            <form id="criarConta" action="criarCnt.php" method="POST">
                <div class="campos">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" placeholder="Digite seu nome completo:" required>
                </div>
                <div class="campos">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Digite seu email:" required>
                </div>
                <div class="campos">
                    <label for="idade">Idade:</label>
                    <input type="number" name="idade" id="idade" placeholder="Idade:" required>
                </div>
                <div class="campos">
                    <label for="fone">Telefone:</label>
                    <input type="tel" name="fone" id="fone" placeholder="Digite seu telefone:" required>
                </div>
                <div class="campos">
                    <label for="rg">RG:</label>
                    <input type="text" name="rg" id="rg" placeholder="Digite seu rg:" required>
                </div>
                <div class="campos">
                    <label for="cpf">CPF:</label>
                    <input type="text" name="cpf" id="cp" placeholder="Digite seu cpf:" required>
                </div>
                <div class="campos">
                    <label for="estado">Estado:</label>
                    <select id="estado" name="estado" placeholder="Selecione seu estado:" required>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                    </select>
                </div>
                <div class="campos">
                    <label for="cep">Cep:</label> 
                    <input type="text" id="cep" name="cep" placeholder="Digite seu cep:" required pattern="\d{5}-\d{3}" title="Formato esperado: 12345-678">
                </div>
                <div class="campos">
                    <label for="cidade">Cidade:</label> 
                    <input type="text" id="cidade" name="cidade" placeholder="Digite sua cidade:" required>
                </div> 
                <div class="campos">
                    <label for="rua">Rua:</label> 
                    <input type="text" id="rua" name="rua" placeholder="Digite sua rua:" required>
                </div>
                <div class="campos">
                    <label for="bairro">Bairro:</label> 
                    <input type="text" id="bairro" name="bairro" placeholder="Digite seu bairro:" required> 
                </div>
                <div class="campos">
                    <label for="numero-casa">Número da Casa:</label> 
                    <input type="text" id="numero-casa" name="numero-casa" placeholder="Digite numero-casa:" required> 
                </div>
                <div class="campos">
                    <label for="tipo-residencia">Tipo de Residência:</label> 
                    <select id="tipo-residencia" name="tipo-residencia" aria-placeholder="Seleciona sua residência:" required>
                        <option value="casa">Casa</option> 
                        <option value="apartamento">Apartamento</option>
                    </select>
                </div>
                <div class="campos">
                    <label for="senha">Senha:</label> 
                    <input type="password" id="senha" name="senha" placeholder="Crie uma senha:" required>
                </div>
                <div class="campos">
                    <input type="submit" value="Criar conta">
                </div>
            </form>
            <p>Já tem uma conta? <a href="login.html">Faça login aqui</a></p>
            <script src="script.js"></script>
        </div>
    </section>
    <!--fim doformulario -->
</body>
</html>