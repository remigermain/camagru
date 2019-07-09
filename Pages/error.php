<div class="hero-body">
    <div class="container has-text-centered">
      <h2 class="subtitle">
      <?php
            if (isset($_GET['error']))
              $error = $_GET['error'];
            else
              $error = "Error 404";
            print $error;
            ?>
            <h1 class="title">
              <i class="material-icons">error</i>
            </h1>
      </h2>
    </div>
  </div>
