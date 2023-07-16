<?php

// include the config file
require_once('../config/config.php');

$route = $_GET['route'] ?? DEFAULT_PAGE;

// Sanitize the route to prevent XSS and SQL injection
$route = preg_replace("/[^a-zA-Z0-9_\-]/", "", $route);

// Prepare file paths
$includeFilePath = INCLUDES_PATH . "/${route}.php";
$functionsFilePath = FUNCTIONS_PATH . "/${route}.php";
$handlersFilePath = HANDLERS_PATH . "/${route}.php";
$templatesFilePath = TEMPLATES_PATH . "/${route}.php";

// check for includes
if (file_exists($includeFilePath)) {
    require_once($includeFilePath);
}

// check for functions
if (file_exists($functionsFilePath)) {
    require_once($functionsFilePath);
}

// handle post requests
if ($_POST) {
    if (file_exists($handlersFilePath)) {
        require_once($handlersFilePath);
    }
}

// show template file
else {
    require_once (TEMPLATES_PATH . "/header.php");

    if (file_exists($templatesFilePath)) {
        require_once($templatesFilePath);
    }

    require_once (TEMPLATES_PATH . "/footer.php");
}