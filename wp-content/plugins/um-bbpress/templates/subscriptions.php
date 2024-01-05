<?php
/**
 * Template for the UM bbPress "Subscriptions" subtab
 * Used on the "Profile" page, "Forums" tab
 * Called from the um_bbpress_user_subscriptions() function
 * @version 2.1.4
 *
 * This template can be overridden by copying it to yourtheme/ultimate-member/um-bbpress/subscriptions.php
 * @var object $loop
 * @var array  $subscribed
 * @var array  $subscribed_topics
 * @var array  $subscribed_forums
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$show_subscription = get_query_var( 'bbp-subscription' ); ?>

<form class="um-show-bbp-subscription" method="get" action="">
	<input type="hidden" name="profiletab" value="forums" />
	<input type="hidden" name="subnav" value="subscriptions" />
	<select class="bbp-subscription" name="bbp-subscription" onchange="this.form.submit();">
		<?php // translators: %d is a subscriptions count. ?>
		<option value="all"><?php echo sprintf( __( "Show all subscriptions (%d)", 'um-bbpress' ), count( $subscribed ) ); ?></option>
		<?php // translators: %d is a subscriptions count to topics. ?>
		<option value="topic" <?php selected( $show_subscription, 'topic', true ); ?> ><?php echo sprintf( __( "Subscribed Topics (%d)", 'um-bbpress' ), count( $subscribed_topics ) ); ?></option>
		<?php // translators: %d is a subscriptions count to forums. ?>
		<option value="forum" <?php selected( $show_subscription, 'forum', true ); ?> ><?php echo sprintf( __( "Subscribed Forums (%d)", 'um-bbpress' ), count( $subscribed_forums ) ); ?></option>
	</select>
</form>

<?php if ( $loop && $loop->have_posts() ) { ?>

	<?php while ( $loop->have_posts() ) {
		$loop->the_post();
		$post_type = get_post_type();

		if ( empty( $show_subscription ) || in_array( $show_subscription, array( 'all', '', $post_type ) ) ) {
			if ( $post_type == 'forum' ) {
				$forum_id = get_the_ID();
			}
			if ( $post_type == 'topic' ) {
				$topic_id = get_the_ID();
			}
			$post_id = isset( $forum_id ) ? $forum_id : $topic_id; ?>

			<div class="um-item">

				<?php if ( UM()->roles()->um_current_user_can( 'edit', um_user( 'ID' ) ) ) { ?>

						<?php if ( $post_type == 'topic' ) { ?>
							<a href="javascript:void(0);" class="um-remove-subscription um-tip-e"
							   title="<?php _e( 'Unsubscribe', 'um-bbpress' ); ?>"
							   data-bbpress-type="<?php echo esc_attr( $post_type ); ?>"
							   data-user_id="<?php echo esc_attr( um_user( 'ID' ) ); ?>" data-argument="<?php echo esc_attr( $topic_id ); ?>"
							   rel="nofollow"><i class="um-icon-close"></i></a>
						<?php } elseif ( $post_type == 'forum' ) { ?>
							<a href="javascript:void(0);" class="um-remove-subscription um-tip-e"
							   title="<?php _e( 'Unsubscribe', 'um-bbpress' ); ?>"
							   data-bbpress-type="<?php echo esc_attr( $post_type ); ?>"
							   data-user_id="<?php echo esc_attr( um_user( 'ID' ) ); ?>" data-argument="<?php echo esc_attr( $forum_id ); ?>"
							   rel="nofollow"><i class="um-icon-close"></i></a>
						<?php } ?>

				<?php } ?>

				<div class="um-item-link">
					<a href="<?php echo esc_url( get_the_permalink() ); ?>">
						<?php if ( 'topic' === $post_type ) {
							bbp_topic_title( $topic_id );
						} else {
							bbp_forum_title( $forum_id );
						} ?>
					</a>
				</div>
				<div class="um-item-meta">
					<?php if ( 'topic' === $post_type ) { ?>
						<span><i class="um-faicon-comment"></i> <?php esc_html_e( 'Topic', 'um-bbpress' ); ?></span>
						<?php // translators: %1$s is a forum permalink; %2$s is a forum title. ?>
						<span><?php printf( __( ' in: <a href="%1$s">%2$s</a>', 'um-bbpress' ), bbp_get_forum_permalink( bbp_get_topic_forum_id( $topic_id ) ), bbp_get_forum_title( bbp_get_topic_forum_id( $topic_id ) ) ); ?></span>
						<span><?php _e( 'Voices', 'um-bbpress' ); ?>
							: <?php echo bbp_get_topic_voice_count( $topic_id ); ?></span>
						<span><?php _e( 'Replies', 'um-bbpress' ); ?>
							: <?php echo bbp_get_topic_reply_count( $topic_id ); ?></span>
						<?php // translators: %s is a last active time of topic. ?>
						<?php echo ( bbp_get_topic_last_active_time( $topic_id ) ) ? '<span>' . sprintf( __( 'Last active %s', 'um-bbpress' ), bbp_get_topic_last_active_time( $topic_id ) ) . '</span>' : ''; ?>
					<?php } elseif ( 'forum' === $post_type ) { ?>
						<span><i class="um-faicon-comments"></i> <?php esc_html_e( 'Forum', 'um-bbpress' ); ?></span>
						<span><?php esc_html_e( 'Topics', 'um-bbpress' ); ?>
							: <?php echo bbp_forum_topic_count( $forum_id ); ?></span>
						<span><?php esc_html_e( 'Replies', 'um-bbpress' ); ?>
							: <?php echo bbp_show_lead_topic( $forum_id ) ? bbp_forum_reply_count( $forum_id ) : bbp_forum_post_count( $forum_id ); ?></span>
						<?php // translators: %s is a last active time of topic. ?>
						<?php echo ( bbp_get_topic_last_active_time( $forum_id ) ) ? '<span>' . sprintf( __( 'Last active %s', 'um-bbpress' ), bbp_get_topic_last_active_time( $forum_id ) ) . '</span>' : ''; ?>
					<?php } ?>
				</div>
			</div>
			<?php
		}
	}
} else {
	?>
	<div class="um-profile-note">
		<span><?php echo ( um_profile_id() == get_current_user_id() ) ? esc_html__( 'You are not currently subscribed to any topics.', 'um-bbpress' ) : esc_html__( 'This user is not currently subscribed to any topics.', 'um-bbpress' ); ?></span>
	</div>
	<?php
}
