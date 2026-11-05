<?php
/**
 * inclusao.php - Recebe a descrição via POST, grava a tarefa no banco
 * (status pendente) e redireciona para index.php.
 */
require_once __DIR__ . '/funcoes.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'] ?? '';

    if (is_string($descricao)) {
        $descricao = trim($descricao);

        // Ignora descrições vazias
        if ($descricao !== '') {
            try {
                $tarefa = R::dispense('tarefa');          // tabela "tarefa"
                $tarefa->descricao = mb_substr($descricao, 0, 200);
                $tarefa->concluida = false;               // nova tarefa começa pendente
                R::store($tarefa);
            } catch (Throwable $erro) {
                header('Location: erro.php?tipo=salvar');
                exit;
            }
        }
    }
}

voltarParaIndex();
