
<div class="hero-foot">
  <nav class="tabs">
    <div class="container">
      <ul>
        <li><a id="id_loing" onclick="displayLogin()">Login</a></li>
        <li><a id="id_register" onclick="displayRegister()">register</a></li>
      </ul>
    </div>
  </nav>
</div>

<?php
  require '../Pages/form_login.php';
?>

<script>
  const login = document.getElementById("formLogin");
  const register = document.getElementById("formRegister");
  //const login = document.getElementById("id_Login");
  //const register = document.getElementById("formRegister");

  //class="is-active"

  function displayRegister () 
  {
    login.style.display = "none";
    register.style.display = "block";
  }

  function displayLogin()
  {
    login.style.display = "block";
    register.style.display = "none";
  }
</script>