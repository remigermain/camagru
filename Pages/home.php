<?php
  use App\Image;
  use App\App;
  $val = Image::getAllImg();


  $count = App::calculPage($val, 8);
  $pagination = 1;
  if (isset($_GET['pagination']))
    $pagination = $_GET['pagination'];
  if ($pagination * 8 - 8 > $count)
    $pagination = $count;
  else if ($pagination <= 0)
    $pagination = 1;
  $val = App::Pagination($val, $pagination * 8 - 8);


?>
<div class="hero-foot">
  <nav class="tabs">
    <div class="container">
      <ul>
        <li class="is-active"><a>sort</a></li>
        <li><a>Modifiers</a></li>
      </ul>
    </div>
  </nav>
</div>
<div class="container">
  <div class="columns is-multiline">
    <?php $i = 0;foreach ($val as $key => $key2)
    { if ($i++ == 8) break;?>
    <!--       print all images -->
    <div class="column is-3">
      <div class="card">
          <div class="card-image">
              <figure class="image is-4by3">
              <a href="../Public/index.php?p=image&id=<?= App::printString($key2['image_id']) ?>">
                  <img src="data:image/jpeg;base64, <?= $key2['image'] ?>" alt="Placeholder image">
              </a>
              </figure>
          </div>
          <div class="card-content">
              <div class="media">
                  <div class="media-left">
                      <figure class="image is-48x48">
                          <img class="is-rounded" src="data:image/jpeg;base64, <?= $key2['logo'] ?>" alt="Placeholder image">
                      </figure>
                  </div>
                  <a href="../Public/index.php?p=user_home&user=<?= App::printString($key2['username']) ?>">
                      <p class="title is-6">@<?= App::printString($key2['username']) ?></p>
                  </a>
              </div>
              <h1 class="tag subtitle is-8"><?= Image::subTitle($key2['title']) ?></h1>
              <div class="content">
                  <?= Image::subSynopsis($key2['synopsis']) ?><br>
              </div>
              <?php $like = Image::userLikeImage($key2['image_id']); {?>
                <button id="like<?= $key2['image_id'] ?>" class="button is-outlined is-danger" onclick="reqLike('<?= $key2['image_id'] ?>')">
                <?php if ($like) { ?>
                  <i class="material-icons">check</i><i class="material-icons">favorite</i>
                <?php } else { ?>
                  <i class="material-icons">add</i><i class="material-icons">favorite_border</i>
                <?php } ?></button>
                <?php } ?>
              <div class="field is-grouped is-grouped-multiline">
                  <div class="control">
                    <div class="tags has-addons">
                      <div class="tag"><time datetime="2016-1-1"><?= App::printString($key2['date']) ?></time></div>
                      <a class="tag is-link"><?= App::printString($key2['category']) ?></a>
                      <a class="tag is-light">Tag</a>
                    </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <!--    END   print all images -->
    <?php
    } ?>
  </div>
  <!--  pagination -->
  <?php $url = "../Public/index.php?p=home"; require '../Pages/pagination.php'; ?>
</div>
<script src="../script/follow.js"></script>