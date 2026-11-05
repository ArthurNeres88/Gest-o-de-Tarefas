<?php
/**
 * status.php - Alterna uma tarefa entre concluída e não concluída
 * no banco e redireciona para index.php.
 */
require_once __DIR__ . '/funcoes.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) ($_POST['id'] ?? 0);

    try {
        $tarefa = R::load('tarefa', $id);
        if ($tarefa->id) {
            $tarefa->concluida = !$tarefa->concluida; // inverte o status
            R::store($tarefa);
        }
    } catch (Throwable $erro) {
        header('Location: erro.php?tipo=salvar');
        exit;
    }
}

voltarParaIndex();
