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
        <h2 class="subtitle">Upload opr take picture from camera images !</h2>
      </div>
    </section>
    <form action="/Server/upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload" required>
    <input type="submit" value="Upload Image" name="submit">
  </form>
</div>
<div class="container" id="formedit" style="display: none">
    <section class="section">
      <div class="container">
        <h1 class="title">Edit</h1>
        <h2 class="subtitle">Edit, modify images !</h2>
      </div>
    </section>
    <form action="/Server/upload.php" method="post" enctype="multipart/form-data">
      Select image to upload:
     <input type="file" name="fileToUpload" id="fileToUpload" required>
    <input type="submit" value="Upload Image" name="submit">
  </form>
</div>
<script src="../script/image.js">< </script>
