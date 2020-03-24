<?php
/*
 * Plugin Name:       Action Link
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            John Smith
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       alink
 * Domain Path:       /languages
*/




    add_action("admin_menu", function(){
        add_menu_page( "Action Link", "Action Link", "manage_options", "actionlink", "display_action_link" );
    });
    function display_action_link(){
        echo "<h2>Actio Link Demo.</h2>";
    }

    add_action("activated_plugin", function($plugin){
        if(plugin_basename(__FILE__) == $plugin){
            wp_redirect(admin_url("admin.php?page=actionlink"));
            die();
        }
    });
    add_filter("plugin_action_links_".plugin_basename(__FILE__), function($links){
        $link = sprintf("<a href='%s'>%s</a>", admin_url("admin.php?page=actionlink"), "Setting" );
        array_push($links, $link);
        return $links;  
    });

    add_filter("plugin_row_meta", function($links, $plugin){
        if(plugin_basename(__FILE__) == $plugin){
            $link = sprintf("<a href='%s' target='_blank'>%s</a>", "http://www.github.com", "Github" );
            array_push($links, $link);
        }
        return $links;
    }, 10, 2);
?>