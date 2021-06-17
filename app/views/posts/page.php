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

                <div id="reply_container<?= $comment->comment_id ?>">
                    <form method="post" id="reply_comment<?= $comment->comment_id ?>">
                        <input type="hidden" id="post_id" name="post_id" value="<?= $data['post']->post_id ?>">
                        <label for="body">Reply here :</label>
                        <textarea name="body" id="reply_body<?= $comment->comment_id ?>"" cols="30" rows="10"></textarea>

                        <button class="send_reply" type="submit" name="submit" data-id="<?= $comment->comment_id ?>">Reply</button>
                    </form>
                    <?php foreach($data['replies']) ?>
                    <?php endforeach;?>
                </div>
            </div>
        <?php endforeach;}?>
    </div>
</div>


<?php
require APP_ROOT . '/views/inc/footer.php';