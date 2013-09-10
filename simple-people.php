<?php
/*
Plugin Name: SimplePeople
Plugin URI: https://github.com/jpobley/SimplePeople
Description: A small plugin that allows for the basic design and ordering of people on a "Team" or "About Us" page.
Version: 1.0
Author: JP Obley
Author URI: http://www.jpobley.com
License: GPL2

Copyright 2013 JP Obley (email : jpobley@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//The Magic!
function simple_people_function( $atts , $content = null ) {
    
    // Attributes from shortcode
    extract( shortcode_atts(
        array(
            'username' => null,
            'photo_url' => null,
            'tel_num' => null,
            'office_num' => null,
            'email_addr' => null,
            'disp_name' => null
        ), $atts )
    );

    // Actual code
    global $wpdb;
    
    //Get person from db
    if ($username) {
        $q = $wpdb->prepare("SELECT *
                             FROM $wpdb->users
                             WHERE user_login = %s", $username);
                                      
        $person = $wpdb->get_results($q)[0];
    
       //Get info from db                 
        $q = $wpdb->prepare("SELECT meta_key, meta_value
                             FROM $wpdb->usermeta
                             WHERE user_id = %s", $person->ID);
    
        $person_meta = $wpdb->get_results($q, OBJECT_K);
    
        $bio = $content ? $content : $person_meta['description']->meta_value;
        
        $display_name = $disp_name ? $disp_name : $person->display_name;
        
        $email = $email_addr ? $email_addr : $person->user_email;
        
        if ( $photo_url ) {
            $pic = $photo_url;    
        }
        elseif ( $person_meta['author_profile_picture'] ){
            $pic = $person_meta['author_profile_picture']->meta_value;
        }
        else {
            $pic = "http://placehold.it/500x500";
        }
        
        $pic = "<div class='ppl-img'>
                    <img src='$pic' title='$display_name'/>
                </div>";
                
        if($person){                   
            return "<div class='ppl'>" . $pic 
                                                         . "<p>Email: " . $email
                                                         . "<br/>Phone: " . $phone
                                                         . "<br/>Office: " . $office
                                                         . "</p><p>" 
                                                         . $bio 
                                                         . "</p></div>";
        }

    }
    else {
        return;
    }
}

function simple_people_settings_link(){
    add_options_page( 'Simple People Instructions', 'Simple People', 'activate_plugins', 'SimplePeople', 'simple_people_instructions_page');
}

function simple_people_action_links($links, $file) {
    if ( $file != 'simple-people/simple-people.php' ) return $links;
    $settings_link = '<a href="' . site_url() . '/wp-admin/options-general.php?page=SimplePeople">' . esc_html( __( 'Instructions') ) . '</a>';
    array_unshift( $links, $settings_link );
    return $links;
}

function simple_people_instructions_page(){
    $html = file_get_contents( plugins_url( 'instructions.html', __FILE__) );
    print $html;
}

// Add Shortcode and actions
add_shortcode( 'simpleperson', 'simple_people_function' );
add_action( 'admin_menu', 'simple_people_settings_link' );
add_filter( 'plugin_action_links','simple_people_action_links', 10, 2 );