<!--  page  -->
<?php
 use App\Image;
 use App\App;
 use App\Error;
 use App\User;

if (!isset($_GET['user']) || !APP::userExist($_GET['user']))
  Error::notFound();
$val = Image::getUserImg($_GET['user']);
$info = User::getUserInfo($_GET['user']);


$image = "/../vue/img/profil.jpg";
$follower = rand() % 666;
$number = rand() % 666;
$synopsis = "Au XIVe siècle, un bergsman (paysan libre qui outre ses activités agricoles produit aussi du fer) d'origine allemande nommé Englika établit un haut fourneau et une forge utilisant l'énergie des rapides de la rivière Snytenån (ou Snytsboån). Le village d'Englikobenning est né, et des bergsmän s'y succèdent pour gérer les fourneaux et les forges. La situation change à la fin du ";
$like = rand() % 666;

//die(var_dump($info['logo']));

?>
<!--  profils -->
<div style="margin-top: 20px;">
    <div class="container">
        <div class="box">
            <article class="media">
                <div class="media-left">
                    <figure class="image is-128x128">
                        <img class="is-rounded" src="data:image/jpeg;base64, <?= $info['logo'] ?>" alt="Image">
                    </figure>
                </div>
                <div class="media-content">
                    <div class="content">
                        <p><strong><?= $_GET['user'] ?></strong><br>
                        <a class="button is-warning is-outlined">Follower</a>
                        <br><br>
                        <span><?= $synopsis ?></span>
                        <?php if (App::sessionExist() && $_SESSION['pseudo'] == $_GET['user'])
                          { ?>
                        <button id="edit_button" class="button chanel_modal" onclick="display_modal_chanel()"><i class="material-icons">settings</i></button>
                          <div id="chanel" value="<?= $info['pseudo']  ?>" class="modal">
                            <div id="back" class="modal-background"></div>
                            <div class="modal-card">
                              <header class="modal-card-head">
                                <p class="modal-card-title">Edit</p>
                                <button id="but_close_chanel" class="delete" aria-label="close"></button>
                              </header>
                              <section class="modal-card-body">
                                <h1 class="subtitle is-4">Synopsis chanel</h1>
                                <textarea type="textarea" class="textarea"><?= $synopsis ?></textarea>
                              </section>
                              <footer class="modal-card-foot">
                                <button class="button is-link">Save changes</button>
                                <button id="but_cancel_chanel" class="button" aria-label="close" >Cancel</button>
                              </footer>
                            </div>
                          </div>
                        <?php
                          } ?>
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
                    <a href="../Public/index.php?p=image&id=<?= $key2['image_id'] ?>">
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
                        <a href="../Public/index.php?p=user_home&user=<?= $key2['pseudo'] ?>">
                            <p class="title is-6">@<?= $key2['pseudo'] ?></p>
                        </a>
                        <div class="media-right">
                        </div>
                    </div>
                    <div class="content"><?= Image::synopsis($key2['synopsis']); ?><br></div>
                    <a class=""><i class="material-icons">favorite</i>Like</a>
                    <div class="field is-grouped is-grouped-multiline">
                        <div class="control">
                          <!--  tag -->
                          <div class="tags has-addons">
                            <div class="tag"><time datetime="2016-1-1"><?= $key2['date'] ?></time></div>
                            <a class="tag is-link"><?= $key2['category'] ?></a>
                            <a class="tag is-light">Tag</a>
                          </div>
                        </div>
                        <!--  modify -->
                        <?php if (App::sessionExist() && $_SESSION['pseudo'] == $_GET['user']) { ?>
                           <div class="field is-grouped is-grouped-multiline">
                             <div class="control">
                               <div class="tags has-addons">
                                <button id="edit_button" class="button" onclick="display_modal(<?= $key2['image_id'] ?>)"><i class="material-icons">settings</i></button>
                                  <div id="modal<?= $key2['image_id'] ?>" class="modal">
                                    <div id="back_img<?= $key2['image_id'] ?>" class="modal-background"></div>
                                    <div class="modal-card">
                                      <header class="modal-card-head">
                                        <p class="modal-card-title">Edit</p>
                                        <button id="close<?= $key2['image_id'] ?>" class="delete" aria-label="close"></button>
                                      </header>
                                      <section class="modal-card-body">
                                        <h1 class="subtitle is-4">Title</h1>
                                        <textarea type="textarea" class="textarea"><?= $key2['title'] ?></textarea>
                                        <h1 class="subtitle is-4">Synopsis</h1>
                                        <textarea type="textarea" class="textarea"><?= $key2['synopsis'] ?></textarea>
                                      </section>
                                      <footer class="modal-card-foot">
                                        <button class="button is-link">Save changes</button>
                                        <button id="cancel<?= $key2['image_id'] ?>" class="button" aria-label="close" >Cancel</button>
                                      </footer>
                                    </div>
                                  </div>
                                  <!--  <a class="tag is-light"> <i class="material-icons">settings</i> modify</a> -->
                                <button id="delete<?= $key2['image_id'] ?>" class="button is-danger" onclick="delete_image(<?= $key2['image_id'] ?>)"><i class="material-icons">delete_forever</i> delete</button>
                               </div>
                             </div>
                           </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } ?>
  </div>
</div>
<script src="../script/edit.js"></script>
