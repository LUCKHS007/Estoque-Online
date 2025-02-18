<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'config.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT id, password FROM usuarios WHERE username = :username";
    $statement = $pdo->prepare($query);
    $statement->execute(['username' => $username]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: index.php");
        exit();
    } else {
        echo "Usuário ou senha incorretos!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="imagens/logo.png" type="imagens/x-icon">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Sargon - Login</title>
</head>
<body>
    <img class="logosar" src="imagens/logo-png.png">
    <h1>Login</h1>
    <form method="POST">
        Usuário: <input type="text" name="username" required><br>
        Senha: <input type="password" name="password" required><br>
        <input class="ent" type="submit" value="Entrar">
    </form>
    <a class="cads" href="register.php">Cadastrar</a>
</body>
</html>