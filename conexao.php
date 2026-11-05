<?php
/**
 * conexao.php
 * Conexão com o banco de dados MySQL usando RedBeanPHP.
 * Baseado nas configurações enviadas (classes/rb.php, usuário root, senha aluno).
 *
 * Se o banco não responder, redireciona para erro.php?tipo=banco.
 */
require_once __DIR__ . '/classes/rb.php';

try {
    R::setup('mysql:host=localhost;dbname=ABNQRCF', 'root', 'aluno');

    if (!R::testConnection()) {
        header('Location: erro.php?tipo=banco');
        exit;
    }
} catch (Throwable $erro) {
    // Banco inexistente, senha errada, MySQL desligado etc.
    header('Location: erro.php?tipo=banco');
    exit;
}
