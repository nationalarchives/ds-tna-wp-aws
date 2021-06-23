<?php

function add_redirect_hosts( $hosts ) {
    // read header X-Forwarded-Host and HTTP_X_FORWARDED_HOST
    $add_host = isset($_SERVER['X-Forwarded-Host']) ? $_SERVER['X-Forwarded-Host'] : isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : '';
    if (! empty($add_host)) {
        $hosts[] = $add_host;
    }

    return array_merge( $hosts );
}

function forwarded_site_url( $url ) {
    if (is_admin() || $GLOBALS['pagenow'] === 'wp-login.php') {
        $headers = apache_request_headers();
        if (isset($headers['HTTP_X_FORWARDED_HOST']) && defined('EDITOR_SITEURL') && defined('INT_SITEURL') && isset($headers['X_HOST_TYPE']) && $headers['X_HOST_TYPE'] == 'private') {
            $url = str_replace(INT_SITEURL, EDITOR_SITEURL, $url);
        }
    }

    return $url;
}

function forwarded_attachments_url($url) {
    if (is_admin()) {
        $headers = apache_request_headers();
        if( isset($headers['HTTP_X_FORWARDED_HOST']) && defined('EDITOR_SITEURL') && defined('INT_SITEURL') && isset($headers['X_HOST_TYPE']) && $headers['X_HOST_TYPE'] == 'private' ) {
            $url = str_replace( 'http:', 'https:', $url );
            $url = str_replace( INT_SITEURL, EDITOR_SITEURL, $url );
        }
    }

    return $url;
}

function public_redirect_url( $redirect_url, $requested_url ) {
    $headers = apache_request_headers();
    if ( defined('PUBLIC_SITEURL') && isset($headers['X_HOST_TYPE']) && $headers['X_HOST_TYPE'] == 'public' ) {
        global $pre_path;
        $path = '/';
        $home_url = parse_url( home_url() )['host'];
        if (isset($pre_path)) {
            $path = $pre_path;
        }
        $redirect_url = str_replace( $home_url, PUBLIC_SITEURL.$path, $redirect_url );
    }

    return $redirect_url;
}

function redirect_url_filter( $url ) {
    $headers = apache_request_headers();
    if ( defined('PUBLIC_SITEURL') && isset($headers['X_HOST_TYPE']) && $headers['X_HOST_TYPE'] == 'public' ) {
        global $pre_path;
        $path = '/';
        $home_url = parse_url( home_url() )['host'];
        if (isset($pre_path)) {
            $path = $pre_path;
        }
        $url = str_replace( $home_url, PUBLIC_SITEURL.$path, $url );
    }

    return $url;
}

function tna_aws_get_client_ip() {
    //whether ip is from share internet
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from remote address
    else
    {
        $ip_address = $_SERVER['REMOTE_ADDR'];
    }
    return $ip_address;
}

function tna_aws_add_menu_item() {
    add_options_page('AWS admin', 'AWS admin', 'manage_options', 'tna-aws-admin', 'tna_aws_admin_page', null, 99);
}

function tna_aws_admin_page_settings() {
    register_setting( 'tna-aws-group', 'rd_ip_whitelist' );
}

function tna_aws_admin_page() {
    ?>
    <style>
        .tna-aws-admin input[type=text], .tna-aws-admin textarea {
            width: 100%;
            max-width: 480px;
            height: 130px;
        }
        .tna-aws-admin .dash-frame {
            border: 1px solid #ddd;
            padding: 1em;
            background-color: #fff;
            max-width: 576px;
        }
        .tna-aws-admin p {
            margin: 1em 0;
        }
    </style>
    <div class="wrap tna-aws-admin">
        <h1>AWS admin</h1>
        <hr>
        <p>Your IP address: <strong><?php echo tna_aws_get_client_ip() ?></strong></p>
        <p>Ec2 Instance IP address:
            <?php if (isset($_SERVER['SERVER_ADDR'])) {
                echo $_SERVER['SERVER_ADDR'];
            } else {
                echo 'null';
            }
            ?>
        </p>
        <p>Forwarded host URL (HTTP_X_FORWARDED_HOST):
            <?php if (isset($_SERVER['HTTP_X_FORWARDED_HOST'])) {
                echo str_replace('.', '-', $_SERVER['HTTP_X_FORWARDED_HOST']);
            } else {
                echo 'null';
            }
            ?>
        </p>
        <p>Forwarded host URL (X-Forwarded-Host):
            <?php if (isset($_SERVER['X-Forwarded-Host'])) {
                echo str_replace('.', '-', $_SERVER['X-Forwarded-Host']);
            } else {
                echo 'null';
            }
            ?>
        </p>
        <p>Site URL: <?php echo str_replace('.', '-', site_url()) ?></p>
        <p>Home URL: <?php echo str_replace('.', '-', home_url()) ?></p>
        <p>Parse Home URL: <?php echo str_replace('.', '-', parse_url( home_url() )['host']) ?></p>
        <p>Get Option Home URL: <?php echo str_replace('.', '-', get_option('home')) ?></p>
        <p>Admin URL: <?php echo str_replace('.', '-', admin_url()) ?></p>
        <hr>
        <h2>Search engine bots</h2>
        <h3>robots.txt</h3>
        <p class="dash-frame">
            <?php
            if ( file_exists(ABSPATH.'robots.txt') ) {
                $file = file_get_contents(ABSPATH.'robots.txt');
                echo nl2br($file);
            } else {
                echo 'No robots.txt file found';
            }
            ?>
        </p>
    </div>
    <?php
}

function aws_meta() {
    global $pre_path;
    echo '<!-- 
    Public URL: '.PUBLIC_SITEURL.'
    Private URL: '.EDITOR_SITEURL.'
    Internal URL: '.INT_SITEURL.'
    Site URL: '.str_replace('.', '-', site_url()).'
    Home URL: '.str_replace('.', '-', home_url()).'
    Parse Home URL: '.str_replace('.', '-', parse_url( home_url() )['host']).'
    Get Option Home URL: '.str_replace('.', '-', get_option('home')).'
    Path: '.$pre_path.'
    -->';
}
