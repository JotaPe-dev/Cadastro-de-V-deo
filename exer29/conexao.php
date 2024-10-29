<?php
// Conexão com o banco de dados
$host = 'localhost';
$dbname = 'cadastro_videos';
$username = 'root'; // substitua com seu usuário do MySQL
$password = ''; // substitua com sua senha do MySQL

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Receber dados do formulário
        $nome = $_POST['nome'];
        $link = $_POST['link'];

        // Inserir no banco de dados
        $sql = "INSERT INTO videos (nome, link) VALUES (:nome, :link)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':link', $link);

        if ($stmt->execute()) {
            $mensagem = "Vídeo cadastrado com sucesso!";
        } else {
            $mensagem = "Erro ao cadastrar o vídeo.";
        }
    }

    // Buscar todos os vídeos cadastrados no banco de dados
    $sql = "SELECT * FROM videos";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $videos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>