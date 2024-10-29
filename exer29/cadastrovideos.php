<?php
require 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="stylesCad.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Vídeos do YouTube</title>
</head>
<body>
    <h1>Cadastro de Vídeos</h1>
    <!-- Exibir mensagem de sucesso ou erro -->
    <?php
    if (isset($mensagem)) {
        echo "<p>$mensagem</p>";
    }
    ?>
    
    <!-- Formulário de cadastro -->
    <form action="index.php" method="POST">
        <label for="nome">Nome do Vídeo:</label><br>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="link">Link do Vídeo do YouTube:</label><br>
        <input type="url" id="link" name="link" placeholder="https://www.youtube.com/watch?v=EXAMPLE" required><br><br>

        <button type="submit">Cadastrar</button>
    </form>

    <hr>
</body>
</html>
