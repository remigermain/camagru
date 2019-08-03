<?php
use App\App;
use App\Error;
if (!App::sessionExist())
    Error::notAccess();
$title = $_SESSION['username'] . " upload pictures";
?>
<div class="hero-foot">
    <nav class="tabs">
      <div class="container">
        <ul>
          <li id="upload_active"><a onclick="displayupload()">Image</a></li>
          <li id="edit_active"><a onclick="displayedit()">Edit</a></li>
        </ul>
      </div>
    </nav>
  </div>
  <div class="container" id="formupload">
    <section class="section">
      <div class="container">
        <h1 class="title">Image</h1>
        <h2 class="subtitle">Upload or take picture from camera images !</h2>
      </div>
    </section>    
    <div class="box">
      <form class="container" action="/Server/upload.php" method="post" enctype="multipart/form-data">
        <div class="buttons is-centered"><h3 class="title">Load image form local.</h3></div>
        <div class="file is-warning is-boxed is-centered">
          <label class="file-label">
            <input class="file-input" type="file" name="fileToUpload" id="fileToUpload" accept="image/jpeg,image/png"required>
              <span class="file-cta"><span class="file-icon">
              <i class="material-icons">cloud_upload</i></span>
            <span class="file-label">Open file...</span>
          </label>
        </div>
        <br />
        <div class="file is-warning is-boxed is-centered">
          <label class="file-label">
            <input class="file-input" type="submit" name="submit" value="submit" id="fileToUpload">
              <span class="file-cta"><span class="file-icon">
              <i class="material-icons">cloud_upload</i></span>
            <span class="file-label">send</span>
          </label>
        </div>
      </form>
    </div>
    <div class="box">
      <video class="video" id="video" width="640" height="480" autoplay></video>
      <canvas id="canvas" width="20" height="20"></canvas>
      <div class="file is-warning is-boxed is-centered">
        <label class="file-label">
          <input class="file-input" type="file" name="fileToUpload" id="fileToUpload">
            <span class="file-cta"><span class="file-icon">
            <i class="material-icons">monochrome_photos</i></span>
          <span class="file-label">Take photos..</span>
        </label>
      </div>
      <br />
      <div class="file is-warning is-boxed is-centered">
          <label class="file-label">
            <input class="file-input" type="submit" name="submit" value="submit" id="fileToUpload">
              <span class="file-cta"><span class="file-icon">
              <i class="material-icons">cloud_upload</i></span>
            <span class="file-label">send</span>
          </label>
        </div>
    </div>
  </div>
</div>
  <!--    edit mode -->
  <div class="container is-center" id="formedit" style="display: none">
    <section class="section">
      <div class="container is-center">
        <h1 class="title">Edit</h1>
        <h2 class="subtitle">Edit, modify images !</h2>
      </div>
    </section>
  </div>
</div>
<script src="../script/image.js"></script>
