<!--  page  -->
<?php
 use App\Image;
 use App\App;
 use App\Error;
if (!isset($_GET['user']) || !APP::userexist($_GET['user']))
  Error::notFound();
$val = Image::getUserImg($_GET['user']);


$image = "/../vue/img/profil.jpg";
$follower = rand() % 666;
$number = rand() % 666;
$synopsis = "Au XIVe siècle, un bergsman (paysan libre qui outre ses activités agricoles produit aussi du fer) d'origine allemande nommé Englika établit un haut fourneau et une forge utilisant l'énergie des rapides de la rivière Snytenån (ou Snytsboån). Le village d'Englikobenning est né, et des bergsmän s'y succèdent pour gérer les fourneaux et les forges. La situation change à la fin du ";
$like = rand() % 666;



?>
<!--  profils -->
<div class="box">
    <div class="container">
        <div class="box">
            <article class="media">
                <div class="media-left">
                    <figure class="image is-128x128">
                        <img class="is-rounded" src="<?= $image ?>" alt="Image">
                    </figure>
                </div>
                <div class="media-content">
                    <div class="content">
                        <p><strong><?= $_GET['user'] ?></strong><br>
                        <a class="button is-warning is-outlined">Follower</a>
                        <br><br>
                        <span><?= $synopsis ?></span>
                        </p>
                    </div>
                    <div class="tags are-large">
                        <span class="tag">Follower <?= $follower ?></span>
                        <span class="tag">Image <?= $number ?></span>
                        <span class="tag">Like <?= $like ?></span>
                    </div>
                </div>
            </article>
        </div>
    </div>
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
<div class="container">
  <div class="columns is-multiline">
    <?php foreach ($val as $key => $key2)
    { ?>
      <div class="column is-3">
        <div class="card">
          <div class="card-image">
            <figure class="image is-4by3">
              <a href="../Public/index.php?p=image&id=<?= $key2['image_id'] ?>"><img src="data:image/jpeg;base64, <?= $key2['image'] ?>" alt="Placeholder image"></a>
            </figure>
          </div>
          <footer class="card-footer">
            <p href="#" class="card-footer-item"><i class="material-icons">thumb_up_al</i>like</p>
            <a href="#" class="card-footer-item">Delete</a>
          </footer>
        </div>
      </div>
    <?php
    } ?>
  </div>
</div>