<?php
require_once 'conexao.php';

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $imagem_url = $_POST['imagem_url'];

    $stmt = $conexao->prepare("INSERT INTO slides (titulo, descricao, imagem_url) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $titulo, $descricao, $imagem_url);

    if ($stmt->execute()) {
        $mensagem = '<div class="alert alert-success">Slide cadastrado com sucesso!</div>';
    } else {
        $mensagem = '<div class="alert alert-danger">Erro ao cadastrar: ' . $conexao->error . '</div>';
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Slide</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 card-custom">
            <h2 class="mb-4">Cadastrar Novo Slide</h2>
            
            <?php echo $mensagem; ?>

            <form action="cadastro.php" method="POST">
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" required placeholder="Digite o título do slide">
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="3" placeholder="Digite uma breve descrição"></textarea>
                </div>

                <div class="mb-3">
                    <label for="imagem_url" class="form-label">URL da Imagem</label>
                    <input type="url" class="form-control" id="imagem_url" name="imagem_url" required placeholder="https://exemplo.com/imagem.jpg">
                    <div class="form-text">Cole a URL de uma imagem da internet ou o caminho local.</div>
                </div>

                <button type="submit" class="btn btn-primary">Salvar Slide</button>
                <a href="gerenciar.php" class="btn btn-secondary">Gerenciar Slides</a>
                <a href="index.php" class="btn btn-outline-dark">Ver Carrossel</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>