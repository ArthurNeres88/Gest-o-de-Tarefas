-- banco.sql
-- Execute no phpMyAdmin (aba SQL) ou no terminal: mysql -u root -p < banco.sql

CREATE DATABASE IF NOT EXISTS ABNQRCF
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci;

USE ABNQRCF;

-- OPCIONAL: o RedBeanPHP cria esta tabela sozinho na primeira inclusão.
-- Ela está aqui só para você enxergar a estrutura.
CREATE TABLE IF NOT EXISTS tarefa (
    id          INT UNSIGNED NOT NULL AUTO_INCREMENT,
    descricao   VARCHAR(200) NOT NULL,
    concluida   TINYINT(1)   NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
