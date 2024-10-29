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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="index.php">Home</a>
                <a class="nav-item nav-link" href="videos.php">Videos</a>
                <a class="nav-item nav-link" href="cadastrovideos.php">Cadastre o Video</a>
            </div>
        </div>
    </nav>

    <main>
        <div style="background:greenyellow !important" class="jumbotron">
            <h1 class="display-4">Bem-vindo ao Site da Aula sobre Videos</h1>
            <p class="lead">
                SEO para vídeos
                O SEO (Search Engine Optimization) é uma estratégia de marketing digital que visa melhorar a
                visibilidade de um site ou página na internet.
                Otimizar o conteúdo de vídeo é uma prática que pode aumentar a sua performance nos mecanismos de busca.
            </p>
            <hr class="my-4">
            <p>Veja todos os vídeos em alta</p>
            <a class="btn btn-success btn-lg" href="videos.php" role="button">Ver os vídeos</a>
            <a class="btn btn-success btn-lg" href="cadastrovideos.php" role="button">Cadastrar</a>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>

</html>
