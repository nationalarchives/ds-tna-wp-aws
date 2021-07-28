<?php

global $GLOBALS;
$GLOBALS['pagenow'] = 'wp-login.php';
define( 'EDITOR_SITEURL', 'editorial.com');
define( 'INT_SITEURL', 'internal.com');

function is_admin() {
    return true;
}

function is_network_admin() {
    return false;
}

function apache_request_headers() {
    return array(
        'X_HOST_TYPE' => 'private'
    );
}
