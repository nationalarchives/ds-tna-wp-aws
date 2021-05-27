<?php
/**
 * Plugin Name: TNA WordPress for AWS plugin
 * Plugin URI: https://github.com/nationalarchives/ds-tna-wp-aws
 * Description: The National Archives Wordpress for AWS plugin.
 * Version: 1.0
 * Author: The National Archives
 * Author URI: https://github.com/nationalarchives
 * License: GPL2
 */

/* Included functions */
include 'functions.php';

/* add_action */
add_action( 'admin_init', 'tna_aws_admin_page_settings' );
add_action( 'admin_menu', 'tna_aws_add_menu_item' );

/* add_filter */
add_filter('allowed_redirect_hosts', 'add_redirect_hosts', 10);
add_filter( 'admin_url', 'forwarded_admin_url', 10, 2 );
add_filter( 'site_url', 'forwarded_site_url', 10, 2 );
