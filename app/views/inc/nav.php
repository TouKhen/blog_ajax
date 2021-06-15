<nav class="top-nav">
	<ul>
		<li>
			<a href="<?php echo URL_ROOT; ?>/index">Home</a>
		</li>
		<li>
			<a href="<?php echo URL_ROOT; ?>/about">About</a>
		</li>
		<li>
			<a href="<?php echo URL_ROOT; ?>/projects">Projects</a>
		</li>
		<li>
			<a href="<?php echo URL_ROOT; ?>/posts">Blog</a>
		</li>
		<li>
			<a href="<?php echo URL_ROOT; ?>/contact">Contact</a>
		</li>
		<li class="btn-login">
			<?php if(isset($_SESSION['user_id'])) : ?>
				<a href="<?php echo URL_ROOT; ?>/users/logout">Log out</a>
			<?php else : ?>
				<a href="<?php echo URL_ROOT; ?>/users/login">Login</a>
			<?php endif; ?>
		</li>
	</ul>
</nav>
