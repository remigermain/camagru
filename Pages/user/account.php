<?php
use App\App;
use App\Error;
use App\Image;
use App\User;
if (!App::sessionExist())
  Error::notAccess();
$info = User::getUserInfo($_SESSION['pseudo']);
?>
<div class="hero-foot">
  <nav class="tabs">
    <div class="container">
      <ul>
        <li class="is-active"><a>Account Edit</a></li>
      </ul>
    </div>
  </nav>
</div>

<div class="container">
<!-- edit  -->
  <form style="display" class="box">
    <div class="columns">
      <!--  change password -->
      <div class="column is-one-quarter">
        <div class="box">
          <section class="section">
            <div class="container">
              <h2 class="subtitle is-3">Password</h2>
            </div>
          </section>
          <form class="container" method="POST" action="/Server/user_change.php">
            <div class="field">
              <label class="label">Old password</label>
              <p class="control has-icons-left">
                <input class="input" id="pseudo" type="text" name="pseudo" placeholder="Pseudo" required>
              </p>
            </div>
            <div class="field">
            <label class="label">New password</label>
              <p class="control has-icons-left">
                <input class="input" id="password" type="password" name="password" placeholder="Password" required>
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
      </div>
    <!--  change email -->
    <div class="column is-one-quarter">
      <div class="box">
        <section class="section">
            <h3 class="subtitle is-3">New Email</h3>
        </section>
        <form class="container" method="POST" action="/Server/user_change.php">
          <div class="field">
            <label class="label">Email</label>
              <p class="control has-icons-left has-icons-right">
                <input class="input" id="email" type="email" name="email" placeholder="Email" required>
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
    </div>
    <!--  change pseudo -->
    <div class="column is-one-quarter">
        <div class="box">
          <section class="section">
              <h3 class="subtitle is-3">Pseudo</h3>
          </section>
          <form class="container" method="POST" action="/Server/user_change.php">
            <div class="field">
              <label class="label">New pseudo</label>
                <p class="control has-icons-left has-icons-right">
                  <input class="input" id="email" type="text" name="pseudo" placeholder="Email" required>
                  <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                  <span class="icon is-small is-right"><i class="fas fa-check"></i></span>
                </p>
              </label>
            </div>
            <div class="field">
              <p class="control">
                <button class="button" id="submit" name="submit" value="change_pseudo">submit</button>
              </p>
            </div>
          </form>
        </div>
    </div>
    <!--  change pseudo -->
    <div class="column is-one-quarter">
      <div class="box is-centered">
        <section class="section is-centered">
            <h3 class="subtitle is-3">Profils logo</h3>
        </section>
        <form class="container" action="/Server/user_change.php" method="post" enctype="multipart/form-data">
          <div class="buttons is-centered">
            <figure class="image is-128x128">
              <img class="is-rounded" src="data:image/jpeg;base64, <?= $info['logo'] ?>" >
            </figure>
          <h4 class="subtitle is-5">Load image form local.</h4></div>
          <div class="file is-warning is-boxed is-centered">
            <label class="file-label">
              <input class="file-input" type="file" name="fileToUpload" id="fileToUpload" accept="image/jpeg,image/png"required>
                <span class="button is-link is-hovered"><span class="file-icon">
                <i class="material-icons">cloud_upload</i></span>
              <span class="file-label">Open file...</span>
            </label>
          </div>
          <br />
          <div class="file is-warning is-boxed is-centered">
            <label class="file-label">
              <input class="file-input" type="submit" name="submit" value="change_logo" id="fileToUpload">
                <span class="button is-link is-hovered"><span class="file-icon">
                <i class="material-icons">cloud_upload</i></span>
              <span class="file-label">Submit</span>
            </label>
          </div>
        </form>
      </div>
    </div>
  </form> 
  </div>
</div>