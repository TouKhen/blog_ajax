<?php require APP_ROOT . '/views/inc/head.php'; ?>

<div class="navbar dark">
    <?php require APP_ROOT . '/views/inc/nav.php'; ?>
</div>

<div class="container center">
    <h1>Update post</h1>

    <form action="<?php echo URL_ROOT; ?>/posts/update/<?php echo $data['post']->post_id ?>" method="POST">
        <div class="form-item">
            <input type="text" name="title" value="<?php echo $data['post']->title ?>">
            <span class="invalidFeedback"><?php echo $data['titleError']; ?></span>
        </div>

        <div class="form-item">
            <input type="text" name="slug" value="<?php echo $data['post']->slug ?>">
            <span class="invalidFeedback"><?php echo $data['slugError']; ?></span>
        </div>

        <div class="form-item">
            <input type="text" name="image" value="<?php echo $data['post']->image ?>">
            <span class="invalidFeedback"><?php echo $data['imageError']; ?></span>
        </div>

        <div class="form-item">
			<textarea name="body" placeholder="Enter your post...">
				<?php echo $data['post']->body ?>
			</textarea>
            <span class="invalidFeedback"><?php echo $data['bodyError']; ?></span>
        </div>

        <button class="btn green" name="submit" type="submit">Submit</button>
    </form>
</div>
