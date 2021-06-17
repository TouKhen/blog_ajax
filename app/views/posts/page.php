<?php
require APP_ROOT . '/views/inc/head.php';
?>
<div class="navbar dark">
    <?php
    require APP_ROOT . '/views/inc/nav.php';
    ?>
</div>
<div class="container center">
    <h2><?= $data['post']->title ?></h2>

    <div>
        <form method="post" id="form_comment">
            <label for="body">Comment here :</label>
            <textarea name="body" id="body" cols="30" rows="10"></textarea>

            <button id="send_comment" type="submit" name="submit" data-id="<?= $data['post']->post_id ?>">Postez</button>
        </form>
    </div>

    <div id="comment_container">
        <?php
            if(!empty($data['comments'])){
            foreach($data['comments'] as $comment): ?>
            <div>
                <h4><?= $comment->username ?></h4>
                <p><?= $comment->body ?></p>
            </div>
        <?php endforeach;}?>
    </div>
</div>


<?php
require APP_ROOT . '/views/inc/footer.php';