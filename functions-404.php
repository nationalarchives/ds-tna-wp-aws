<?php

function tna_404_page_template( $page_template )
{
    if ( is_404() || is_page( '404' ) ) {
        $page_template = plugin_dir_path( __FILE__ ) . 'templates/404.php';
    }
    return $page_template;
}