<?php

/**
 * Archive Forum Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

?>

<div id="bbpress-forums" class="bbpress-wrapper">
	<div id="forums-text-intro"><p class="up">Bienvenue sur les forums de l’Acepprif !</p>
	<p class="bbp-forum-content">Vous trouverez notre <a href="https://www.acepprif.org/charte-dutilisation-des-forums-acepprif-org/">charte d’utilisation ici</a>.<br>
	Pour nous signaler tout problème technique ou tout contenu non-approprié : administrateurs[at]acepprif.org</p></div>

	<?php bbp_get_template_part( 'form', 'search' ); ?>

	<?php bbp_breadcrumb(); ?>

	<?php bbp_forum_subscription_link(); ?>

	<?php do_action( 'bbp_template_before_forums_index' ); ?>

	<?php if ( bbp_has_forums() ) : ?>

		<?php bbp_get_template_part( 'loop',     'forums'    ); ?>

	<?php else : ?>

		<?php bbp_get_template_part( 'feedback', 'no-forums' ); ?>

	<?php endif; ?>

	<?php do_action( 'bbp_template_after_forums_index' ); ?>

</div>
