<?php
session_start();
// Configuração do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dados_usuario"; // Nome do banco de dados
// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Receber os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$idade = $_POST['idade'];
$fone = $_POST['fone'];
$rg = $_POST['rg'];
$cpf = $_POST['cpf'];
$estado = $_POST['estado'];
$cep = $_POST['cep'];
$cidade = $_POST['cidade'];
$rua = $_POST['rua'];
$bairro = $_POST['bairro'];
$numero_casa = $_POST['numero-casa'];
$tipo_residencia = $_POST['tipo-residencia'];
$senha = $_POST['senha'];
$confirmarSenha = $_POST['confirmar_senha'];

// Validar Email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['mensagemErro'] = "Email inválido.";
    header("Location: criarConta.php");
    exit();
}

// Validar Telefone
$telefonePattern = "/^\(\d{2}\) \d{4,5}-\d{4}$/";
if (!preg_match($telefonePattern, $fone)) {
    $_SESSION['mensagemErro'] = "Telefone inválido.";
    header("Location: criarConta.php");
    exit();
}
// Função para validar o formato do RG 
function validarRG($rg) { 
    $pattern = '/^[0-9]{2}\.[0-9]{3}\.[0-9]{3}-[0-9X]$/'; // Formato esperado: 12.345.678-9 ou 12.345.678-X 
    return preg_match($pattern, $rg); 
} // Obtendo os dados do formulário 
$rg = $_POST['rg'] ?? ''; // Validar o RG 
if (!validarRG($rg)) { 
    $_SESSION['mensagemErro'] = 'Formato de RG inválido. Use o formato 12.345.678-9 ou 12.345.678-X.'; 
    header('Location: criarConta.php'); 
    exit(); }
// Validar CPF
if (!validarCPF($cpf)) {
    $_SESSION['mensagemErro'] = "CPF inválido.";
    header("Location: criarConta.php");
    exit();
}

// Validar CEP
$cepPattern = "/^\d{5}-\d{3}$/";
if (!preg_match($cepPattern, $cep)) {
    $_SESSION['mensagemErro'] = "CEP inválido.";
    header("Location: criarConta.php");
    exit();
}

// Validar Senhas
if ($senha !== $confirmarSenha) {
    $_SESSION['mensagemErro'] = "As senhas não coincidem.";
    header("Location: criarConta.php");
    exit();
}

// Verificar complexidade da senha
if (strlen($senha) < 8 || !preg_match("/[A-Z]/", $senha) || !preg_match("/\d/", $senha) || !preg_match("/[!@#$%^&*]/", $senha)) {
    $_SESSION['mensagemErro'] = "A senha deve ter pelo menos 8 caracteres, incluindo uma letra maiúscula, um número e um caractere especial.";
    header("Location: criarConta.php");
    exit();
}

// Verificação de duplicidade
$sql_check = "SELECT * FROM usuario WHERE email='$email' OR rg='$rg' OR cpf='$cpf'";
$result = $conn->query($sql_check);
if ($result->num_rows > 0) {
    // Armazenar os dados na sessão
    $_SESSION['nome'] = $nome;
    $_SESSION['email'] = $email;
    $_SESSION['idade'] = $idade;
    $_SESSION['fone'] = $fone;
    $_SESSION['rg'] = $rg;
    $_SESSION['cpf'] = $cpf;
    $_SESSION['estado'] = $estado;
    $_SESSION['cep'] = $cep;
    $_SESSION['cidade'] = $cidade;
    $_SESSION['rua'] = $rua;
    $_SESSION['bairro'] = $bairro;
    $_SESSION['numero_casa'] = $numero_casa;
    $_SESSION['tipo_residencia'] = $tipo_residencia;
    // Verificar qual campo está duplicado
    $row = $result->fetch_assoc();
    if ($row['email'] == $email) {
        $_SESSION['mensagemErro'] = "Erro: Já existe um registro com o mesmo email!";
    } elseif ($row['rg'] == $rg) {
        $_SESSION['mensagemErro'] = "Erro: Já existe um registro com o mesmo RG!";
    } elseif ($row['cpf'] == $cpf) {
        $_SESSION['mensagemErro'] = "Erro: Já existe um registro com o mesmo CPF!";
    }
    header("Location: criarConta.php");
    exit();
} else {
    // Hash da senha
    $senhaHashed = password_hash($senha, PASSWORD_BCRYPT);

    // Inserir dados na tabela
    $sql = "INSERT INTO usuario (nome, email, idade, fone, rg, cpf, estado, cep, cidade, rua, bairro, numero_casa, tipo_residencia, password) 
            VALUES ('$nome', '$email', $idade, '$fone', '$rg', '$cpf', '$estado', '$cep', '$cidade', '$rua', '$bairro', '$numero_casa', '$tipo_residencia', '$senhaHashed')";
    if ($conn->query($sql) === TRUE) {
        // Redirecionar para a página inicial após o sucesso
        $_SESSION['mensagemSucesso'] = "Conta criada com sucesso.";
        header("Location: pgInicial.php");
        exit();
    } else {
        $_SESSION['mensagemErro'] = "Erro ao criar conta: " . $conn->error;
        header("Location: criarConta.php");
        exit();
    }
}

$conn->close();

function validarCPF($cpf) {
    $cpf = preg_replace('/[^0-9]/is', '', $cpf);
    
    if (strlen($cpf) != 11) {
        return false;
    }
    
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }
    
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}
?>
