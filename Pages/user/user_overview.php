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
        { ?>
            <tr>
            <th><?= $i++ ?></th>
            <td><a href="../Public/index.php?p=image&id=<?= $key2['image_id'] ?>" title="<?= "comment" ?>"><?= "comment" ?></a> <strong>(C)</strong>
            </td>
            <td>38</td>
            <td>23</td>
            <td>12</td>
            <td>3</td>
            <td>68</td>
            <td>36</td>
            <td>+32</td>
            <td>81</td>
            <td>Qualification for the <a href="https://en.wikipedia.org/wiki/2016%E2%80%9317_UEFA_Champions_League#Group_stage" title="2016–17 UEFA Champions League">Champions League group stage</a></td>
            </tr>



        <?php
        } ?>
        </tbody>
    </table>
</div>
