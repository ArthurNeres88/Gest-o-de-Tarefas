<?php
/**
 * exclusao.php - Recebe o ID da tarefa via POST, remove-a do banco
 * e redireciona para index.php.
 */
require_once __DIR__ . '/funcoes.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) ($_POST['id'] ?? 0);

    try {
        $tarefa = R::load('tarefa', $id);
        if ($tarefa->id) {          // só apaga se o registro existir
            R::trash($tarefa);
        }
    } catch (Throwable $erro) {
        header('Location: erro.php?tipo=salvar');
        exit;
    }
}

voltarParaIndex();
