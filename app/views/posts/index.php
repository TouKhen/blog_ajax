<?php
	require APP_ROOT . '/views/inc/head.php';
?>
<div class="navbar dark">
	<?php
		require APP_ROOT . '/views/inc/nav.php';
	?>
</div>

<div class="container">
    <?php //if(isLoggedIn()): ?>
    <a class="btn green" href="<?php echo URL_ROOT; ?>/posts/create">
        Create
    </a>
    <?php //endif; ?>
    <div id="post_container">
<!--   All posts     -->
    </div>
</div>

<?php
require APP_ROOT . '/views/inc/footer.php';