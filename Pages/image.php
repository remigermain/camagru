<?php
use App\Image;
use App\App;
use App\Error;
use App\User;
use App\Comment;
if (!isset($_GET) || !isset($_GET['id']))
  Error::notFound();  
$val = Image::getImgById($_GET['id']);
if (!$val)
  Error::notFound();
$com = Comment::getCommentImage($_GET['id']);
$count = App::calculPage($com, 5);
$pagination = App::paginationInit($count, 5);
$com = App::Pagination($com, $pagination, 5);
if (APP::sessionExist())
  $info = User::getUserInfo($_SESSION['username'])['logo'];
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
              <a href="../Public/index.php?p=user_home&user=<?= APP::printString($val['username']) ?>">
                <p class="title is-6">@<?= APP::printString($val['username']) ?></p>
              </a>
              <div class="media-right"></div>
            </div>
            <h1 class="tag subtitle is-4"><?= App::printString($val['title']) ?></h1>
            <div class="content"><?= App::printString($val['synopsis']) ?><br></div>
            <?php $like = Image::userLikeImage($_GET['id']);
            {?>
                <button id="like<?= $_GET['id'] ?>" class="button is-outlined is-danger" onclick="reqLike('<?= $_GET['id'] ?>')">
                <?php if ($like) { ?>
                  <i class="material-icons">check</i><i class="material-icons">favorite</i>
                <?php } else { ?>
                  <i class="material-icons">add</i><i class="material-icons">favorite_border</i>
                <?php } ?></button>
            <?php } ?>
            <div class="field is-grouped is-grouped-multiline">
              <div class="control">
                <!--  tag -->
                <div class="tags has-addons">
                  <div class="tag"><time datetime="2016-1-1"><?= APP::printString($val['date']) ?></time></div>
                  <a class="tag is-link" href="../Public/index.php?cat=<?= App::printString($val['category']) ?>">#<?= App::printString($val['category']) ?></a>
                  <a class="tag is-light">Tag</a>
                </div>
              </div>
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
<div class="column">
  <div class="container">
    <?php if (App::sessionExist()) { ?>
    <article class="media box">
      <figure class="media-left">
        <p class="image is-64x64">
          <img id="userComment" class="is-rounded" src="data:image/jpeg;base64, <?= $info ?>">
        </p>
      </figure>
      <div class="media-content">
        <div class="field">
          <p class="control">
            <textarea id="comment" class="textarea" placeholder="Add a comment..."></textarea>
          </p>
        </div>
        <nav class="level">
          <div class="level-left">
            <div class="level-item">
              <a class="button is-info" onclick="reqComment(<?= $_GET['id'] ?>, <?= $pagination ?>); return false;">Submit</a>
            </div>
          </div>
        </nav>
      </div>
    </article>
    <?php } ?>
  <div class="columns">
    <div id="allComment" class="column">
      <?php $i = 0; foreach($com as $keycom => $keycom2) { if (++$i > 5) break; ?>
        <div class="card-content box">
          <div class="media">
            <div class="media-left">
              <figure class="image is-48x48">
                <img class="is-rounded logo" src="data:image/jpeg;base64, <?= APP::printString($keycom2['logo']) ?>" alt="Placeholder image">
              </figure>
            </div>
            <a href="../Public/index.php?p=user_home&user=<?= APP::printString($keycom2['username']) ?>">
              <p class="title is-6">@<?= APP::printString($keycom2['username']) ?></p>
            </a>
          </div>
          <div class="content"><?= App::printString($keycom2['comment'])?><br>
            <time datetime="2016-1-1"><?= App::printString($keycom2['date']) ?></time>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
  <!-- pagination -->
  <?php $url = "../Public/index.php?p=image&id=". $_GET['id']; require '../Pages/pagination.php'; ?>
</div>
