<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cliente = isset($_POST['cliente']) ? trim($_POST['cliente']) : '';
    $endereco = isset($_POST['endereco']) ? trim($_POST['endereco']) : '';
    $pratos = isset($_POST['pratos']) ? $_POST['pratos'] : [];

    
    $cliente_safe = strip_tags($cliente);
    $endereco_safe = strip_tags($endereco);

    if (!empty($cliente_safe) && !empty($pratos) && !empty($endereco_safe)) {
        
        $pedido = "Cliente: " . $cliente_safe . "\n";
        $pedido .= "Endereço: " . $endereco_safe . "\n";
        $pedido .= "Pratos: " . implode(", ", $pratos) . "\n";
        $pedido .= "Data/Hora: " . date("d/m/Y H:i:s") . "\n";
        $pedido .= str_repeat("-", 40) . "\n";

        
        file_put_contents("pedidos.txt", $pedido, FILE_APPEND);

        
        echo "<h1>Pedido registrado com sucesso!</h1>";
        echo "<p>Obrigado, " . htmlspecialchars($cliente_safe) . ". Seu pedido foi enviado para o restaurante.</p>";
        echo "<p>Endereço informado: " . htmlspecialchars($endereco_safe) . "</p>";
        echo "<p><a href='index.html'>Voltar ao cardápio</a></p>";
    } else {
        echo "<h1>Erro</h1>";
        echo "<p>Você precisa informar seu nome, endereço e selecionar pelo menos um prato.</p>";
        echo "<p><a href='index.html'>Voltar ao cardápio</a></p>";
    }
} else {
    echo "<h1>Acesso inválido</h1>";
}
?>
