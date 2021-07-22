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
add_action( 'wp_head', 'aws_meta' );

/* add_filter */
add_filter( 'show_admin_bar', '__return_false' );
add_filter( 'allowed_redirect_hosts', 'add_redirect_hosts', 10 );
add_filter( 'option_siteurl', 'forwarded_site_url', 10, 1 );
add_filter( 'option_home', 'forwarded_site_url', 10, 1 );
add_filter( 'self_admin_url', 'forwarded_site_url', 10, 1 );
add_filter( 'get_network', 'forwarded_network_domain', 10, 1 );
add_filter( 'wp_get_attachment_url', 'forwarded_attachments_url' );
add_filter( 'status_header', 'no_redirect_guess_404_permalink' );
