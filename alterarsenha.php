<?php
    session_start();

    if (!isset($_SESSION['nome'])) {
        header("Location: login.php");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $conexao = mysqli_connect('localhost', 'root', '', 'projetoa3','3306');

        if (!$conexao) {
            die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
        }

        $novasenha = $_POST['nova_senha'];
        $confirmarsenha = $_POST['confirmar_senha'];

        if ($novasenha !== $confirmarsenha) {
            $erro = "A nova senha e a confirmação da senha não correspondem.";
        } else {
            $nomeUsuario = $_SESSION['nome'];

            // Verifique se a nova senha é igual à senha atual
            $sql = "SELECT senha FROM login WHERE nome = '$nomeUsuario'";
            $resultado = mysqli_query($conexao, $sql);

            if ($resultado) {
                $row = mysqli_fetch_assoc($resultado);
                $senhaAtual = $row['senha'];

                if ($novasenha === $senhaAtual) {
                    $erro = "A nova senha é igual à senha atual. Por favor, insira uma nova senha.";
                } else {
                    $senhaHash = $novasenha;

                    $sql = "UPDATE login SET senha = '$senhaHash' WHERE nome = '$nomeUsuario'";
                    if (mysqli_query($conexao, $sql)) {
                        mysqli_close($conexao);
                        $_SESSION['senha'] = $novasenha;
                        header("Location: senhaatualizada.php");
                        exit();
                    } else {
                        echo "Erro ao atualizar a senha: " . mysqli_error($conexao);
                    }
                }
            } else {
                echo "Erro ao recuperar a senha atual: " . mysqli_error($conexao);
            }
        }

        mysqli_close($conexao);
    }
    ?>

    <html>
    <head>
        <title>Alterar Senha</title>
        <style>
            body {
                background-image: url('https://static.todamateria.com.br/upload/lu/am/luaminguante1.jpg?auto_optimize=low');
                background-size: cover;
                background-position: center;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            form {
                background-color: rgba(255, 255, 255, 0.7);
                padding: 20px;
                border-radius: 5px;
            }

            label,
            input[type="password"] {
                display: block;
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
            
            .error {
                color: red;
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body>
        <center>
        <h1>Alterar Senha</h1>
        <form method="POST" action="alterarsenha.php">
            <label for="nova_senha">Nova senha:</label>
            <input type="password" name="nova_senha" id="nova_senha" required>

            <label for="confirmar_senha">Confirmar nova senha:</label>
            <input type="password" name="confirmar_senha" id="confirmar_senha" required>

            <input type="submit" value="Alterar Senha">
            
            <?php if (isset($erro)) { ?>
            <div class="error"><?php echo $erro; ?></div>
            <?php } ?>
        </form>
        </center>
    </body>
    </html>
