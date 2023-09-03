<style>
/* HEADER */
.header {
  display: flex;
  justify-content: center;
  box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.1);
  position: fixed;
  width: 100%;
  z-index: 100;
  background: white;
  top: 0px;
}

.nav {
  display: flex;
  justify-content: space-between;
  width: max-content;
  align-items: center;
  height: 4rem;
}

.nav ul.menu {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
}

.nav ul.menu li {
  margin-right: 20px;
}

.nav ul.menu li a {
  color: #764701;

}

.nav ul.menu li.dropdown:hover .dropdown-menu {
  display: block;

}

.nav ul.menu li.dropdown .dropdown-menu {
  display: none;
  position: absolute;
  background-color: #fb1;
  border-radius: 0 0 4px 4px;
  box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.2);
}

.nav ul.menu li.dropdown .dropdown-menu li {
  padding: 10px;
}

.nav ul.menu li.dropdown .dropdown-menu li:hover {
  background-color: #fff;
}

.button {
  padding: .5rem 1rem;
  border-radius: .875rem;
  background-color: #ffd262;
}

.button:hover {
  background-color: #fb1;

}
</style>

<nav class="nav">
  <ul class="menu">
    <?php
    if (isset($_SESSION['login'])) {
      echo "<li><a href='?home' class=\"button\">Home</a></li>";
      if (isset($_GET['home'])) {
        header('Location: ../pages/menu.php');
      } else {
        header('Location: ./index.php');
      }
    }
    ?>
    <li class="dropdown">
      <a href="#" class="button">Cadastro</a>
      <ul class="dropdown-menu">
        <li><a href="?empresa">Cad. Empresas</a></li>
        <li><a href="?attproduto">Atribuir Produtos</a></li>
        <li><a href="?verprodutos">Ver Produtos</a></li>
        <li><a href="?produto">Cad. Produtos</a></li>
        <li><a href="?estoque">Ver Estoque</a></li>
      </ul>
    </li>
    <li>
      <?php
      if (isset($_SESSION['login'])) {
        echo "<a href='?logout' class=\"button\">Logout</a>";
        if (isset($_GET['logout'])) {
          unset($_SESSION['login']);
          session_destroy();
          header('Location: ../index.php');
        }
      } else {
        echo "<p>Supermarket</p>";
      }
      ?>
    </li>
  </ul>
</nav>