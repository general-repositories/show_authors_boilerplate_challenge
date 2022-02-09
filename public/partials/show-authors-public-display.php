<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       funcy
 * @since      1.0.0
 *
 * @package    Show_Authors
 * @subpackage Show_Authors/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div
	id="showUsers"
	class='users-div'
	data-nonce="<?php echo wp_create_nonce("show_authors_nonce");?>"
	post-id="<?php echo get_the_ID();?>"
	user="<?php echo get_current_user_id();?>"
>
	<button onclick="showUsers()">show users</button>

	<ul id="userList">

	</ul>
</div>