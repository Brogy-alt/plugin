<?php

/*
 * Plugin Name:       The worst plugin 
 * Description:       Bro I don't know.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Brogan Gys
 */

 // Remove the admin bar from the front end
add_filter( 'show_admin_bar', '__return_false' );

//Allow Contributors to Upload Images
if ( current_user_can('contributor') && !current_user_can('upload_files') )
     add_action('admin_init', 'allow_contributor_uploads');      
     function allow_contributor_uploads() {
          $contributor = get_role('contributor');
          $contributor->add_cap('upload_files');
     }

//Protect Your Site from Malicious Requests
     global $user_ID; if($user_ID) {
        if(!current_user_can('administrator')) {
            if (strlen($_SERVER['REQUEST_URI']) > 255 ||
                stripos($_SERVER['REQUEST_URI'], "eval(") ||
                stripos($_SERVER['REQUEST_URI'], "CONCAT") ||
                stripos($_SERVER['REQUEST_URI'], "UNION+SELECT") ||
                stripos($_SERVER['REQUEST_URI'], "base64")) {
                    @header("HTTP/1.1 414 Request-URI Too Long");
                    @header("Status: 414 Request-URI Too Long");
                    @header("Connection: Close");
                    @exit;
            }
        }
    }


