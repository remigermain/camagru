<?php
  use App\Image;
  $val = Image::getAllImg();
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
        <?php foreach ($val as $key => $key2)
        { ?>
        <!--       print all images -->
        <div class="column is-3">
            <div class="card">
                <div class="card-image">
                    <figure class="image is-4by3">
                    <a href="../Public/index.php?p=image&id=<?= $key2['image_id'] ?>">
                        <img src="data:image/jpeg;base64, <?= $key2['image'] ?>" alt="Placeholder image">
                    </a>
                    </figure>
                </div>
                <div class="card-content">
                    <div class="media">
                        <div class="media-left">
                            <figure class="image is-48x48">
                                <img class="is-rounded" src="../vue/img/profil.jpg" alt="Placeholder image">
                            </figure>
                        </div>
                        <a href="../Public/index.php?p=user_home&user=<?= $key2['pseudo'] ?>">
                            <p class="title is-6">@<?= $key2['pseudo'] ?></p>
                        </a>
                        <div class="media-right">
                        </div>
                    </div>
                    <div class="content">
                        <?= Image::synopsis($key2['synopsis']); ?><br>
                        <time datetime="2016-1-1"><?= $key2['date'] ?></time>
                    </div>
                    <a class=""><i class="material-icons">favorite</i>Like</a>
                </div>
            </div>
        </div>
        <!--    END   print all images -->
        <?php
        } ?>
    </div>
</div>