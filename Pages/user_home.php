<!--  page  -->
<?php
  use App\Image;
  use App\App;
  use App\Error;
  use App\User;
  
  if (!isset($_GET['user']) || !APP::userExist($_GET['user']))
    Error::notFound();
  $title = $_GET['user'] . "  home";
  $val = Image::getUserImg($_GET['user']);
  $info = User::getUserInfo($_GET['user']);
  $follow = 0;
  if (App::sessionExist() && User::userFollowUser($_SESSION['username'], $_GET['user']))
    $follow = 1;
  $count = App::calculPage($val, 8);
  $pagination = App::paginationInit($count, 8);
  $val = App::Pagination($val, $pagination, 8);
 ?>
<!--  profils -->
<div id="all" style="margin-top: 20px;">
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
            <p><strong><?= APP::printString($_GET['user']) ?></strong><br>
            <?php if (!App::sessionExist() || $_SESSION['username'] != $_GET['user']) {?>
              <button id="follow" class="button <?= $follow ? "is-outlined" : "" ?> is-link" onclick="reqFollow('<?= $_GET['user'] ?>')">
                <?php if ($follow) { ?>
                  <i class="material-icons">check</i>
                <?php } else { ?>
                  <i class="material-icons">add</i>
                <?php } ?> Follow
              </button>
            <?php } ?>
            <br><br>
            <span id="homeSynopsis5"><?= APP::printString($info['synopsis']) ?></span>
            <div class="tags are-large">
              <span id="totalFollow" class="tag">Follower <?= APP::printString($info['follower']) ?></span>
              <span id="totalImage" class="tag">Image <?= APP::printString($info['nb_image']) ?></span>
              <span id="totalLike" class="tag">Like <?= APP::printString($info['like']) ?></span>
              <?php if (App::sessionExist() && $_SESSION['username'] == $_GET['user'])
                { ?>
              <button id="edit_button" class="button chanel_modal" onclick="display_modal_chanel()"><i class="material-icons">settings</i></button>
              <div id="chanel" value="<?= $info['username'] ?>" class="modal">
                <div id="back" class="modal-background"></div>
                <div class="modal-card">
                  <header class="modal-card-head">
                    <p class="modal-card-title">Edit</p>
                    <button id="but_close_chanel" class="delete" aria-label="close"></button>
                  </header>
                  <section class="modal-card-body">
                    <h1 class="subtitle is-4">Synopsis chanel</h1>
                    <textarea id="newhomeSynopsis" type="textarea" class="textarea"><?= APP::printString($info['synopsis']) ?></textarea>
                  </section>
                  <footer class="modal-card-foot">
                    <button class="button is-link" id="2" onclick="reqHome()">Save changes</button>
                    <button id="but_cancel_chanel" class="button" aria-label="close" >Cancel</button>
                  </footer>
                </div>
              </div>
              <?php
                } ?>
            </div>
          </div>
        </div>
      </article>
    </div>
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
        <div id="base<?= App::printString($key2['image_id']) ?>" class="column is-3">
            <div class="card">
               <div class="card-image">
                    <figure class="image is-4by3">
                        <a href="../Public/index.php?p=image&id=<?= App::printString($key2['image_id']) ?>">
                            <img src="data:image/jpeg;base64, <?= APP::printString($key2['image']) ?>" alt="Placeholder image">
                        </a>
                    </figure>
                </div>
                <div class="card-content">
                    <h1 id="basetitle<?= App::printString($key2['image_id']) ?>" class="tag subtitle is-8"><?=Image::subTitle($key2['title']) ?></h1>
                    <div id="basesys<?= App::printString($key2['image_id']) ?>" class="content"><?= Image::subSynopsis($key2['synopsis']) ?><br></div>
                    <!--  like  --->
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
                          <!--  tag -->
                          <div class="tags has-addons">
                            <div class="tag"><time datetime="2016-1-1"><?= App::printString($key2['date']) ?></time></div>
                            <a class="tag is-link" href="../Public/index.php?cat=<?= App::printString($key2['category']) ?>"><?= App::printString($key2['category']) ?></a>
                            <a class="tag is-light">Tag</a>
                          </div>
                        </div>
                        <!--  modify -->
                        <?php if (App::sessionExist() && $_SESSION['username'] == $_GET['user']) { ?>
                            <div class="field is-grouped is-grouped-multiline">
                             <div class="control">
                               <div class="tags has-addons">
                                <button id="edit_button" class="button" onclick="display_modal(<?= App::printString($key2['image_id']) ?>)"><i class="material-icons">settings</i></button>
                                  <div id="modal<?= App::printString($key2['image_id']) ?>" class="modal">
                                    <div id="back_img<?= App::printString($key2['image_id']) ?>" class="modal-background"></div>
                                    <div class="modal-card">
                                      <header class="modal-card-head">
                                        <p class="modal-card-title">Edit</p>
                                        <button id="close<?= App::printString($key2['image_id']) ?>" class="delete" aria-label="close"></button>
                                      </header>
                                      <section class="modal-card-body">
                                        <h1 class="subtitle is-4">Title</h1>
                                        <input id="title<?= App::printString($key2['image_id']) ?>" type="textarea" class="textarea" value="<?= App::printString($key2['title']) ?>" require>
                                        <h1 class="subtitle is-4">Synopsis</h1>
                                        <textarea id="sys<?= App::printString($key2['image_id']) ?>" type="textarea" class="textarea"><?= APP::printString($key2['synopsis']) ?></textarea>
                                      </section>
                                      <footer class="modal-card-foot">
                                        <button class="button is-link" onclick="reqModify(<?= App::printString($key2['image_id']) ?>)">Save changes</button>
                                        <button id="cancel<?= App::printString($key2['image_id']) ?>" class="button" aria-label="close" >Cancel</button>
                                      </footer>
                                    </div>
                                  </div>
                                  <!--  delete -->
                                <button id="delete" class="button" onclick="display_modal_del(<?= App::printString($key2['image_id']) ?>)"><i class="material-icons">delete</i></button>
                                   <div id="modal_del<?= App::printString($key2['image_id']) ?>" class="modal">
                                    <div id="del_back<?= App::printString($key2['image_id']) ?>" class="modal-background"></div>
                                    <div class="modal-card">
                                      <header class="modal-card-head">
                                        <p class="modal-card-title">Delete pictures</p>
                                        <button id="del_close<?= App::printString($key2['image_id']) ?>" class="delete" aria-label="close"></button>
                                      </header>
                                      <section class="modal-card-body">
                                        <p class="subtitle is-4">Are you sure to delete this pictures ?</p>
                                      </section>
                                      <footer class="modal-card-foot">
                                        <button id="delete<?= App::printString($key2['image_id']) ?>" class="button is-danger" onclick="reqDelete(<?= App::printString($key2['image_id']) ?>)"><i class="material-icons">delete_forever</i> delete</button>
                                        <button id="del_cancel<?= App::printString($key2['image_id']) ?>" class="button" aria-label="close" >Cancel</button>
                                      </footer>
                                    </div>
                                  </div>
                               </div>
                             </div>
                           </div>
                          <!--  end -->
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
  </div>
  <!--  pagination -->
  <?php $url = "../Public/index.php?p=user_home&user=" . $_GET['user']; require '../Pages/pagination.php'; ?>
</div>
<?php if (App::sessionExist() && $_SESSION['username'] == $_GET['user']) { ?>
  <script src="../script/edit.js"></script>
<?php } ?>