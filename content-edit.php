<?php
/**
* Plugin Name: Content Edit
* Plugin URI: http://www.jamesgeorgedunn.com
* Description: Shows a fixed button for easier editing of pages when a user is logged in.
* Version: 1.0
* Author: James George Dunn
* Author URI: http://www.jamesgeorgedunn.com
* License: GNU General Public License
*/

// Disable the default WP admin bar
add_filter('show_admin_bar', '__return_false');

function content_edit() {
	// Only calls the function if a user is logged into the CMS
	if(is_user_logged_in()) {
		// Gets the pages ID
		$postID = get_queried_object_id();
		// Gets the url of the website
		$homeURL = home_url();
		// Gets the path of the admin
		$showPost = "/wp-admin/post.php?post=";
		// Places the edit action
		$editAction = "&action=edit";
		// Ties the variables together
		$contentEdit = $homeURL . $showPost . $postID . $editAction;
		
		// A little styling
		$styleCSS = '
			<style>
				.edit-content {
					display: table;
					position: fixed;
					bottom: 15px;
					left: 15px;
					z-index: 100;
				}
				
				.edit-content a {
					width: 50px;
					height: 50px;
					-moz-border-radius: 25px 25px 25px 0;
					-webkit-border-radius: 25px 25px 25px 0;
					border-radius: 25px 25px 25px 0;
					background: #9dd4c7;
					color: #25586e;
					display: block;
					display: table-cell;
					vertical-align: middle;
					text-align: center;
				}
				
				.edit-content a:hover {
					background: #25586e;
					color: #9dd4c7;
				}
			</style>';
		
		// The HTML
		$theHTML = '
			<div class="edit-content">
				<a href="' . $contentEdit . '">Edit</a>
			</div>';
		
		// Bringing it all together
		echo $styleCSS . $theHTML;
	}
}

// Add the function to the header
add_action('wp_head', 'content_edit', 1);

?>