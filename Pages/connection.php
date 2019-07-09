<!--  menu style -->
<div class="hero-foot">
  <nav class="tabs">
    <div class="container">
      <ul>
        <?php if (isset($_SESSION) && isset($_SESSION['login'])){ ?>
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
    <div class="field">
      <p class="control">
        <button class="button" id="submit" name="submit" value="login">Login</button>
      </p>
    </div>
  </form>
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
      <label class="label">Pseudo</label>
      <p class="control has-icons-left">
        <input class="input" id="pseudo" type="text" name="pseudo" placeholder="Pseudo" required>
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
        <button class="button" id="submit" name="submit" value="register">Login</button>
      </p>
    </div>
  </form>
</div>
<!--  launch scirpt to change login/register pages whitout refresh -->
<?php if (isset($_SESSION) && isset($_SESSION['login'])) {?>
  <script src="../script/logout.js">< </script>
<?php } else { ?>
  <script src="../script/login.js">< </script>
<?php } ?>
