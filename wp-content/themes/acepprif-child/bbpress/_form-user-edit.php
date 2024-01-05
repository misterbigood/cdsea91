<?php

/**
 * bbPress User Profile Edit Part
 *
 * @package bbPress
 * @subpackage Theme
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

?>
<div id="debug">_form-user-edit</div>
<form id="bbp-your-profile" method="post" enctype="multipart/form-data">

	<h2 class="entry-title"><?php esc_html_e( 'Name', 'bbpress' ) ?></h2>

	<?php do_action( 'bbp_user_edit_before' ); ?>

	<fieldset class="bbp-form">
		<legend><?php esc_html_e( 'Name', 'bbpress' ) ?></legend>

		<?php do_action( 'bbp_user_edit_before_name' ); ?>

		<div>
			<label for="first_name"><?php esc_html_e( 'First Name', 'bbpress' ) ?></label>
			<input type="text" name="first_name" id="first_name" value="<?php bbp_displayed_user_field( 'first_name', 'edit' ); ?>" class="regular-text" />
		</div>

		<div>
			<label for="last_name"><?php esc_html_e( 'Last Name', 'bbpress' ) ?></label>
			<input type="text" name="last_name" id="last_name" value="<?php bbp_displayed_user_field( 'last_name', 'edit' ); ?>" class="regular-text" />
		</div>

		<div>
			<label for="nickname"><?php esc_html_e( 'Nickname', 'bbpress' ); ?></label>
			<input type="text" name="nickname" id="nickname" value="<?php bbp_displayed_user_field( 'nickname', 'edit' ); ?>" class="regular-text" />
		</div>

		<div>
			<label for="display_name"><?php esc_html_e( 'Display Name', 'bbpress' ) ?></label>

			<?php bbp_edit_user_display_name(); ?>

		</div>

		<?php do_action( 'bbp_user_edit_after_name' ); ?>

	</fieldset>
	
	<h2 class="entry-title"><?php bbp_is_user_home_edit()
		? esc_html_e( 'About Yourself', 'bbpress' )
		: esc_html_e( 'About the user', 'bbpress' );
	?></h2>

	<fieldset class="bbp-form">
		<legend><?php bbp_is_user_home_edit()
			? esc_html_e( 'About Yourself', 'bbpress' )
			: esc_html_e( 'About the user', 'bbpress' );
		?></legend>

		<?php do_action( 'bbp_user_edit_before_about' ); ?>
		<?php
		/* Récupérer les meta crèche et groupe
		*/
		$displayed_user_submitted = get_user_meta( bbp_get_displayed_user_id() , "submitted");
		$displayed_user_groupe = $displayed_user_submitted[0]["groupe"][0];
		$displayed_user_creche = $displayed_user_submitted[0]["creche"];
		?>
		
		<div>
			<label for="user_groupe"><?php esc_html_e( 'Groupe', 'bbpress' ) ?></label>
			<input type="text" name="user_groupe" id="user_groupe" value="<?php echo $displayed_user_groupe; ?>" class="regular-text" disabled="disabled" />
		</div>
		
		<div>
			<label for="user_creche"><?php esc_html_e( 'Creche', 'bbpress' ) ?></label>
			<input type="text" name="user_creche" id="user_creche" value="<?php echo $displayed_user_creche; ?>" class="regular-text" disabled="disabled" />
		</div>
		<div>
			<label for="description"><?php esc_html_e( 'Quelques mots de présentation', 'bbpress' ); ?></label>
			<textarea name="description" id="description" rows="5" cols="30"><?php bbp_displayed_user_field( 'description', 'edit' ); ?></textarea>
		</div>
		
		
		<?php do_action( 'bbp_user_edit_after_about' ); ?>

	</fieldset>

	<div style="display: none"> <!-- div ajouté pour masquer -->
	<h2 class="entry-title"><?php esc_html_e( 'Account', 'bbpress' ) ?></h2>

	<fieldset class="bbp-form">
		<legend><?php esc_html_e( 'Account', 'bbpress' ) ?></legend>

		<?php do_action( 'bbp_user_edit_before_account' ); ?>

		<div>
			<label for="user_login"><?php esc_html_e( 'Username', 'bbpress' ); ?></label>
			<input type="text" name="user_login" id="user_login" value="<?php bbp_displayed_user_field( 'user_login', 'edit' ); ?>" maxlength="100" disabled="disabled" class="regular-text" />
		</div>

		<div>
			<label for="email"><?php esc_html_e( 'Email', 'bbpress' ); ?></label>
			<input type="text" name="email" id="email" value="<?php bbp_displayed_user_field( 'user_email', 'edit' ); ?>" maxlength="100" class="regular-text" autocomplete="off" />
		</div>

		<?php bbp_get_template_part( 'form', 'user-passwords' ); ?>

		<div>
			<label for="locale"><?php esc_html_e( 'Language', 'bbpress' ) ?></label>

			<?php bbp_edit_user_language(); ?>

		</div>

		<?php do_action( 'bbp_user_edit_after_account' ); ?>

	</fieldset>
	</div> <!-- div ajouté pour masquer -->

	<fieldset class="submit">
		<legend><?php esc_html_e( 'Save Changes', 'bbpress' ); ?></legend>
		<div>

			<?php bbp_edit_user_form_fields(); ?>

			<button type="submit" id="bbp_user_edit_submit" name="bbp_user_edit_submit" class="button submit user-submit"><?php bbp_is_user_home_edit()
				? esc_html_e( 'Update Profile', 'bbpress' )
				: esc_html_e( 'Update User',    'bbpress' );
			?></button>
		</div>
	</fieldset>
</form>
