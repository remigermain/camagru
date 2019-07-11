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
      $val = Image::getUserImg($_SESSION['pseudo']);
      ?>
      <div class="box">
          <table class="table">
              <thead>
                  <tr>
                    <th><abbr title="Position">Pos</abbr></th>
                    <th>Photos</th>
                    <th><abbr title="Like">Likes</abbr></th>
                    <th><abbr title="Comment">Comments</abbr></th>
                    <th><abbr title="category">category</abbr></th>
                  </tr>
              </thead>
              <tbody>
              <?php $i = 0; foreach ($val as $key => $key2)
              {?>
                <tr>
                  <th><?= $i++ ?></th>
                  <td><a href="../Public/index.php?p=image&id=<?= $key2['image_id'] ?>" title="<?= $key2['title'] ?>"><?= $key2['title'] ?></a></td>
                  <td><? $key2['like'] ?></td>
                  <td><?= Image::synopsis($key2['synopsis']) ?></td>
                  <td><?= $key2['category'] ?></td>
                </tr>
              <?php
              } ?>
              </tbody>
          </table>
      </div>
  </form>
<!-- edit  -->
  <form id="form-edit" style="display: none" class="box">
  <?php
    ?>
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
              <img class="is-rounded" src="data:image/jpeg;base64, <?= $key2['logo'] ?>" >
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
<!--  contact  -->
  <form id="form-cont" style="display: none">
  </form>
</div>
</div>
<script src="/Script/account.js"></script>