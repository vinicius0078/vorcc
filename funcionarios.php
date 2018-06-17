<?php 
    include('php/conexao.php');

    if(!isset($_SESSION['nm_usuario'])){
        header("Location: login.php");
    }

    $query = $conn->prepare("SELECT nm_empresa, vl_pin FROM tb_empresa WHERE cd_empresa = :emp");
    $query->bindValue(":emp", $_SESSION['id_empresa']);
    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
        $nm_empresa = $row['nm_empresa'];
        $pin = $row['vl_pin'];
    }
?>
<!doctype html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <title> Vorcc </title>
        <link rel="stylesheet" type="text/css" href="css/dashboard.css">
        <link rel="stylesheet" href="fontawesome-free-5.0.10/web-fonts-with-css/css/fontawesome-all.min.css">
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:500" rel="stylesheet">
    </head>
    <body>
        <nav id="menu">
            <div id="menu-logo"><?php echo $nm_empresa ?>
                <br>
                <span style="font-size:13px;"><?php if($_SESSION['nr_acesso'] >= 1) echo 'Pin: ',$pin; ?></span>
            </div>
            <a class="menu-item active" href="funcionarios.php"><i class="fas fa-users"></i><span>Funcionários</span></a>
            <a class="menu-item" href="orcamentos.php"><i class="fas fa-list"></i><span>Listas</span></a>
            <a class="menu-item" href="produtos.php"><i class="fas fa-box-open"></i><span>Produtos</span></a>
            <a class="menu-item" href="php/logout.php"><i class="fas fa-times-circle"></i><span>Sair</span></a>
        </nav>

        <main id="content">
            <table cellspacing="0">
                <tr><td class="table-title">Nome</td><td class="table-title">CPF</td><td class="table-title">Acesso</td></tr>
                <tr><td class="table-cell-dark">Abner</td><td class="table-cell-dark">123.324.23</td><td class="table-cell-dark">0</td></tr>
                <tr><td class="table-cell">João</td><td class="table-cell">234.212.32</td><td class="table-cell">0</td></tr>
                <tr><td class="table-cell-dark">Pedro</td><td class="table-cell-dark">564.742.85</td><td class="table-cell-dark">0</td></tr>
            </table>
        </main>
    </body>
</html>
