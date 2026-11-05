<?php
/**
 * funcoes.php
 * Carrega a conexão com o banco e as funções auxiliares compartilhadas
 * por index.php, inclusao.php, exclusao.php e status.php.
 */
require_once __DIR__ . '/conexao.php';

// A sessão agora guarda apenas o filtro escolhido (as tarefas ficam no MySQL)
session_start();

if (!isset($_SESSION['filtro'])) {
    $_SESSION['filtro'] = 'todas'; // todas | concluidas | pendentes
}

/** Escapa texto para exibição segura em HTML (previne XSS). */
function h(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

/** Redireciona para a tela principal e encerra o script. */
function voltarParaIndex(): void
{
    header('Location: index.php');
    exit;
}
