<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       funcy
 * @since      1.0.0
 *
 * @package    Show_Authors
 * @subpackage Show_Authors/admin/partials
 */
?>

<?php $options = get_option('roles_to_show');?>

<div class="grid-container">

	<div class="headerL-cell">
		<h1 class='wp-heading-inline'>&ltshow-users&gt</h1>

		<h4>Use the shortcode [show_authors] to add the 'Show Users' button.</h4>
	</div>

	<div class="content-cell">

		<table class="wp-list-table widefat fixed striped table-view-list posts">
			<thead>
				<tr>
					<td id="cb" class="column-cb check-column"></td>
					<th scope="col" id="title" class="">
						<h4 class='no-margin'>Role</h4>
					</th>
				</tr>
			</thead>

			<tbody id="the-list">
				<tr>
					<th scope="row" class="check-column">
						<input id='admin' type="checkbox"
						<?php if($options['admin']){echo 'checked';}?>>
					</th>
					<td class="title column-title column-primary">
						<strong>Admin</strong>
					</td>
				</tr>
				<tr>
					<th scope="row" class="check-column">
						<input id='author' type="checkbox"
						<?php if($options['author']){echo 'checked';}?>>
					</th>
					<td class="title column-title column-primary">
						<strong>Author</strong>
					</td>
				</tr>
				<tr>
					<th scope="row" class="check-column">
						<input id='editor' type="checkbox"
						<?php if($options['editor']){echo 'checked';}?>>
					</th>
					<td class="title column-title column-primary">
						<strong>Editor</strong>
					</td>
				</tr>
			</tbody>
		</table>

		<button class='button-styling' onclick='saveOptions()'>Save</button>

	</div>

	<div class="footer-cell">
		<div id='show-saved' class="settings-saved">
			<h3 id='saved-heading'>Settings Saved</h3>
		</div>
	</div>
	
</div>