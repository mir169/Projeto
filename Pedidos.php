<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente = $_POST['cliente'];
    $pratos = $_POST['pratos'] ?? [];

    if (!empty($pratos)) {
        $pedido = "Cliente: $cliente\n";
        $pedido .= "Pratos escolhidos:\n";
        foreach ($pratos as $prato) {
            $pedido .= "- $prato\n";
        }
        $pedido .= "-----------------------------\n";

        // Salva no arquivo pedidos.txt
        file_put_contents("pedidos.txt", $pedido, FILE_APPEND);

        echo "<h2>Pedido registrado com sucesso!</h2>";
        echo "<p>Obrigado, $cliente. Seu pedido foi enviado para a cozinha 🍽️</p>";
        echo "<a href='index.php'>Voltar ao cardápio</a>";
    } else {
        echo "<h2>Nenhum prato selecionado!</h2>";
        echo "<a href='index.php'>Voltar ao cardápio</a>";
    }
}
?>
