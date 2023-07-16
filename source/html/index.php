<?php

// include the config file
require_once('../config/config.php');

$route = $_GET['route'] ?? DEFAULT_PAGE;

// sanitize the route
$route = preg_replace("/[^a-zA-Z0-9_\-]/", "", $route);

// prepare file paths
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
    // check if the template file does not exist
    if (!file_exists($templatesFilePath)) {
        // then change the template file to 404
        http_response_code(404);
        $templatesFilePath = TEMPLATES_PATH . "/404.php";
    }
    require_once (TEMPLATES_PATH . "/header.php");
    require_once($templatesFilePath);
    require_once (TEMPLATES_PATH . "/footer.php");
}