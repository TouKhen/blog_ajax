<?php
	require APP_ROOT . '/views/inc/head.php';
?>
<div class="navbar dark">
	<?php
		require APP_ROOT . '/views/inc/nav.php';
	?>
</div>

<div class="container">
    <?php if(isLoggedIn()): ?>
    <div class="container center" style="padding-top:0;">
        <h1>Crée un article</h1>

        <form method="post" id="form_create">
            <input type="hidden" name="type" value="create">
            <div class="form-item">
                <input type="text" name="title" id="create_title" placeholder="Titre">
            </div>

            <div class="form-item">
                <input type="text" name="slug" id="create_slug" placeholder="Slug">
            </div>

            <div class="form-item">
                <input type="text" name="image" id="create_image" placeholder="Image Lien">
            </div>

            <div class="form-item">
                <textarea name="body" rows="5" cols="33" id="create_body" placeholder="Content"></textarea>
            </div>

            <button id="create_post" type="submit" value="submit">Create</button>
        </form>
    </div>
    <?php endif; ?>
    <p>List of articles below \/</p>
    <div id="post_container">
<!--   All posts     -->
        <?php foreach ($data as $post): ?>
            <div class="container-item" id="<?= $post->post_id ?>">
                <h2 class="post_title">
                    <a href="<?= URL_ROOT . '/posts/page/' . $post->post_id ?>"><?= $post->title ?></a>
                </h2>

                <h3>
                    Created on: <?= date('F j h:m', strtotime($post->created_at)) ?>
                </h3>

                <p class="post_body">
                    <?= $post->body ?>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
require APP_ROOT . '/views/inc/footer.php';