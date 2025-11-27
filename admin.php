<?php


$pedidos_file = __DIR__ . DIRECTORY_SEPARATOR . 'pedidos.txt';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'clear') {

    file_put_contents($pedidos_file, "");
    $mensagem = "Arquivo de pedidos limpo com sucesso.";
}

$conteudo = '';
if (file_exists($pedidos_file)) {
    $conteudo = file_get_contents($pedidos_file);
}


$separator = str_repeat("-", 40) . "\n";
$entradas = array();
if ($conteudo !== '') {
    $parts = explode($separator, $conteudo);
    foreach ($parts as $p) {
        $p = trim($p);
        if ($p !== '') $entradas[] = $p;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Pedidos</title>
    <link rel="stylesheet" href="style.css">
    <style>
        
        .order { margin-bottom: 1rem; padding: 1rem; background: rgba(255,255,255,0.95); border-radius: 8px; border-left: 5px solid #009246; }
        .order pre { white-space: pre-wrap; font-family: inherit; font-size: 0.98rem; }
        .admin-actions { margin: 1rem 0; }
    </style>
</head>
<body>
    <header>
        <h1>Pedidos - Painel do Restaurante</h1>
        <p>Visualize os pedidos recebidos em <code>pedidos.txt</code></p>
        <nav>
            <a href="paginadorestaurante.html">Página do restaurante</a> | 
            <a href="index.html">Cardápio</a>
        </nav>
    </header>

    <hr>

    <main style="max-width:1000px;margin:1.5rem auto;">

    <?php if (!empty(
        $mensagem)) echo '<div class="order"><strong>'.htmlspecialchars($mensagem)."</strong></div>"; ?>

    <div class="admin-actions">
        <form method="post" onsubmit="return confirm('Tem certeza que deseja limpar todos os pedidos? Essa ação é irreversível.');">
            <input type="hidden" name="action" value="clear">
            <button type="submit">Limpar pedidos</button>
        </form>
        <a href="pedidos.txt" download><button style="margin-left:12px">Download (pedidos.txt)</button></a>
    </div>

    <?php if (count($entradas) === 0): ?>
        <div class="order"><strong>Nenhum pedido encontrado.</strong></div>
    <?php else: ?>
        <?php foreach ($entradas as $idx => $e): ?>
            <div class="order">
                <h3>Pedido #<?php echo $idx + 1; ?></h3>
                <pre><?php echo htmlspecialchars($e); ?></pre>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    </main>

    <footer>
        <p>&copy; 2025 Sapore d'Italia</p>
    </footer>
</body>
</html>
