<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            background-image: url('https://hardcore.com.br/wp-content/uploads/sites/21/2021/02/fases-da-lua-768x468.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        #login {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 5px;
        }

        #login input[type="text"],
        #login input[type="password"] {
            padding: 10px;
            border: none;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        #login input[type="submit"] {
            padding: 10px 20px;
            background-color: #4f0d15;
            color: white;
            border: none;
            cursor: pointer;
        }

        #login input[type="submit"]:hover {
            background-color: #8b0000;
        }
    </style>
</head>
<body>
    <center>
        <div id="login">
            <h1>Login</h1>
            <form action="logado.php" method="POST">
                Login: <input type="text" name="login" required><br>
                Password: <input type="password" name="senha" required><br><br>
                <input type="submit" value="Entrar">
            </form>
        </div>
    </center>
</body>
</html>
