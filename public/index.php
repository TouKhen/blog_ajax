<?php
	require_once '../app/require.php';

	// Check if the url is "blog_ajax" to fix the error
	if ($_SERVER['REQUEST_URI'] === "/blog_ajax/") {
	    header("Location: " . URL_ROOT . "/index");
    }