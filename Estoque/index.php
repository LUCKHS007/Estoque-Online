<?php
include 'config.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$query = "SELECT id, nome, quantidade, data FROM produtos";
$statement = $pdo->prepare($query);
$statement->execute();
$produtos = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="imagens/logo.png" type="imagens/x-icon">
    <title>Sargon - Estoque Online</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <div class="logosargon">
        <img src="imagens/logo-sargon.png">
    </div>
        <h1>Consulta de Estoque</h1>
        <a class="logout" href="logout.php">Logout</a>
        
        <h2 class="h2top">Adicionar Novo Produto</h2>
        <form method="POST" action="atualizar.php" class="form-produto">
            <input type="text" name="nome" placeholder="Nome do Produto" required>
            <input type="number" name="quantidade" placeholder="Quantidade" required>
            <button type="submit" name="acao" value="novo">Adicionar Produto</button>
        </form>
        
        <table>
            <tr>
                <th>Data da Última Alteração</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Ação</th>
            </tr>
            <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?php echo htmlspecialchars($produto['data']); ?></td>
                    <td><?php echo htmlspecialchars($produto['nome']); ?></td>
                    <td><?php echo htmlspecialchars($produto['quantidade']); ?></td>
                    <td>
                        <form method="POST" action="atualizar.php" class="form-acao">
                            <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">
                            <input type="number" name="quantidade" required>
                            <button type="submit" name="acao" value="adicionar" class="btn-adicionar">Adicionar</button>
                            <button type="submit" name="acao" value="remover" class="btn-remover">Remover</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>