<body class="Site">
  <head>
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <title><?= $title ?></title>
          <link rel="stylesheet" href="../vue/header.css">
          <link rel="stylesheet" href="../vue/bluma.css">
          <link rel="stylesheet" href="../vue/material.css">
    </head>
    <header>
      <section class="home">
          <nav class="navbar is-light">
              <div class="navbar-brand">
                  <a href="../Public/index.php?p=home"><img src="../vue/img/logo.png" class="logo" /><span class="logo_text">camagru</span></a>
                  <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                  </a>
              </div>
              <div class="navbar-menu">
                  <div class="navbar-start" style="flex-grow: 1; justify-content: center;" >
                      <div class="navbar-item field " >
                          <input class="input is-rounded " type="text" placeholder="search">
                      </div>
                  </div>
                  <div class="navbar-end">
                  <?php
                    use App\App;
                    if (App::sessionExist())
                    {?>
                        <a class="navbar-item" href="../Public/index.php?p=user_upload"><i class="material-icons">add_a_photo</i></a>
                        <a class="navbar-item" href="../Public/index.php?p=user_home&user=<?=$_SESSION['pseudo']?>"><i class="material-icons">home</i></a>
                        <a class="navbar-item" href="../Public/index.php?p=notification"><i class="material-icons">notifications</i></a>
                        <a class="navbar-item" href="../Public/index.php?p=account"><i class="material-icons">account_circle</i></a>
                  <?php
                    }?>
                    <a class="navbar-item" href="../Public/index.php?p=connection"><i class="material-icons">settings</i></a>
                  </div>
              </div>
          </nav>
      </section>
  </header>
  <main class="Site-content">
    <!-- print previous content -->
    <?= $content ?>
  </main>
  <footer class="footer" style="margin-top: 20px;">
    <div class="content has-text-centered">
      <p>
        <strong>Camagru</strong> by <a href="https://profile.intra.42.fr/users/rgermain">GERMAIN Remi</a>. The source code is on
        <a href="https://framagit.org/rgermain">framagit</a>. The website made withe
        <a href="https://bulma.io/">Bluma</a>.
      </p>
    </div>
  </footer>
</body>