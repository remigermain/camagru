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
$count = App::calculPage($com);
$pagination = 1;
if (isset($_GET['pagination']))
  $pagination = $_GET['pagination'];
if ($pagination * 5 - 5 > $count)
  $pagination = $count;
else if ($pagination <= 0)
  $pagination = 1;
$com = Comment::Pagination($com, $pagination * 5 - 5);
if (APP::sessionExist())
  $info = User::getUserInfo($_SESSION['pseudo'])['logo'];
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
          <img class="is-rounded" src="data:image/jpeg;base64, <?= $info ?>">
        </p>
      </figure>
      <div class="media-content">
        <div class="field">
          <p class="control">
            <textarea id="comment"class="textarea" placeholder="Add a comment..."></textarea>
          </p>
        </div>
        <nav class="level">
          <div class="level-left">
            <div class="level-item">
              <a class="button is-info" onclick="reqComment(<?= $_GET['id'] ?>)">Submit</a>
            </div>
          </div>
        </nav>
      </div>
    </article>
    <?php } ?>
  <div class="columns">
    <div class="column">
      <?php $i = 0; foreach($com as $keycom => $keycom2) { if (++$i > 5) break; ?>
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
<nav class="pagination" role="navigation" aria-label="pagination">
  <a class="pagination-previous" href="../Public/index.php?p=image&id=<?= $_GET['id'] ?>&pagination=<?= $pagination - 1 ?>" >Previous</a>
  <a class="pagination-next" href="../Public/index.php?p=image&id=<?= $_GET['id'] ?>&pagination=<?= $pagination + 1 ?>" >Next page</a>
  <ul class="pagination-list">
    <li>
      <a class="pagination-link <?= App::paginationCurrent($pagination, 1) ?>" href="../Public/index.php?p=image&id=<?= $_GET['id'] ?>" aria-label="Goto page 1">1</a>
    </li>
    <?php if ($pagination - 1 > 2) { ?>
    <li>
      <span class="pagination-ellipsis">&hellip;</span>
    </li>
    <?php } ?>
    
    <?php  $i = $pagination - 1; while ($i < $pagination + 2) {
      if ($i > 1 && $i < $count) {
      ?>
      <li>
        <a class="pagination-link <?= App::paginationCurrent($pagination, $i) ?>" href="../Public/index.php?p=image&id=<?= $_GET['id'] ?>&pagination=<?= $i ?>" aria-label="Page <?= $i ?>" aria-current="page"><?= $i ?></a>
      </li>
      <?php } $i++; } ?>

    <?php if ($pagination + 2 < $count) { ?>
    <li>
      <span class="pagination-ellipsis">&hellip;</span>
    </li>
    <?php } ?>
    <?php if ($count > 1) { ?>
    <li>
      <a class="pagination-link <?= App::paginationCurrent($pagination, $count) ?>" href="../Public/index.php?p=image&id=<?= $_GET['id'] ?>&pagination=<?= $count ?>" aria-label="Goto page <?= $count ?>"><?= $count ?></a>
    </li>
    <?php } ?>
  </ul>
  </nav>
</div>
<script src="../script/follow.js"></script>
<script src="../script/comment.js"></script>


