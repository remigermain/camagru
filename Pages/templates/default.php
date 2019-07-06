<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Hello Bulma!</title>
        <link rel="stylesheet" href="../vue/header.css">
        <link rel="stylesheet" href="../vue/bluma.css">
       <!-- <link rel="stylesheet" href="../vue/material.css"> -->
  </head>
  <header>
    <section class="home">
        <nav class="navbar is-white">
            <div class="navbar-brand">
                <a href="../Public/index.php?=home"><img src="../vue/img/logo.png" class="logo" /><span class="logo_text">camagru</span></a>
                <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span></a>
            </div>
            <div class="navbar-menu">
                <div class="navbar-start" style="flex-grow: 1; justify-content: center;" >
                    <div class="navbar-item field " >
                        <input class="input is-rounded " type="text" placeholder="search">
                    </div>
                </div>
                <!-- if $_session is co -->
                <div class="navbar-end">
                    <a class="navbar-item" href="../Public/index.php?p=account_images"><i class="material-icons">add_a_photo</i></a>
                    <a class="navbar-item" href="../Public/index.php?p=account_home"><i class="material-icons">home</i></a>
                    <a class="navbar-item" href="../Public/index.php?p=account_images"><i class="material-icons">notifications</i></a>
                    <a class="navbar-item" href="../Public/index.php?p=account"><i class="material-icons">account_circle</i></a>
                    <a class="navbar-item" href="../Public/index.php?p=login"><i class="material-icons">settings</i></a>
                </div>
            </div>
        </nav>
    </section>
</header>
  
  <?= $content ?>

<footer class="footer">
  <div class="content has-text-centered">
    <p>
      <strong>Camagru</strong> by <a href="https://profile.intra.42.fr/users/rgermain">GERMAIN Remi</a>. The source code is on
      <a href="https://framagit.org/rgermain/camagru">framagit</a>. The website made withe
      <a href="https://bulma.io/">Bluma</a>.
    </p>
  </div>
</footer>