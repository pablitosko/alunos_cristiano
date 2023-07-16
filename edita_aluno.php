<?php
header('Content-type: text/html; charset=utf-8');
setlocale(LC_ALL, NULL);
setlocale(LC_ALL, 'pt_BR.utf-8');

include "config.php";

session_start();

// Check user login or not
if (!isset($_SESSION['userid'])) {
    header('Location: index.php');
}

// logout
if (isset($_POST['but_logout'])) {
    session_destroy();
    // Remove cookie variables
    $days = 30;
    setcookie("rememberme", "", time() - ($days * 24 * 60 * 60 * 1000));
    header('Location: index.php');
}

$get_matricula = $_GET['matricula'];

$sql = $conn->prepare("select * from cristiano.estudante_basico where matricula  = '$get_matricula'");
$sql->setFetchMode(PDO::FETCH_ASSOC);
$sql->execute();
while ($row = $sql->fetch()) {
    $nome = $row["nome"];
    $matricula = $row["matricula"];
    $cpf = $row["cpf"];
    $endereco = $row["endereco"];
    $celular = $row["celular"];
    $aniversario = $row["aniversario"];
    $cep = $row["cep"];
    $email = $row["email"];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edição Aluno</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>

<body>
    </br>
    <div class="container is-fluid">
        <div class="notification is-primary">
            <p class="title is-3">Editar</p>
            <form action="" method="POST">
                <label for="nome">Nome:</label><br>
                <input class="input is-primary" type="text" placeholder="Nome Completo" id="nome" name="nome" value="<?php echo $nome; ?>"><br>
                <label for="matricula">Matricula:</label><br>
                <input class="input is-primary" type="text" placeholder="Matricula do Aluno" id="matricula" name="matricula" value="<?php echo $matricula; ?>"><br>
                <label for="cpf">CPF:</label><br>
                <input class="input is-primary" type="text" placeholder="CPF" id="cpf" name="cpf" value="<?php echo $cpf; ?>"><br>
                <label for="endereco">Endereço:</label><br>
                <input class="input is-primary" type="text" placeholder="Endereço Completo" id="endereco" name="endereco" value="<?php echo $endereco; ?>"><br>
                <label for="celular">Celular:</label><br>
                <input class="input is-primary" type="tel" placeholder="(99)9999-9999" id="celular" name="celular" value="<?php echo $celular; ?>"><br>
                <label for="aniversario">Aniversário:</label><br>
                <input class="input is-primary" type="date" placeholder="Aniversário" id="aniversario" name="aniversario" value="<?php echo $aniversario; ?>"><br>
                <label for="cep">CEP:</label><br>
                <input class="input is-primary" type="number" placeholder="99.999-999" id="cep" name="cep" value="<?php echo $cep; ?>"><br>
                <label for="email">E-mail:</label><br>
                <input class="input is-primary" type="email" placeholder="E-mail" id="email" name="email" value="<?php echo $email; ?>"><br>
                </br>
                <div class="buttons">
                    <button class="button is-primary is-light" id="salvar" name="salvar">Salvar</button>
                    <button class="button is-danger is-light" id="cancelar" name="cancelar">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['salvar'])) {

        $nome = $_POST["nome"];
        $matricula = $_POST["matricula"];
        $cpf = $_POST["cpf"];
        $endereco = $_POST["endereco"];
        $celular = $_POST["celular"];
        $aniversario = $_POST["aniversario"];
        $cep = $_POST["cep"];
        $email = $_POST["email"];



        $sql_update_l1 = "UPDATE cristiano.estudante_basico ";
        $sql_update_l2 = "SET nome = '$nome', matricula = '$matricula', cpf = '$cpf', endereco = '$endereco', celular = '$celular', aniversario = '$aniversario', cep = '$cep', email = '$email' where matricula = '".$get_matricula."';";
        $sql_update = $sql_update_l1 . $sql_update_l2;
        $sql = $conn->prepare($sql_update);


        if ($sql->execute()) {
            echo "Atualizado com sucesso!";
            header('Location: home.php');
        } else {
            echo "Não foi possivel atuaizar!";
        }


    }

    if (isset($_POST['cancelar'])) {

        header('Location: home.php');
    }
    
    ?>

</body>

</html>