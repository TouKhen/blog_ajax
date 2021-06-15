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
    <p>List of articles below \/</p>
    <?php endif; ?>
    <div id="post_container">
<!--   All posts     -->
    </div>
</div>

<?php
require APP_ROOT . '/views/inc/footer.php';