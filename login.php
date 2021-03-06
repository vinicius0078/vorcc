<?php include('php/conexao.php'); ?>
<!doctype html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <title> Vorcc </title>
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
        <link rel="stylesheet" href="fontawesome-free-5.0.10/web-fonts-with-css/css/fontawesome-all.min.css">
    </head>
    <body>
        <form method="post" class="login-container">
            <div id="title">Faça seu login</div>
            <div id="form-container">
                <div class="icon-mask">
                    <input type="text" placeholder="Login" name="login" class="form-input">
                    <i class="fas fa-user"></i>
                </div>
                <br>
                <div class="icon-mask">
                    <input type="password" placeholder="Senha" name="senha" class="form-input">
                    <i class="fas fa-lock"></i>
                </div>
                <br>

                <div class="form-submit-container">
                    <a href="cadastro.php">Não possui conta?</a>
                    <input type="submit" value="Entrar" name="submit" id="submit-btn" class="hidden">
                    <label for="submit-btn" class="form-submit"><i class="fas fa-sign-in-alt"></i></label>
                </div>
            </div>
        </form>

        <?php
            if(isset($_SESSION['cd_usuario'])){
                header("Location: dash.php");
            }

            if(isset($_POST['login']) && isset($_POST['senha'])){
                $query = $conn->prepare("SELECT * FROM tb_usuario
                                        JOIN tb_empresa ON tb_usuario.id_empresa = tb_empresa.cd_empresa
                                        WHERE nm_senha = :senha AND nm_login = :login");
                $query->bindValue(':senha', md5($_POST['senha']));
                $query->bindValue(':login', $_POST['login']);
                $query->execute();

                if($query->rowCount() == 1){
                    while($row = $query->fetch(PDO::FETCH_ASSOC)){
                        $_SESSION['id_empresa'] = $row['id_empresa'];
                        $_SESSION['cd_usuario'] = $row['cd_usuario'];
                        $_SESSION['nm_usuario'] = $row['nm_usuario'];
                        $_SESSION['nr_acesso']  = $row['nr_acesso'];
                        $_SESSION['bool_fornecedor'] = $row['bool_fornecedor'];
                        header("Location: dash.php");
                    }
                }else{
                    echo '??';
                }
            }
        ?>

        </div>
    </body>
</html>
