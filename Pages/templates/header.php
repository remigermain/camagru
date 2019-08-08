<?php
use App\App;
use App\User;
App::session();
?>
<body class="Site">
  <head>
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="shortcut icon" href="../vue/img/logo.png">
          <title><?= $title ?></title>
          <link rel="stylesheet" href="../vue/header.css">
          <link rel="stylesheet" href="../vue/bluma.css">
          <link rel="stylesheet" href="../vue/material.css">
          <script src="../script/notification.js"></script>
          <script src="../script/common.js"></script>
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
                <div class="navbar-start" style="flex-grow: 1; justify-content: center; margin: 5px;" >
                  <div class="control has-icons-right">
                    <input id="sugestionInput" class="input is-info" type="text" placeholder="Search">
                    <span class="icon is-right">
                      <i class="material-icons">search</i>
                    </span>
                  </div>
                </div>
              </div>
                  <div class="navbar-end">
                  <?php
                    if (App::sessionExist())
                    {
                      $logo = User::getUserInfo($_SESSION['username']);
                      ?>
                        <a class="navbar-item" href="../Public/index.php?p=upload_image"><i class="material-icons">add_a_photo</i></a>
                        <a class="navbar-item" href="../Public/index.php?p=user_home&user=<?=$_SESSION['username']?>">
                          <i class="material-icons">home</i></a>
                        <a class="navbar-item" href="../Public/index.php?p=account">
                          <div class="image">
                            <img class="logo is-rounded" src="data:image/jpeg;base64, <?= $logo['logo'] ?>">
                          </div>
                          <!-- <i class="material-icons">account_circle</i> -->
                        </a>
                        <div class="navbar-item">
                          <form class="container" id="formlogout" method="POST" onsubmit="reqLogout(); return false;">
                            <div class="field">
                              <p class="control">
                                <button class="button" id="submit" name="submit" value="logout">
                                  <i class="material-icons">exit_to_app</i>
                                Logout</button>
                              </p>
                            </div>
                          </form>
                        </div>
                  <?php
                    } else {?>
                    <a class="navbar-item" href="../Public/index.php?p=connection"><i class="material-icons">settings</i></a>
                    <?php } ?>
                  </div>
              </div>
          </nav>
      </section>
    </header>
    <!--  notification -->
    <div><div class="container column" id="notif"></div></div>
    <div class="container"><div class="columns is-multiline" id="sugestionDiv"></div></div>
    <script>
    const text = document.getElementById('sugestionInput')
    text.onkeyup = function () {
      sugestion(text.value);
    };
    </script>
  