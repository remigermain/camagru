<?php
use App\Image;
use App\App;
use App\Error;
if (!isset($_GET) || !isset($_GET['id']))
  Error::notFound();  
$val = Image::getImgById($_GET['id']);
if (!$val)
  Error::notFound();
?>
<!--    print images -->
<div class="container">
  <div class="columns is-multiline">
    <div class="column">
      <div class="card">
        <div class="card-image">
          <figure class="image is-4by3">
            <img src="data:image/jpeg;base64, <?= $val['image'] ?>" alt="Placeholder image">
          </figure>
        </div>
        <div class="card-content">
          <div class="media">
            <div class="media-left">
              <figure class="image is-48x48">
                  <img class="is-rounded" src="data:image/jpeg;base64, <?= APP::printString($val['logo']) ?>" alt="Placeholder image">
              </figure>
            </div>
            <a href="../Public/index.php?p=user_home&user=<?= APP::printString($val['pseudo']) ?>">
              <p class="title is-6">@<?= APP::printString($val['pseudo']) ?></p>
            </a>
            <div class="media-right"></div>
          </div>
          <h1 class="tag subtitle is-4"><?= App::printString($val['title']) ?></h1>
          <div class="content"><?= App::printString($val['synopsis']) ?><br></div>
          <a class=""><i class="material-icons">favorite</i>Like</a>
          <div class="field is-grouped is-grouped-multiline">
            <div class="control">
              <!--  tag -->
              <div class="tags has-addons">
                <div class="tag"><time datetime="2016-1-1"><?= APP::printString($val['date']) ?></time></div>
                <a class="tag is-link"><?= APP::printString($val['category']) ?></a>
                <a class="tag is-light">Tag</a>
              </div>
            </div>
          </div>
      </div>
    </div>
<!--    print comment  -->
      <br />
      <article class="media">
        <figure class="media-left">
          <p class="image is-64x64"><img src="../vue/ing/image.png"></p>
        </figure>
        <div class="media-content">
          <div class="content">
            <div class="content">
              <?= $val['synopsis'] ?><br>
              <time datetime="2016-1-1"><?= $val['date'] ?></time>
            </div>
            <a class=""><i class="material-icons">favorite</i>Like</a>
          </div>
          </div>
        </article>
        </div>
      </div>
    </div>
</div>


