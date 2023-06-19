<?php
include("conexao.php");

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $login = isset($_POST['login']) ? $_POST['login'] : '';
    $senha = isset($_POST['senha']) ? $_POST['senha'] : '';

    
    $verificarLogin = "SELECT * FROM login WHERE login = '$login'";
    $resultado = mysqli_query($conexao, $verificarLogin);

    if (mysqli_num_rows($resultado) > 0) {
        $mensagem = "O nome de login '$login' já está em uso. Por favor, escolha outro.";
    } else {
        $insert = "INSERT INTO login (nome, login, senha) VALUES ('$nome', '$login', '$senha')";
        if (mysqli_query($conexao, $insert)) {
            $mensagem = "Cadastro realizado com sucesso!";
        } else {
            $mensagem = "Erro ao cadastrar usuário: " . mysqli_error($conexao);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <style>
        body {
            background-image: url('https://p2.trrsf.com/image/fget/cf/774/0/images.terra.com/2021/08/05/1839582770-fases-da-lua-17974.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        center {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 5px;
        }

        input[type="text"],
        input[type="password"] {
            padding: 10px;
            border: none;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4f0d15;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #8b0000;
        }
    </style>
</head>
<body>
    <center>
        <h1>Cadastro</h1>
        <?php if (!empty($mensagem)) { ?>
            <p><?php echo $mensagem; ?></p>
            <?php if ($mensagem === "Cadastro realizado com sucesso!") {
                header('Refresh: 2; URL=index.php');
            } ?>
        <?php } ?>
        <?php if (empty($mensagem) || $mensagem !== "Cadastro realizado com sucesso!") { ?>
            <form id="cadastro" action="cadastro.php" method="POST">
                Nome: <input type="text" name="nome" required><br>
                Login: <input type="text" name="login" required><br>
                Password: <input type="password" name="senha" required><br><br>
                <input type="submit" value="Cadastrar">
            </form>
        <?php } ?>
    </center>
</body>
</html>
