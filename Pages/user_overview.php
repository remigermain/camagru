<div class="box">
    <progress class="progress is-small" value="15" max="100">15%</progress>
    <progress class="progress" value="30" max="100">30%</progress>
    <progress class="progress is-medium" value="45" max="100">45%</progress>
    <progress class="progress is-large" value="60" max="100">60%</progress>
</div>
<div class="box">
    <table class="table">
        <thead>
            <tr>
            <th><abbr title="Position">Pos</abbr></th>
            <th>Photos</th>
            <th><abbr title="Like">Like</abbr></th>
            <th><abbr title="Comment">Comment</abbr></th>
            <th><abbr title="category">cat</abbr></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
            <th><abbr title="Position">Pos</abbr></th>
            <th>Photos</th>
            <th><abbr title="Like">Like</abbr></th>
            <th><abbr title="Comment">Comment</abbr></th>
            <th><abbr title="category">cat</abbr></th>
            </tr>
        </tfoot>
        <tbody>
        <?php $i = 0; foreach ($val as $key => $key2)
        {?>
            <tr>
                <th><?= $i++ ?></th>
                <td><a href="../Public/index.php?p=image&id=<?= $key2['image_id'] ?>" title="<?= $key2['title'] ?>"><?= $key2['title'] ?></a></td>
                <td><? $key2['like'] ?></td>
                <td><?= Image::synopsis($key2['synopsis']) ?></td>
                <td><?= $key2['category'] ?></td>
            </tr>
        <?php
        } ?>
        </tbody>
    </table>
</div>
