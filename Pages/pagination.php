<?php use     App\App; 
?>
<nav class="pagination" role="navigation" aria-label="pagination">
   <a class="pagination-previous" href="<?= $url ?>&pagination=<?= $pagination - 1 ? $pagination - 1 : 1 ?>" >Previous</a>
   <a class="pagination-next" href="<?= $url ?>&pagination=<?= $pagination + 1 > $count ? $count : $pagination + 1 ?>" >Next page</a>
   <ul class="pagination-list">
     <li>
       <a class="pagination-link <?= App::paginationCurrent($pagination, 1) ?>" href="<?= $url ?>" aria-label="Goto page 1">1</a>
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
         <a class="pagination-link <?= App::paginationCurrent($pagination, $i) ?>" href="<?= $url ?>&pagination=<?= $i ?>" aria-label="Page <?= $i ?>" aria-current="page"><?= $i ?></a>
       </li>
       <?php } $i++; } ?>
        
     <?php if ($pagination + 2 < $count) { ?>
     <li>
       <span class="pagination-ellipsis">&hellip;</span>
     </li>
     <?php } ?>
     <?php if ($count > 1) { ?>
     <li>
       <a class="pagination-link <?= App::paginationCurrent($pagination, $count) ?>" href="<?= $url ?>&pagination=<?= $count ?>" aria-label="Goto page <?= $count ?>"><?= $count ?></a>
     </li>
     <?php } ?>
   </ul>
  </nav>