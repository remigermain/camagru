<?php
use App\App;
?>
<!--  menu style -->
<div class="hero-foot">
  <nav class="tabs">
    <div class="container">
      <ul>
        <?php if (App::sessionExist()){ ?>
            <li class="is-active"><a>logout</a></li>
        <?php } else { ?>
          <li id="login_active"><a onclick="displayLogin()">Login</a></li>
          <li id="register_active"><a onclick="displayRegister()">register</a></li>
          <?php } ?>
      </ul>
    </div>
  </nav>
</div>
<!-- logout -->
<div class="container" id="formLogout">
  <section class="section">
    <div class="container">
      <h1 class="title">Logout</h1>
      <h2 class="subtitle">logout, see you soon !</h2>
    </div>
  </section>
  <form class="container" id="formlogout" method="POST" action="/Server/connection.php">
    <div class="field">
      <p class="control">
        <button class="button" id="submit" name="submit" value="logout">Logout</button>
      </p>
    </div>
  </form>
</div>
<!--  login -->
<div class="container" id="formLogin">
  <section class="section">
    <div class="container">
      <h1 class="title">Login</h1>
      <h2 class="subtitle">login you to take more features !</h2>
    </div>
  </section>
  <form class="container" id="formlogin" method="POST" action="/Server/connection.php">
    <div class="field">
      <label class="label">Email</label>
      <p class="control has-icons-left">
        <input class="input" id="email" type="email" name="email" placeholder="Email" required>
          <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
          <span class="icon is-small is-right"><i class="fas fa-check"></i></span>
      </p>
    </div>
    <div class="field">
      <label class="label">Password</label>
      <p class="control has-icons-left">
        <input class="input" id="password" type="password" name="password" placeholder="Password" required>
          <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
      </p>
    </div>
    <!--   forgot password -->

    <div class="field">
      <p class="control">
        <button class="button" id="submit" name="submit" value="login">Login</button>
      </p>
    </div>
  </form>



    <a id="delete" class="" onclick="display_modal_forgot()">Forgot password ?</a>
     <div id="modal_forgot" class="modal">
      <div id="back_forgot" class="modal-background"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title">Forgot password</p>
          <button id="close_forgot" class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
          <h1 class="subtitle is-4">Email</h1>
            <input class="input" id="email_forgot" type="email" name="email" placeholder="Email" required>
          </h1>
        </section>
        <footer class="modal-card-foot">
          <button id="submit_forgot" class="button is-link" onclick="reqForgotpassword()">Submit</button>
          <button id="cancel_forgot" class="button" aria-label="close" >Cancel</button>
        </footer>
      </div>
    </div>



</div>
<!--  register -->
<div class="container" id="formRegister" style="display: none">
  <section class="section">
    <div class="container">
      <h1 class="title">Register</h1>
      <h2 class="subtitle">Welcome to <strong>Camagru</strong>, take pictures and have fun !</h2>
    </div>
  </section>
  <form class="container" method="POST" action="/Server/connection.php">
    <div class="field">
      <label class="label">Username</label>
      <p class="control has-icons-left">
        <input class="input" id="username" type="text" name="username" placeholder="Username" required>
      </p>
    </div>
    <div class="field">
        <label class="label">Email</label>
        <p class="control has-icons-left has-icons-right">
          <input class="input" id="email" type="email" name="email" placeholder="Email" required>
            <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
            <span class="icon is-small is-right"><i class="fas fa-check"></i></span>
        </p>
    </div>
    <div class="field">
        <label class="label">Password</label>
        <p class="control has-icons-left">
          <input class="input" id="password" type="password" name="password" placeholder="Password" required>
            <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
        </p>
    </div>
    <div class="field">
        <label class="label">Confirm Password</label>
        <p class="control has-icons-left">
          <input class="input" id="confpassword" type="password" name="confpassword" placeholder="Confirm Password" required>
            <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
        </p>
    </div>
    <div class="field">
      <p class="control">
        <button class="button" id="submit" name="submit" value="register">Register</button>
      </p>
    </div>
  </form>
</div>
<!--  launch scirpt to change login/register pages whitout refresh -->
<?php if (App::sessionExist()) {?>
  <script src="../script/logout.js">< </script>
<?php } else { ?>
  <script src="../script/login.js">< </script>
<?php } ?>
