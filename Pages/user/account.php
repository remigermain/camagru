<?php
use App\App;
use App\Error;
use App\Image;
use App\User;
if (!App::sessionExist())
  Error::notFound();
$info = User::getUserInfo($_SESSION['username']);
?>
<div class="columns">
  <div class="column"></div>
  <div class="column is-2 box">
    <aside class="menu">
      <p class="menu-label">General</p>
      <ul class="menu-list">
        <li><a>Profils modify</a></li>
        <li><a>Password change</a></li>
        <li><a>Notification</a></li>
      </ul>
    </aside>
  </div>
  <!-- profils
  <div id="" class="column box is-5">
    <section class="section">
      <div class="container">
        <h1 class="title">Profils</h1>
        <h2 class="subtitle">Change profils!</h2>
      </div>
    </section>
    <form>
      <input type="text" placeolder="username">

    </form>
  </div>-->
  <!-- password --><!--
  <div id="" class="column is-5 box">
    <div class="">
      <section class="section">
        <div class="container">
          <h2 class="subtitle is-3">Password</h2>
        </div>
      </section>
      <form class="container" method="POST" onsubmit="reqUserPass(); return false;">
        <div class="field">
          <label class="label">Old password</label>
          <p class="control has-icons-left">
            <input class="input" id="password" type="text" name="oldpassword" placeholder="Old Password" required>
          </p>
        </div>
        <div class="field">
          <label class="label">New password</label>
          <p class="control has-icons-left">
            <input class="input" id="password" type="password" name="newpassword" placeholder="Password" required>
              <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
          </p>
        </div>
        <div class="field">
          <label class="label">Confirmation New Password</label>
          <p class="control has-icons-left">
            <input class="input" id="confpassword" type="password" name="confpassword" placeholder="Confirm Password" required>
            <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
          </p>
        </div>
        <div class="field">
          <p class="control">
            <button class="button" id="submit" name="submit" value="change_password">submit</button>
          </p>
        </div>
      </form>
    </div>
  </div>-->
  <!--  notification -->
  <div id="" class="column box is-5">
    <section class="section">
      <div class="container">
        <h1 class="title">Notification</h1>
        <h2 class="subtitle">Change Notification!</h2>
      </div>
    </section>
    <form class="container" onsubmit="reqUserNotif(); return false;" method="post" enctype="multipart/form-data">
    <!-- tutu -->
      <h2 class="subtitle has-text-centered">Users Follow you.</h2>
      <div class="file is-warning is-boxed is-centered">
        <div class="control">
          <label class="radio">
            <input id="noti_no" type="checkbox" name="answer">
          </label>
        </div>
      </div>

    <!-- tutu -->
    <h2 class="subtitle has-text-centered box">Users Comment Pictures.</h2>
      <div class="file is-warning is-boxed is-centered">
        <div class="control">
          <label class="radio">
            <input id="noti_yes" type="radio" name="answer">Yes
          </label>
          <label class="radio">
            <input id="noti_no" type="radio" name="answer">No
          </label>
        </div>
      </div>

      <!-- tutu -->
      <h2 class="subtitle has-text-centered box">Users Like Pictures.</h2>
      <div class="file is-warning is-boxed is-centered">
        <div class="control">
          <label class="radio">
            <input id="noti_yes" type="radio" name="answer">Yes
          </label>
          <label class="radio">
            <input id="noti_no" type="radio" name="answer">No
          </label>
        </div>
      </div>

      <!-- tutu -->
      <h2 class="subtitle has-text-centered box">Change Notification!</h2>
      <div class="file is-warning is-boxed is-centered">
        <div class="control">
          <label class="radio">
            <input id="noti_yes" type="radio" name="answer">Yes
          </label>
          <label class="radio">
            <input id="noti_no" type="radio" name="answer">No
          </label>
        </div>
      </div>


      <br />
      <div class="field">
          <p class="control">
            <button class="button" id="submit" name="submit" value="change_username" >submit</button>
          </p>
      </div>
    </form>
  </div>
  <!-- password -->
  <div class="column"></div>
</div>
<div class="container"></div>
