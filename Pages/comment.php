<?php
use App\Comment;
$com = Comment::getCommentImage($_GET['id']);
?>
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
</div>