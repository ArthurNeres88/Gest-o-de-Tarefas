<?php
/**
 * index.php - Tela principal da Gestão de Tarefas (TODO LIST)
 */
require_once __DIR__ . '/funcoes.php';

// 1) Atualiza o filtro escolhido (se válido) e guarda na sessão
$filtrosValidos = ['todas', 'concluidas', 'pendentes'];
if (isset($_GET['filtro']) && in_array($_GET['filtro'], $filtrosValidos, true)) {
    $_SESSION['filtro'] = $_GET['filtro'];
}
$filtro = $_SESSION['filtro'];

// 2) Busca as tarefas no banco conforme o filtro
//    (se a tabela ainda não existir, o RedBean devolve lista vazia)
if ($filtro === 'concluidas') {
    $tarefas = R::find('tarefa', 'concluida = ? ORDER BY id DESC', [1]);
} elseif ($filtro === 'pendentes') {
    $tarefas = R::find('tarefa', 'concluida = ? ORDER BY id DESC', [0]);
} else {
    $tarefas = R::findAll('tarefa', 'ORDER BY id DESC');
}

// Rótulos dos filtros
$rotulos = [
    'todas'      => 'TODAS',
    'concluidas' => 'CONCLUÍDAS',
    'pendentes'  => 'NÃO CONCLUÍDAS',
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestão de Tarefas</title>
    <!-- CSS externo -->
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<div class="container">
    <h1>(TODO LIST) Gestão de Tarefas</h1>

    <!-- Formulário de inclusão: envia para inclusao.php -->
    <form class="form-inclusao" action="inclusao.php" method="post">
        <input type="text" name="descricao" placeholder="Nova tarefa..." maxlength="200" required>
        <button type="submit" class="btn-add" title="Adicionar tarefa" aria-label="Adicionar">+</button>
    </form>

    <!-- Barra de filtros -->
    <nav class="filtros">
        <?php foreach ($rotulos as $chave => $rotulo): ?>
            <a href="index.php?filtro=<?= $chave ?>"
               class="<?= $filtro === $chave ? 'ativo' : '' ?>"><?= $rotulo ?></a>
        <?php endforeach; ?>
    </nav>

    <!-- Lista de tarefas -->
    <?php if (empty($tarefas)): ?>
        <p class="vazio">Nenhuma tarefa por aqui.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($tarefas as $t): ?>
                <li class="<?= $t->concluida ? 'concluida' : '' ?>">

                    <!-- Checkbox: alterna o status via status.php -->
                    <form action="status.php" method="post">
                        <input type="hidden" name="id" value="<?= (int) $t->id ?>">
                        <input type="checkbox"
                               <?= $t->concluida ? 'checked' : '' ?>
                               onchange="this.form.submit()"
                               aria-label="Alternar status">
                        <noscript><button type="submit">OK</button></noscript>
                    </form>

                    <span class="texto"><?= h($t->descricao) ?></span>

                    <!-- Lixeira: envia para exclusao.php -->
                    <form action="exclusao.php" method="post"
                          onsubmit="return confirm('Excluir esta tarefa?');">
                        <input type="hidden" name="id" value="<?= (int) $t->id ?>">
                        <button type="submit" class="btn-lixeira" title="Excluir" aria-label="Excluir">🗑️</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
</body>
</html>
