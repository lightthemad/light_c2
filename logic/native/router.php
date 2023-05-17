<?php

/**
 * A Url Router
 *
 */

function route($url)
{
	include_once root . '/logic/config/path.php';


	if (array_key_exists($url, $routes))
	{
		include_once root . '/controller/controller.php';
		$routes[$url]();
	}
	else
	{
		header('Location: /');
	}

}