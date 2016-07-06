<?php

if (!session_id() && !headers_sent()) {
    session_start();
}

// Examples
require_once('functions/javascript-example.php');

// Require
require_once('functions/media.php');
require_once('functions/permalinks.php');
require_once('functions/headers.php');
require_once('functions/terms.php');

// Use functions
require_once('functions/filters.php');
require_once('functions/hooks.php');
require_once('functions/init.php');
