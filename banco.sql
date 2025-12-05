-- Banco de dados para o projeto Toshiro Shibakita
-- Sistema de Microsserviços com Docker

USE meubanco;

CREATE TABLE IF NOT EXISTS dados (
    AlunoID int NOT NULL,
    Nome varchar(50) NOT NULL,
    Sobrenome varchar(50) NOT NULL,
    Endereco varchar(150) NOT NULL,
    Cidade varchar(50) NOT NULL,
    Host varchar(50) NOT NULL,
    DataCriacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (AlunoID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
