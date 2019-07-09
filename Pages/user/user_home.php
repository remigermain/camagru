<!--  page  -->
<?php
 use App\Image;
 use App\App;
 use App\Error;
if (!isset($_GET['user']) || !APP::userexist($_GET['user']))
  Error::notFound();
print(Image::printHome($_GET['user']));
?>
<!--  menu -->
  <div class="hero-foot">
    <nav class="tabs">
      <div class="container">
        <ul>
          <li class="is-active"><a>Overview</a></li>
        </ul>
      </div>
    </nav>
  </div>
<!--  image -->
 <?php
  Image::printImg($_GET['user']);
?>