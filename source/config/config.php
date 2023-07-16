<?php

define('BASE_PATH', dirname(dirname(__FILE__)));
define('HTML_PATH', BASE_PATH . '/html');
define('INCLUDES_PATH', BASE_PATH . '/includes');
define('FUNCTIONS_PATH', BASE_PATH . '/functions');
define('HANDLERS_PATH', BASE_PATH . '/handlers');
define('TEMPLATES_PATH', BASE_PATH . '/templates');

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443 || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' )) ? "https://" : "http://";
define('URL', $protocol. $_SERVER['HTTP_HOST']);
define('WEBSITE_TITLE', 'GPT by JP');
define('DEFAULT_PAGE', 'prompt');