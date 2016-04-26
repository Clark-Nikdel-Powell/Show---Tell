<?php

add_action('admin_menu', 'SAT_options_page');

function SAT_options_page() {
	// Add an Options Page, restricted to Administrators with 'Activate Plugins' priveleges
	add_options_page( 'Show & Tell', 'Show & Tell', 'activate_plugins', 'show-and-tell', 'SAT_settings_setup');
}

// Setup: A very good place to start
function SAT_settings_setup() {
	$slug = 'show-and-tell';

	// Add Options
	add_option('SAT_default_css');

	// Update Options
	if ( isset($_POST['submit']) ) {
		update_option('SAT_default_css',  $_POST['SAT_default_css']);

		$message = '<div id="message" class="updated"><p>Show and Tell settings updated.</p></div>';
	}
?>
	<div class="wrap">
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'].'?page='.$slug; ?>">
	<h2>Show &amp; Tell</h2>
	<?php (isset($message) ? $message : ''); ?>

	<table class="form-table">
	<tr valign="top">
		<th scope="row">
			<label for="SAT_default_css">
				Disable Default CSS
			</label>
		</th>
		<td>
			<?php echo get_option('SAT_default_css'); ?>
			<input type="checkbox" id="SAT_default_css" name="SAT_default_css" />
		</td>
	</tr>
	</table>
	<p class="submit"><?php submit_button('Save Changes', 'primary', 'submit', false); ?></p>
	</form>
	</div>
<?php
}
