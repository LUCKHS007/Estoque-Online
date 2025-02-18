<?php
include 'config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['acao'] == "novo") {
        $nome = $_POST['nome'];
        $quantidade = intval($_POST['quantidade']);
        $query = "INSERT INTO produtos (nome, quantidade, data) VALUES (:nome, :quantidade, NOW())";
        $statement = $pdo->prepare($query);
        $statement->execute(['nome' => $nome, 'quantidade' => $quantidade]);
    } else {
        $id = $_POST['id'];
        $quantidade = intval($_POST['quantidade']);
        $acao = $_POST['acao'];
        
        if ($acao == "adicionar") {
            $query = "UPDATE produtos SET quantidade = quantidade + :quantidade, data = NOW() WHERE id = :id";
        } elseif ($acao == "remover") {
            $query = "UPDATE produtos SET quantidade = GREATEST(quantidade - :quantidade, 0), data = NOW() WHERE id = :id";
        }
        
        $statement = $pdo->prepare($query);
        $statement->execute(['quantidade' => $quantidade, 'id' => $id]);
    }
    
    header("Location: index.php");
    exit();
}
?>
