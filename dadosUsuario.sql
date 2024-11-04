CREATE DATABASE dados_usuario;
USE dados_usuario;
CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR (50) NOT NULL,
    email VARCHAR (50) NOT NULL UNIQUE,
    idade INT NOT NULL,
    fone VARCHAR (15) NOT NULL,
    rg VARCHAR (15) NOT NULL,
    cpf VARCHAR(15) NOT NULL,
    estado VARCHAR(20) NOT NULL, 
    cep VARCHAR(10) NOT NULL, 
    cidade VARCHAR(50) NOT NULL, 
    rua VARCHAR(50) NOT NULL, 
    bairro VARCHAR(50) NOT NULL, 
    numero_casa VARCHAR(10) NOT NULL, 
    tipo_residencia VARCHAR(20) NOT NULL,
    senha VARCHAR(20) NOT NULL
);