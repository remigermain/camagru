<?php

    if (isset($_GET['cat']))
        $cat = $_GET['cat'];
    else
        $cat = 'base';
?>
<div class="hero-foot">
    <nav class="tabs">
      <div class="container">
        <ul>
          <li <?php
          if ($cat === 'base')
            echo 'class="is-active"';?>><a href="../Public/index.php?p=login&cat=base">Login</a></li>
          <li <?php
          if ($cat === 'register')
            echo 'class="is-active"';?>><a href="../Public/index.php?p=login&cat=register">register</a></li>
        </ul>
      </div>
    </nav>
  </div>
  <?php if ($cat === 'base')
            require '../Pages/form_login.php';
        else
            require '../Pages/form_register.php';
?>