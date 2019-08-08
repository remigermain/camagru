<?php
use App\App;
use App\Error;
use App\Image;
if (!App::sessionExist())
    Error::notAccess();
$title = $_SESSION['username'] . " upload pictures";
$val = Image::getCategory();
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
    <!--  upload -->
    <form class="columns is-multiline" onsubmit="uploadImg(); return false;">
      <div class="column box">
        <div class="modal-card">
          <header class="modal-card-head">
            <p class="modal-card-title">Pictures</p>
            <!-- select -->
            <div class="field">
              <div class="control has-icons-left">
                <div class="select is-rounded">
                  <select id="selectSource">
                    <option selected>Upload form local</option>
                    <option>Take form camera</option>
                  </select>
                </div>
                <div class="icon is-small is-left">
                  <i class="material-icons">monochrome_photos</i>
                </div>
              </div>
            </div>
          </header>
          <div class="modal-card-body">
            <!-- upload previeuw -->
            <img id="imgInp">
            <!-- camera previeuw -->
            <canvas id='canvas' width='100' height='100'></canvas> 
          </div>
          <div class="modal-card-body">
            <!-- upload -->
            <div class="file is-info has-name" id="displayUpload">
              <label class="file-label">
                <input id="imageUpload" onchange="loadFile(event)" class="file-input" type="file" name="resume" accept="image/jpeg,image/png" required>
                <span class="file-cta">
                  <span class="file-icon">
                    <i class="fas fa-upload"></i>
                  </span>
                  <span id="uploadImage" lass="file-label"> Upload from local. &emsp;<i class="material-icons">cloud_upload</i>
                  </span>
                </span>
                <span id="fileName" class="file-name">No files</span>
              </label>
            </div>
          </div>
          <!-- camera -->
          <div class="file is-info has-name" id="displayCamera" style="display: none;">
            <label class="file-label">
              <button onchange="loadFile(event)" class="file-input" type="file" name="resume">
              <span class="file-cta">
                <span class="file-icon">
                  <i class="fas fa-upload"></i>
                </span>
                <span id="uploadImage" lass="file-label"> Upload from local. &emsp;<i class="material-icons">cloud_upload</i>
                </span>
              </span>
              <span id="fileName" class="file-name">No files</span>
            </label>
          </div>
        </div>
        <!-- end -->
      </div>
      <!-- information image -->
      <div class="column box">
        <div class="modal-card">
          <header class="modal-card-head">
            <p class="modal-card-title">Information</p>
          </header>
          <section class="modal-card-body">
            <h2 class="subtitle is-4">Title</h1>
            <input id="title" type="textarea" class="textarea" value="" required>
            <h2 class="subtitle is-4">Synopsis</h1>
            <textarea id="synopsys" type="textarea" class="textarea" required></textarea>
            <!-- category -->
            <h2 class="subtitle is-4">Category</h1>
            <div class="control" >
              <?php foreach($val as $key => $key2) { ?>
                <label class="radio"><input type="radio" name="categoryId" id="categoryId" value="<?= $key2['id'] ?>" <?php if ($key2['id'] == 0) print(checked) ?>><?= $key2['name'] ?></label>
              <?php } ?>
            </div>
          </section>
          <button class="button is-link" >Save changes</button>
          <button class="button" aria-label="close" >Cancel</button>
        </div>
      </div>
    <!--  camera -->
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
    <div class="modal-card-body">
      <!-- upload previeuw -->
      <img id="imgInp">
      <!-- camera previeuw -->
      <canvas id='canvas' width='100' height='100'></canvas> 
    </div>
    <div class="file is-info has-name" id="displayUpload">
      <label class="file-label">
        <input id="imageUpload" onchange="loadFile(event)" class="file-input" type="file" name="resume" accept="image/jpeg,image/png" required>
        <span class="file-cta">
          <span class="file-icon">
            <i class="fas fa-upload"></i>
          </span>
          <span id="uploadImage" lass="file-label"> Upload from local. &emsp;<i class="material-icons">cloud_upload</i>
          </span>
        </span>
        <span id="fileName" class="file-name">No files</span>
      </label>
    </div>
  </div>
</form>
<script src="../script/image.js"></script>
