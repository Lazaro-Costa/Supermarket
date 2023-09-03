<?php session_start() ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./App.css">

  <title>Supermarket</title>
</head>

<body>
  <div class="App">
    <header class="header">
      <!-- HEADER -->
      <?php include_once('./components/header.php') ?>

    </header>
    <main class="AppBody">
      <!-- Login -->
      <?php
      if (!isset($_SESSION['login'])) {
        if (isset($_POST['acao'])) {

          $userForm = $_POST['user'];
          $senhaForm = $_POST['senha'];

          if ($userForm && $senhaForm == 'root') {
            $_SESSION['login'] = 'root'; // nome do usuario
            header('Location: index.php');
          } else {
            echo "<h1>Dados Inválidos</h1>";
          }
        }
        include_once('./utils/login.php');
      } else {
        header('Location: ./pages/menu.php');
      }
      ?>
    </main>
    <footer class="footer">
      <!-- FOOTER -->
      <p>Supermarket - Alguns direitos reservados</p>
    </footer>
  </div>
</body>

</html>