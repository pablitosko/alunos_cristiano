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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastra Aluno</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
</head>

<body>
    </br>
    <div class="container is-fluid">
        <div class="notification is-primary">
            <p class="title is-3">Cadastrar</p>
            <form action="" method="POST">
                <label for="nome">Nome:</label><br>
                <input class="input is-primary" type="text" placeholder="Nome Completo" id="nome" name="nome"><br>
                <label for="matricula">Matricula:</label><br>
                <input class="input is-primary" type="text" placeholder="Matricula do Aluno" id="matricula" name="matricula"><br>
                <label for="cpf">CPF:</label><br>
                <input class="input is-primary" type="text" placeholder="CPF" id="cpf" name="cpf"><br>
                <label for="endereco">Endereço:</label><br>
                <input class="input is-primary" type="text" placeholder="Endereço Completo" id="endereco" name="endereco"><br>
                <label for="celular">Celular:</label><br>
                <input class="input is-primary" type="tel" placeholder="(99)9999-9999" id="celular" name="celular"><br>
                <label for="aniversario">Aniversário:</label><br>
                <input class="input is-primary" type="date" placeholder="Aniversário" id="aniversario" name="aniversario"><br>
                <label for="cep">CEP:</label><br>
                <input class="input is-primary" type="number" placeholder="99.999-999" id="cep" name="cep"><br>
                <label for="email">E-mail:</label><br>
                <input class="input is-primary" type="email" placeholder="E-mail" id="email" name="email"><br>
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



        $sql_insert_l1 = "INSERT INTO cristiano.estudante_basico ";
        $sql_insert_l2 = "(nome, matricula, cpf, endereco, celular, aniversario, cep, email) ";
        $sql_insert_l3 = "VALUES('$nome', '$matricula', '$cpf', '$endereco', '$celular', '$aniversario', '$cep','$email');";
        $sql_insert = $sql_insert_l1 . $sql_insert_l2 . $sql_insert_l3;
        $sql = $conn->prepare($sql_insert);


        if ($sql->execute()) {
            echo "Cadastro Realizado!";
            echo "<script>window.opener.location.reload(); window.close();</script>";
        } else {
            echo "Não foi possivel cadastrar!";
        }

    }

    if (isset($_POST['cancelar'])) {

        echo "<script>window.close();</script>";
    }
    ?>

</body>

</html>