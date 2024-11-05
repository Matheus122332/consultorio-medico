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
$senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);
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
    header("Location: ../php/criarConta.php");
    exit();
} else {
    // Inserir dados na tabela
    $sql = "INSERT INTO usuario (nome, email, idade, fone, rg, cpf, estado, cep, cidade, rua, bairro, numero_casa, tipo_residencia, password) 
    VALUES ('$nome', '$email', $idade, '$fone', '$rg', '$cpf', '$estado', '$cep', '$cidade', '$rua', '$bairro', '$numero_casa', '$tipo_residencia', '$senha')";
    if ($conn->query($sql) === TRUE) {
       // Redirecionar para a página inicial após o sucesso 
       header("Location: ../php/pgInicial.php"); 
       exit();
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
