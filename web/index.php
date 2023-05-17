<?php

/**
 * this is an "alias" for current directory,
 * use it for including files
 */

$path = dirname(__DIR__, 1);
define("root" , $path);

include_once  root . "/logic/native/router.php";

/**
 * from now, you can add your own routes like "path":"controller function" inside the logic/config/path.json
 */

route($_SERVER['REQUEST_URI']);
