<?php
session_start() ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../App.css">
  <title>Supermarket - Home</title>
</head>

<body>
  <style>
  section.container {
    background-color: #fff;
    border-radius: 4px;
  }
  </style>
  <div class="App">
    <header class="header">
      <!-- HEADER -->
      <?php include_once('../components/header.php') ?>

    </header>
    <main class="AppBody">
      <!-- content -->
      <?php
      if (empty($_GET)) {
        include_once('../components/menu-options.php');
      } else {
        switch (array_key_first($_GET)) {
          case 'estoque':
            include_once('../pages/pag-estoque.php');
            break;
          case 'empresa':
            include_once('../pages/cad-empresa.php');
            break;
          case 'verprodutos':
            include_once('../pages/show-product.php');
            break;
          case 'produto':
            include_once('../pages/cad-produto.php');
            break;
          case 'attproduto':
            include_once('../pages/att-produto.php');
            break;
          case 'verempresas':
            include_once('../pages/show-companies.php');
            break;
            // Completar o resto do switch
        }
      }
      ?>
      <!-- Card -->
    </main>
    <footer class="footer">
      <!-- FOOTER -->
      <p>Supermarket - Alguns direitos reservados</p>
    </footer>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script>
  const localhost = 'http://localhost/Cursophp/Supermarket/'; // MUDAR AQUI
  </script>
  <script src="../utils/js/attProduto.js"></script>
  <script src="../utils/js/cadEmpresa.js"></script>
  <script src="../utils/js/cadProduto.js"></script>
  <script src="../utils/js/cboEmpresas.js"></script>
  <script src="../utils/js/cboProdutos.js"></script>
  <script src="../utils/js/showCompanies.js"></script>
  <script src="../utils/js/showProduct.js"></script>
  <script src="../utils/js/tblEstoque.js"></script>
</body>

</html>