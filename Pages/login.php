<!--  menu style -->
<div class="hero-foot">
  <nav class="tabs">
    <div class="container">
      <ul>
        <li id="login_active"><a onclick="displayLogin()">Login</a></li>
        <li id="register_active"><a onclick="displayRegister()">register</a></li>
      </ul>
    </div>
  </nav>
</div>
<!--  login -->
<div class="container" id="formLogin">
  <section class="section">
    <div class="container">
      <h1 class="title">Login</h1>
      <h2 class="subtitle">login you to take more features !</h2>
    </div>
  </section>
  <form class="container" method="POST" action="/login.php">
    <div class="field">
        <label class="label">Email</label>
        <p class="control has-icons-left has-icons-right">
          <input class="input" type="email" placeholder="Email">
            <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
            <span class="icon is-small is-right"><i class="fas fa-check"></i></span>
        </p>
      </div>
    <div class="field">
      <label class="label">Password</label>
      <p class="control has-icons-left">
        <input class="input" type="password" name="password" placeholder="Password">
          <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
      </p>
    </div>
    <div class="field">
      <p class="control">
        <button class="button ">Login</button>
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
  <form class="container" method="POST" action="/register.php">
    <div class="field">
      <label class="label">Pseudo</label>
      <div class="control">
        <input class="input" type="text" placeholder="Text input">
      </div>
    </div>
    <div class="field">
        <label class="label">Email</label>
        <p class="control has-icons-left has-icons-right">
          <input class="input" type="email" placeholder="Email">
            <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
            <span class="icon is-small is-right"><i class="fas fa-check"></i></span>
        </p>
    </div>
    <div class="field">
        <label class="label">Password</label>
        <p class="control has-icons-left">
          <input class="input" type="password" placeholder="Password">
            <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
        </p>
    </div>
    <div class="field">
        <label class="label">Confirm Password</label>
        <p class="control has-icons-left">
          <input class="input" type="password" placeholder="Confirm Password">
            <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
        </p>
    </div>
    <div class="field">
      <p class="control">
        <button class="button">Login</button>
      </p>
    </div>
  </form>
</div>
<!--  launch scirpt to change login/register pages whitout refresh -->
<script src="../script/login.js">< </script>