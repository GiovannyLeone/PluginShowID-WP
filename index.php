<?php
/**
 * @package GET ID User
 * @version 0.0.1
 */
/*
Plugin Name: GET ID User - Task - WPMU DEV
Plugin URI: https://github.com/GiovannyLeone/PluginShowID-WP
Description: This a plugin that get the ID of Users for show to display in screen
Author: Giovanny Leone
Version: 0.0.1
Author URI: https://giovannyleone.com/
*/
?>

<?php

class IdUser{
    public function showId()
    {
    # Create and take the URL in this Page
    $serverAdm = "http://"; // in public server, i ´ll change the http to https
    $requestPage = $_SERVER['REQUEST_URI']; #Take the folder and file of page
    # Explode URL for take with "/" to take de file name of archive
    $explodeURL = explode('/', $requestPage); # 1° time for explode all url
    @$explodeURLRequest = explode('?', $explodeURL[3]); # 2° time, explode/Split the "?" Request in URL
    @$serverAdm .= $explodeURL[1] . "/" . "wp-admin/" . $explodeURLRequest[0]; #Create URL for conditional, That "$explodeURL[0]" make the URL, always stay with the file name of the page
    @$serverUser = "http:/" . $_SERVER['SCRIPT_NAME']; #Take the URL of current page
    @$fixServerUser = "http://" . $explodeURL[1] . "/" . "wp-admin/index.php";

        # Conditional for this plugin don´t work in dashboard
        if ($serverAdm != $serverUser && $fixServerUser != $serverUser) {
            # Verifying if exist a session
            if ( ! function_exists( 'tutsup_session_start' ) ) {
                # Function to Session
                function tutsup_session_start() {
                    # Verifying if the User is login
                    if (is_user_logged_in()) {
                        $user = wp_get_current_user(); # Take the session of User 
                        $idUserDisplay = $user->{"data"}->display_name; #Take the Display name in DB
                        # Show in HTML
                        ?>
                        <span style="background: #FFF; position: fixed; right: 10px; top: 50px; padding: 5px 10px;">Hello, <?=$idUserDisplay?></span> 
                        <?php
                    }
                }
                # Execute the Plugin!
                add_action( 'init', 'tutsup_session_start' );
            }   
        }

    }    
}
# Show the class and the plugin
$showId = new IdUser;
$showId->showId();


