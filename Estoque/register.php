<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'config.php';
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $query = "INSERT INTO usuarios (username, password) VALUES (:username, :password)";
    $statement = $pdo->prepare($query);
    $statement->execute(['username' => $username, 'password' => $password]);
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="imagens/logo.png" type="imagens/x-icon">
<link rel="stylesheet" type="text/css" href="style.css">
    <title>Sargon - Cadastro</title>
</head>
<body>
    <img class="logosar2" src="imagens/logo-png.png">
    <h1>Cadastrar</h1>
    <form method="POST">
        Usuário: <input type="text" name="username" required><br>
        Senha: <input type="password" name="password" required><br>
        <input class="ent" type="submit" value="Enviar">
    </form>
</body>
</html>
