<?php
require APP_ROOT . '/views/inc/head.php';
?>
<div class="navbar dark">
    <?php
    require APP_ROOT . '/views/inc/nav.php';
    ?>
</div>

<div class="container center">
    <h1>Crée un article</h1>

    <form method="post" action="<?php echo URL_ROOT; ?>/posts/create">
        <div class="form-item">
            <input type="text" name="title" id="title" placeholder="Titre">
        </div>

        <div class="form-item">
            <input type="text" name="slug" id="slug" placeholder="Slug">
        </div>

        <div class="form-item">
            <input type="text" name="image" id="image" placeholder="Image Lien">
        </div>

        <div class="form-item">
            <textarea name="body" rows="5" cols="33" id="body" placeholder="Content"></textarea>
        </div>

        <button id="submit" type="submit" value="submit">Submit</button>
    </form>
</div>