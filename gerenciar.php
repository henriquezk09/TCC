<?php
require_once 'conexao.php';

// Lógica de Exclusão
if (isset($_GET['excluir'])) {
    $id = (int)$_GET['excluir'];
    $stmt = $conexao->prepare("DELETE FROM slides WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: gerenciar.php");
    exit();
}

// Busca todos os slides
$sql = "SELECT * FROM slides ORDER BY id DESC";
$resultado = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Slides</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Gerenciar Slides</h2>
        <div>
            <a href="cadastro.php" class="btn btn-success">+ Novo Slide</a>
            <a href="index.php" class="btn btn-outline-primary">Ver Carrossel</a>
        </div>
    </div>

    <div class="card-custom mt-0">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagem</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultado && $resultado->num_rows > 0): ?>
                    <?php while ($slide = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $slide['id']; ?></td>
                            <td>
                                <img src="<?php echo htmlspecialchars($slide['imagem_url']); ?>" width="100" height="60" style="object-fit: cover;">
                            </td>
                            <td><?php echo htmlspecialchars($slide['titulo']); ?></td>
                            <td><?php echo htmlspecialchars($slide['descricao']); ?></td>
                            <td>
                                <a href="gerenciar.php?excluir=<?php echo $slide['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este slide?');">Excluir</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Nenhum slide cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>