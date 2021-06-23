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
add_filter( 'wp_get_attachment_url', 'forwarded_attachments_url' );
add_filter( 'redirect_canonical', 'public_redirect_url', 10, 2 );
add_filter( 'wp_redirect', 'redirect_url_filter', 10, 1 );

// add_filter('redirect_canonical', 'forwarded_site_public_url', 10, 1);
// remove_filter('template_redirect','redirect_canonical');
// remove_action('template_redirect', 'redirect_canonical');
// add_filter('do_redirect_guess_404_permalink', '__return_false');
// add_filter( 'the_permalink', 'forwarded_site_url', 10, 1 );
