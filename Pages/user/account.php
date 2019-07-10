<?php
use App\App;
use App\Error;
if (!App::sessionExist())
    Error::notAccess();
?>
<div class="hero-foot">
  <nav class="tabs">
    <div class="container">
      <ul>
        <li id="over-active"><a onclick="displayOver()">Overview</a></li>
        <li id="edit-active"><a onclick="displayEdit()">Account Edit</a></li>
        <li id="cont-active"><a onclick="displayCont()">Contact</a></li>
      </ul>
    </div>
  </nav>
</div>
<!--  overview  -->
<div class="container">
  <form id="form-over">
    <?php
      use App\Image;
      $val = Image::getUserImg($_SESSION['pseudo']);
      require (App::require_file("/Pages/user/user_overview.php"));
    ?>
  </form>
<!-- edit  -->
  <form id="form-edit" style="display: none">
  </form>
<!--  contact  -->
  <form id="form-cont" style="display: none">
  </form>
</div>
<script src="/Script/account.js"></script>