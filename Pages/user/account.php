<?php
use App\App;
use App\Error;
use App\Image;
use App\User;
if (!App::sessionExist())
  Error::notFound();
$info = User::getUserInfo($_SESSION['username']);
?>
<div class="container">
  <div class="columns is-multiline">
    <div class="card">
      <div class="card-image">
        erfrefer
      </div>
    </div>
  </div>
</div>