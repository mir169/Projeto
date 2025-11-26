<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cliente = trim($_POST['cliente']);
    $pratos = isset($_POST['pratos']) ? $_POST['pratos'] : [];

    if (!empty($cliente) && !empty($pratos)) {
        
        $pedido = "Cliente: " . $cliente . "\n";
        $pedido .= "Pratos: " . implode(", ", $pratos) . "\n";
        $pedido .= "Data/Hora: " . date("d/m/Y H:i:s") . "\n";
        $pedido .= str_repeat("-", 40) . "\n";

        
        file_put_contents("pedidos.txt", $pedido, FILE_APPEND);

        
        echo "<h1>Pedido registrado com sucesso!</h1>";
        echo "<p>Obrigado, <strong>" . htmlspecialchars($cliente) . "</strong>. Seu pedido foi enviado para o restaurante.</p>";
        echo "<p><a href='index.html'>Voltar ao cardápio</a></p>";
    } else {
        echo "<h1>Erro</h1>";
        echo "<p>Você precisa selecionar pelo menos um prato e informar seu nome.</p>";
        echo "<p><a href='index.html'>Voltar ao cardápio</a></p>";
    }
} else {
    echo "<h1>Acesso inválido</h1>";
}
?>
