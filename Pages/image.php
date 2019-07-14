<?php
use App\Image;
use App\App;
use App\Error;
use App\Comment;
if (!isset($_GET) || !isset($_GET['id']))
  Error::notFound();  
$val = Image::getImgById($_GET['id']);
if (!$val)
  Error::notFound();
$com = Comment::getCommentImage($_GET['id']);
?>
<div class="hero-foot">
  <nav class="tabs">
    <div class="container">
      <ul>
        <li class="is-active"><a>Image</a></li>
      </ul>
    </div>
  </nav>
</div>
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
          <?php $like = Image::userLikeImage($_GET['id']); {?>
            <button id="like" class="button is-outlined is-danger" onclick="reqFollowLike('<?= $_GET['id'] ?>', 'like')">
            <?php if ($like) { ?><i class="material-icons">check</i><i class="material-icons">favorite</i><?php } else { ?><i class="material-icons">add</i><i class="material-icons">favorite_border</i><?php } ?></button>
          <?php } ?>
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
  </div>
</div>
<!--    menu  -->
<div class="hero-foot">
  <nav class="tabs">
    <div class="container">
      <ul>
        <li class="is-active"><a>Comment</a></li>
      </ul>
    </div>
  </nav>
</div>
<br />
<!--    print comment  -->
<div class="columns">
    <div class="column">
      <?php foreach($com as $keycom => $keycom2) { ?>
        <div class="card-content box">
          <div class="media">
            <div class="media-left">
              <figure class="image is-48x48">
                <img class="is-rounded logo" src="data:image/jpeg;base64, <?= APP::printString($keycom2['logo']) ?>" alt="Placeholder image">
              </figure>
            </div>
            <a href="../Public/index.php?p=user_home&user=<?= APP::printString($keycom2['pseudo']) ?>">
              <p class="title is-6">@<?= APP::printString($keycom2['pseudo']) ?></p>
            </a>
          </div>
          <div class="content"><?= App::printString($keycom2['comment'])?><br>
            <time datetime="2016-1-1"><?= App::printString($keycom2['date']) ?></time>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>

<script src="../script/follow.js"></script>


