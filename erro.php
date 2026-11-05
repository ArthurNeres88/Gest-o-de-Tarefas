<?php
/**
 * erro.php - Página de erro simples (mesmo padrão do seu erro.php).
 * Não usa conexão com o banco, pois pode ser chamada justamente quando ela falha.
 */
$mensagens = [
    'banco'  => 'Não foi possível conectar ao banco de dados ABNQRCF. Verifique se o MySQL está ligado e se o banco existe.',
    'salvar' => 'Não foi possível concluir a operação no banco de dados.',
];

$tipo = $_GET['tipo'] ?? '';
$mensagem = $mensagens[$tipo] ?? 'Ocorreu um erro inesperado.';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Erro - Gestão de Tarefas</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<div class="container">
    <h1>Operação não concluída</h1>
    <p><?= htmlspecialchars($mensagem, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></p>
    <a class="erro-link" href="index.php">Voltar para a lista</a>
</div>
</body>
</html>
