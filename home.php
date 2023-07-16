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
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css">

</head>

<body>
<div class="container is-fluid">


  <div class="column">
    <p class="bd-notification is-danger">
    <section class="hero is-small is-primary">
      <div class="hero-body">
        <p class="title">
          Titulo
        </p>
        <p class="subtitle">
          Subtitulo
        </p>
      </div>
    </section>
    </p>
    <div class="columns">
      <div class="column is-1">
        <p class="bd-notification is-danger">

          </br>
        <aside class="menu">
          <p class="menu-label">
            Gestão
          </p>
          <ul class="menu-list">
            <li><a href="home.php">Alunos</a></li>
            </br>
          </ul>
          <p class="menu-label">
            Outros
          </p>
          <ul class="menu-list">
            <li><a href="home.php"></a></li>
            </br>
            </br>
          </ul>
        </aside>
        </p>
      </div>
      <div class="column">
        <p class="bd-notification is-danger">
</br>
        <h1 class="title has-text-centered">Lista Alunos
<!--onClick="window.open('cria_aluno.php','name','width=600,height=400')-->
        <a href="" target="popup" onClick="window.open('cria_aluno.php')" class="button is-primary is-rounded is-focused"><span class="icon"><i class="mdi mdi-plus"></i></span></a>
        </h1>
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
              <tr class="is-selected">
                <th class="table-info" scope="col">NOME</th>
                <th class="table-info" scope="col">MATRICULA</th>
                <th class="table-info" scope="col">CPF</th>
                <th class="table-info" scope="col">ENDEREÇO</th>
                <th class="table-info" scope="col">CELULAR</th>
                <th class="table-info" scope="col">ANIVERSARIO</th>
                <th class="table-info" scope="col">CEP</th>
                <th class="table-info" scope="col">E-MAI</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = $conn->prepare("SELECT * FROM cristiano.estudante_basico order by nome desc");
              $sql->setFetchMode(PDO::FETCH_ASSOC);
              $sql->execute();
              while ($row = $sql->fetch()) {
                echo "<tr>" .
                  "<th>" . $row["nome"] . "</th>" .
                  "<th><a class='tag is-link is-normal' href='edita_aluno.php?matricula=".$row["matricula"]."'>" . $row["matricula"] . "</a></th>" .
                  "<th>" . $row["cpf"] . "</th>" .
                  "<th>" . $row["endereco"] . "</th>" .
                  "<th>" . $row["celular"] . "</th>" .
                  "<th>" . $row["aniversario"] . "</th>" .
                  "<th>" . $row["cep"] . "</th>" .
                  "<th>" . $row["email"] . "</th>" .
                  "</tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
        </p>
      </div>
    </div>
  </div>
  </div>
  <footer class="footer">
    <div class="content has-text-centered">
      <p>
        <strong>Development</strong> by <a href="https://jgthms.com">Pablo Skovronski Alves</a>. The source code is licensed
        <a href="http://opensource.org/licenses/mit-license.php">MIT</a>. The website content
        is licensed <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">CC BY NC SA 4.0</a>.
      </p>
    </div>
  </footer>
  </div>

</script>
</body>

</html>