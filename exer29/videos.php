<?php
require 'conexao.php';

// Inicializar a variável $videos como array vazio
$videos = [];

try {
    // Consulta para buscar os vídeos
    $sql = "SELECT id, nome, link FROM videos";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $videos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao buscar vídeos: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Vídeos do YouTube</title>
    <link rel="stylesheet" href="videos.css">
</head>
<body>
    <h1>Vídeos Cadastrados</h1>

    <div class="video-container">
        <?php
        // Verificar se há vídeos para exibir
        if (!empty($videos)) {
            foreach ($videos as $video) {
                // Extrair o ID do vídeo do YouTube do link
                preg_match("/v=([a-zA-Z0-9_-]+)/", $video['link'], $matches);
                $videoId = $matches[1] ?? null;

                if ($videoId) {
                    // Gerar a URL da miniatura do vídeo do YouTube
                    $thumbnailUrl = "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg";
                    echo '<div class="video">';
                    echo '<img src="' . $thumbnailUrl . '" alt="Miniatura do vídeo">';
                    echo '<strong>' . htmlspecialchars($video['nome']) . '</strong>';
                    echo '<a href="' . htmlspecialchars($video['link']) . '" target="_blank">Assistir</a>';
                    echo '</div>';
                }
            }
        } else {
            echo "<p>Nenhum vídeo cadastrado.</p>";
        }
        ?>
    </div>
</body>
</html>
