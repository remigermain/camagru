<?php
use App\App;
use App\Error;
use App\User;
if (!App::sessionExist())
  Error::notFound();
$info = User::getUserInfo($_SESSION['username']);
$title = "Account profils";
?>
<!-- <div class="container is-fluid"></div> -->
<div class="columns">
  <div class="column"></div>
  <div class="column is-2 box">
    <aside class="menu">
      <p class="menu-label">General</p>
      <ul class="menu-list">
        <li ><a id="AcProf" onclick="UserProf()" class="is-active">Profils modify</a></li>
        <li ><a id="AcPass" onclick="UserPass()">Password change</a></li>
        <li ><a id="AcNotif" onclick="UserNotif()">Notification</a></li>
      </ul>
    </aside>
  </div>
  <!-- profils -->
  <div id="UserEditProf" class="column box is-5">
    <section class="section">
      <div class="container">
        <h1 class="title">Profils</h1>
        <h2 class="subtitle">Change profils!</h2>
      </div>
    </section>
    <form class="container" method="POST" onsubmit="reqUserProfil(); return false;">
      <!-- logo -->
      <div class="buttons is-centered">
        <h2 class="subtitle is-6">Profils pictures</h2>
      </div>
      <div class="buttons is-centered">
        <div class="image is-128x128">
          <img class="is-rounded" src="data:image/jpeg;base64, <?= $info['logo'] ?>" >
        </div>
      </div>
      <div class="file is-warning is-centered">
        <label class="file-label">
          <input class="file-input" type="file" name="fileToUpload" id="fileToUpload" accept="image/jpeg,image/png">
          <span class="button is-link is-hovered">
            <span class="file-icon">
            <i class="material-icons">cloud_upload</i>
          </span>
          <span class="file-label">Open file...</span>
        </label>
      </div>
      <br />
      <!-- user name -->
      <div class="field">
        <label class="label">New username</label>
          <p class="control has-icons-left has-icons-right">
            <input class="input" id="username" pattern="[a-zA-Z0-9].{6,31}" type="text" name="username" placeholder="Username" value="<?= $_SESSION['username'] ?>"">
            <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
            <span class="icon is-small is-right"><i class="fas fa-check"></i></span>
          </p>
        </label>
      </div>
      <!-- mail -->
      <div class="field">
        <label class="label">Email</label>
          <p class="control has-icons-left has-icons-right">
            <input class="input" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" type="email" name="email" placeholder="Email" value="<?= $_SESSION['mail'] ?>">
            <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
            <span class="icon is-small is-right"><i class="fas fa-check"></i></span>
          </p>
        </label>
      </div>
      <div class="field">
        <p class="control">
          <button class="button" id="submit" name="submit" value="change_email">submit</button>
        </p>
      </div>
    </form>
  </div>
  <!--  notification -->
  <div id="UserEditNotif" class="column box is-5" style="display: none;">
    <section class="section">
      <div class="container">
        <h1 class="title">Notification</h1>
        <h2 class="subtitle">Change Notification.</h2>
      </div>
    </section>
    <div class="section">
      <!-- follow -->
      <div class="file is-warning is-boxed">
        <div class="control">
          <label class="radio">
            <input id="NotifFollow" type="checkbox" name="answer" onclick="reqUserNotif()" <?php if($info['notif']['notiffollow']) print("checked") ?>>
            <span class="title is-6"> Users Follow you</span>
          </label>
        </div>
      </div>
      <h2 class="subititle" style="opacity: 0.5;">When user follow or unfollow you.</h2>
      <br /> 
      <!-- comment -->
      <div class="file is-warning is-boxed">
        <div class="control">
          <label class="radio">
            <input id="NotifComment" type="checkbox" name="answer" onclick="reqUserNotif()" value="true" <?php if($info['notif']['notifcomment']) print("checked") ?>>
            <span class="title is-6"> User comment Pictures.</span>
          </label>
        </div>
      </div>
      <h2 class="subititle" style="opacity: 0.5;">When User comment a pictures of you.</h2>
      <br />
      <!-- like -->
      <div class="file is-warning is-boxed">
        <div class="control">
          <label class="radio">
            <input id="NotifLike" type="checkbox" name="answer" onclick="reqUserNotif()" <?php if($info['notif']['notiflike']) print("checked") ?>>
            <span class="title is-6"> Users Like Pictures</span>
          </label>
        </div>
      </div>
      <h2 class="subititle" style="opacity: 0.5;">When User Like pictures of you.</h2>
      <br />
    </div>
  </div>
  <!-- password -->
  <div id="UserEditPass" class="column is-5 box" style="display: none;">
    <section class="section">
      <div class="container">
        <h1 class="title">Password</h1>
        <h2 class="subtitle">Change Password.</h2>
      </div>
    </section>
    <form class="section" method="POST" onsubmit="reqUserPass(); return false;">
      <div class="field">
        <label class="label">Old password</label>
        <p class="control has-icons-left">
          <input class="input" id="oldpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,199}" type="password" name="oldpassword" placeholder="Old Password" required>
        </p>
      </div>
      <div class="field">
        <label class="label">New password</label>
        <p class="control has-icons-left">
          <input class="input" id="newpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,199}" type="password" name="newpassword" placeholder="Password" required>
            <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
        </p>
      </div>
      <div class="field">
        <label class="label">Confirmation New Password</label>
        <p class="control has-icons-left">
          <input class="input" id="confpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,199}" type="password" name="confpassword" placeholder="Confirm Password" required>
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
  <!--  end -->
  <div class="column"></div>
</div>
<div class="container"></div>
<script src="../script/UserAccount.js"></script>
