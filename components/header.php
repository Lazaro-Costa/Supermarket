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
  margin-top: 5px;
  border-radius: 5px;

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
  background-color: #ffde8b;
  width: 100%;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
}

.button {
  padding: .5rem 1rem;
  border-radius: .875rem;
  background-color: #ffde8b;
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
    }
    if (isset($_GET['home'])) {
      if (isset($_SESSION['login'])) {
        header('Location: ../pages/menu.php');
      } else {
        header('Location: ./index.php');
      }
    }
    ?>

    <?php
    if (isset($_SESSION['login'])) {
      include_once('../components/drop-down.php');
    }
    ?>

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