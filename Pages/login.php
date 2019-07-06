
<div class="hero-foot">
    <nav class="tabs">
      <div class="container">
        <ul>
          <li <?php
          if (!isset($_GET['cat']))
            echo 'class="is-active"';?>><a href="../Public/index.php?p=login">Login</a></li>
          <li <?php
          if (isset($_GET['cat']))
            echo 'class="is-active"';?>><a href="../Public/index.php?p=login&cat=register">register</a></li>
        </ul>
      </div>
    </nav>
  </div>

<?php

  if (isset($_GET['cat']))
    require '../Pages/form_register.php';
  else
    require '../Pages/form_login.php';
  ?>