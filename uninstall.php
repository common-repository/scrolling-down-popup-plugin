<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

delete_option('sdp_cookies');
delete_option('sdp_On_Homepage');
delete_option('sdp_On_Posts');
delete_option('sdp_On_Pages');
delete_option('sdp_On_Archives');
delete_option('sdp_On_Search');
 
// for site options in Multisite
delete_site_option('sdp_cookies');
delete_site_option('sdp_On_Homepage');
delete_site_option('sdp_On_Posts');
delete_site_option('sdp_On_Pages');
delete_site_option('sdp_On_Archives');
delete_site_option('sdp_On_Search');

global $wpdb;
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}scrolling_down_popup");