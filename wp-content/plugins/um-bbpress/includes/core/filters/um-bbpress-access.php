<?php if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * inherit topic access control from their parent "forums"
 *
 * @param $post_id
 * @return int
 */
/*function um_bbpress_access_control_for_topics( $post_id ) {
	$is_forum = bbp_get_topic_forum_id( $post_id );
	if ( $is_forum )
		return $is_forum;
	return $post_id;
}
add_filter( 'um_access_control_for_parent_posts', 'um_bbpress_access_control_for_topics' );*/

/**
 * Hide/Show "Create Topic" at forum's page
 *
 * @param $have_posts
 * @param $query
 * @return mixed
 */
function um_bbpress_bbp_has_topics_hide_creation( $have_posts, $query ) {
	$post_id = $query->query['post_parent'];

	// Ignore UM settings for not logged-in user
	if ( ! is_user_logged_in() ) {
		return $have_posts;
	}

	if ( current_user_can( 'administrator' ) ) {
		return $have_posts;
	}

	if ( isset( $post_id ) ) {

		um_fetch_user( get_current_user_id() );
		$_um_bbpress_can_topic = get_post_meta( $post_id, '_um_bbpress_can_topic', true );
		if ( empty( $_um_bbpress_can_topic ) ) {
			if ( um_user( 'can_create_topics' ) ) {
				add_filter( 'bbp_current_user_can_access_create_topic_form', '__return_true' );
			} else {
				add_filter( 'bbp_current_user_can_access_create_topic_form', '__return_false' );
			}
		} else {
			$current_user_roles = um_user( 'roles' );
			if ( ! empty( $current_user_roles ) && count( array_intersect( $current_user_roles, $_um_bbpress_can_topic ) ) > 0 ) {
				add_filter( 'bbp_current_user_can_access_create_topic_form', '__return_true' );
			} else {
				add_filter( 'bbp_current_user_can_access_create_topic_form', '__return_false' );
			}
		}
	}

	return $have_posts;
}
add_filter( 'bbp_has_topics', 'um_bbpress_bbp_has_topics_hide_creation', 10, 2 );

/**
 * @param $args
 * @return mixed
 */
function um_bbpress_bbp_has_replies_query( $args ) {
	if ( current_user_can( 'manage_options' ) ) {
		return $args;
	}

	// Ignore UM settings for not logged-in user
	if ( ! is_user_logged_in() ) {
		return $args;
	}

	$replies = new WP_Query( $args );

	if ( empty( $replies->post ) ) {
		return $args;
	}

	$topics = new WP_Query(
		array(
			'post_type' => 'topic',
			'post__in'  => array(
				$replies->post->ID,
			),
		)
	);

	if ( isset( $topics->post->post_parent ) ) {

		um_fetch_user( get_current_user_id() );

		$post_id = $topics->post->post_parent;

		$post = get_post( $post_id );
		if ( ! $post ) {
			return $args;
		}

		$_um_bbpress_can_reply = get_post_meta( $post_id, '_um_bbpress_can_reply', true );
		if ( empty( $_um_bbpress_can_reply ) ) {
			if ( um_user( 'can_create_replies' ) ) {
				add_filter( 'bbp_current_user_can_access_create_reply_form', '__return_true' );
			} else {
				add_filter( 'bbp_current_user_can_access_create_reply_form', '__return_false' );
			}
		} else {
			$current_user_roles = um_user( 'roles' );
			if ( ! empty( $current_user_roles ) && count( array_intersect( $current_user_roles, $_um_bbpress_can_reply ) ) > 0 ) {
				add_filter( 'bbp_current_user_can_access_create_reply_form', '__return_true' );
			} else {
				add_filter( 'bbp_current_user_can_access_create_reply_form', '__return_false' );
			}
		}

		if ( UM()->access()->is_restricted( $post_id ) ) {
			$args['post__in'] = array( '0' );
		}
	}

	return $args;
}
add_filter( 'bbp_has_replies_query', 'um_bbpress_bbp_has_replies_query', 10, 1 );


/**
 * Add a class to help us hide it from forums list
 *
 * @param $classes
 * @param $post_id
 * @return array
 */
function um_bbpress_add_class_to_locked_forum_or_topic( $classes, $post_id ) {
	um_fetch_user( get_current_user_id() );

	$post = get_post( $post_id );

	if ( current_user_can( 'administrator' ) ) {
		return $classes;
	}

	if ( ! $post ) {
		return $classes;
	}

	if ( UM()->access()->is_restricted( $post_id ) ) {
		$classes[] = 'um-bbpress-restricted';
	}

	return $classes;
}
add_filter( 'bbp_get_forum_class', 'um_bbpress_add_class_to_locked_forum_or_topic', 888, 2 );
add_filter( 'bbp_get_topic_class', 'um_bbpress_add_class_to_locked_forum_or_topic', 888, 2 );


/**
 * @param $args
 * @return mixed
 */
function um_bbpress_bbp_has_forums_query( $args ) {
	if ( current_user_can( 'manage_options' ) ) {
		return $args;
	}

	um_fetch_user( get_current_user_id() );

	$forums = new WP_Query( $args );

	$array_forum_ids = array();
	if ( ! empty( $forums->posts ) ) {
		foreach ( $forums->posts as $forum ) {
			if ( UM()->access()->is_restricted( $forum->ID ) ) {
				$array_forum_ids[] = $forum->ID;
			}
		}
	}

	if ( ! empty( $array_forum_ids ) ) {
		$args['post__not_in'] = $array_forum_ids;
	}

	return $args;
}
add_filter( 'bbp_has_forums_query', 'um_bbpress_bbp_has_forums_query', 10, 1 );


/**
 * @param $args
 * @return mixed
 */
function um_bbpress_bbp_has_topics_query( $args ) {
	if ( current_user_can( 'manage_options' ) ) {
		return $args;
	}

	um_fetch_user( get_current_user_id() );

	$topics = new WP_Query( $args );

	$array_topic_ids = array();
	if ( ! empty( $topics->posts ) ) {
		foreach ( $topics->posts as $topic ) {
			if ( UM()->access()->is_restricted( $topic->ID ) ) {
				$array_topic_ids[] = $topic->ID;
			}
		}
	}

	if ( ! empty( $array_topic_ids ) ) {
		$args['post__not_in'] = $array_topic_ids;
	}

	return $args;
}
add_filter( 'bbp_has_topics_query', 'um_bbpress_bbp_has_topics_query', 10, 1 );


/**
 * Restrict access message for bbPress replies
 */
add_filter( 'bbp_get_reply_content', array( UM()->access(), 'filter_restricted_post_content' ), 999999 );


/**
 * Count not restricted topics
 */
function um_bbpress_bbp_get_user_topic_count( $count, $user_id ) {
	$forum_id = bbp_get_forum_id();

	$args = array(
		'post_type'      => 'topic',
		'posts_per_page' => -1,
		'meta_query'     => array(
			'relation' => 'AND',
			array(
				'key'     => '_bbp_forum_id',
				'value'   => $forum_id,
				'compare' => '=',
				'type'    => 'NUMERIC',
			),
			array(
				'key'     => 'um_content_restriction',
				'value'   => 'a:8:{s:26:"_um_custom_access_settings";b:1',
				'compare' => 'LIKE',
			),
		),
	);

	$query = new WP_Query( $args );
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			if ( UM()->access()->is_restricted( get_the_ID() ) ) {
				--$count;
			}
		}
		wp_reset_postdata();
	}

	return $count;
}
add_filter( 'bbp_get_user_topic_count_int', 'um_bbpress_bbp_get_user_topic_count', 10, 2 );
add_filter( 'bbp_get_forum_topic_count', 'um_bbpress_bbp_get_user_topic_count', 10, 2 );


/**
 * Get last not restricted topic id
 *
 * @param $active_id
 * @param $forum_id
 */
function um_bbpress_bbp_get_forum_last_active_id( $active_id, $forum_id ) {
	if ( bbp_is_topic( $active_id ) && UM()->access()->is_restricted( $active_id ) ) {
		$active_id = um_bbpress_get_first_not_restricted( $forum_id, 'topic' );
	}

	return $active_id;
}
add_filter( 'bbp_get_forum_last_active_id', 'um_bbpress_bbp_get_forum_last_active_id', 10, 2 );


/**
 * Get last not restricted reply id. Display in topic list
 *
 * @param $active_id
 * @param $topic_id
 */
function um_bbpress_bbp_get_topic_last_active_id( $active_id, $topic_id ) {
	if ( bbp_is_reply( $active_id ) && UM()->access()->is_restricted( $active_id ) ) {
		$active_id = um_bbpress_get_first_not_restricted( $topic_id, 'reply' );
	}

	return $active_id;
}
add_filter( 'bbp_get_topic_last_active_id', 'um_bbpress_bbp_get_topic_last_active_id', 10, 2 );


/**
 * Topic description if last reply is restricted and 404
 *
 * @param $reply_id
 * @param $topic_id
 */
function um_bbpress_bbp_get_topic_last_reply_id( $reply_id, $topic_id ) {
	if ( UM()->access()->is_restricted( $reply_id ) ) {
		$restriction = UM()->access()->get_post_privacy_settings( $reply_id );
		if ( 1 === absint( $restriction['_um_access_hide_from_queries'] ) ) {
			$reply_id = um_bbpress_get_first_not_restricted( $topic_id, 'reply' );
		}
	}

	return $reply_id;
}
add_filter( 'bbp_get_topic_last_reply_id', 'um_bbpress_bbp_get_topic_last_reply_id', 10, 2 );


/**
 * Get last not restricted post id
 *
 * @param $parent_id
 * @param $type
 */
function um_bbpress_get_first_not_restricted( $parent_id = 0, $type = 'topic' ) {
	global $wpdb;

	$post_id = 0;

	if ( bbp_is_topic( $parent_id ) ) {
		$parent_type = '_bbp_topic_id';
	} else {
		$parent_type = '_bbp_forum_id';
	}

	if ( ! empty( $parent_id ) ) {
		$ids = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT pm.post_id
					FROM {$wpdb->postmeta} AS pm
					INNER JOIN {$wpdb->posts} AS p ON pm.post_id = p.ID
					WHERE pm.meta_key = %s
					AND pm.meta_value = %d
					AND p.post_type = %s",
				$parent_type,
				$parent_id,
				$type
			)
		);

		foreach ( array_reverse( $ids ) as $id ) {
			if ( bbp_is_topic( $parent_id ) ) {
				if ( ! UM()->access()->is_restricted( $id->post_id ) ) {
					$post_id = $id->post_id;
					break;
				} else {
					$restriction = UM()->access()->get_post_privacy_settings( $id->post_id );
					if ( 1 !== absint( $restriction['_um_access_hide_from_queries'] ) ) {
						$post_id = $id->post_id;
						break;
					}
				}
			} else {
				if ( ! UM()->access()->is_restricted( $id->post_id ) ) {
					$post_id = $id->post_id;
					break;
				}
			}
		}
	}

	return $post_id;
}


/**
 * Description for topic
 *
 * @param $retstr
 * @param $r
 * @param $args
 */
function um_bbp_get_single_topic_description( $retstr, $r, $args ) {
	// Parse arguments against default values
	$r = bbp_parse_args(
		$args,
		array(
			'topic_id' => 0,
			'before'   => '<div class="bbp-template-notice info"><ul><li class="bbp-topic-description">',
			'after'    => '</li></ul></div>',
			'size'     => 14,
		),
		'get_single_topic_description'
	);

	// Validate topic_id
	$topic_id = bbp_get_topic_id( $r['topic_id'] );

	// Unhook the 'view all' query var adder
	remove_filter( 'bbp_get_topic_permalink', 'bbp_add_view_all' );

	// Build the topic description
	$vc_int      = bbp_get_topic_voice_count( $topic_id, true );
	$voice_count = bbp_get_topic_voice_count( $topic_id, false );
	$reply_count = um_count_not_restricted_bbp_posts( $topic_id );

	// Singular/Plural
	// translators: 1: voice count, 2: voice count integer
	$voice_count = sprintf( _n( '%s voice', '%s voices', $vc_int, 'bbpress' ), $voice_count );

	$last_reply_id = um_bbpress_get_first_not_restricted( $topic_id, 'reply' );

	// Topic has activity (could be from reply or topic author)
	$last_active = '';
	if ( $last_reply_id ) {
		$last_active = get_the_time( 'F j, Y g:i a', $last_reply_id );
		$last_active = human_time_diff( strtotime( $last_active ) );
	}

	if ( ! empty( $vc_int ) && ! empty( $last_active ) ) {
		$last_updated_by = bbp_get_author_link(
			array(
				'post_id' => $last_reply_id,
				'size'    => $r['size'],
			)
		);
		// translators: 1: reply count, 2: voice count, 3: last active time, 4: last active author link
		$retstr = sprintf( esc_html__( 'This topic has %1$s replies, %2$s, and was last updated %3$s by %4$s.', 'bbpress' ), $reply_count, $voice_count, $last_active, $last_updated_by );

		// Topic has no replies
	} elseif ( ! empty( $vc_int ) && ! empty( $reply_count ) ) {
		// translators: 1: reply count, 2: voice count
		$retstr = sprintf( esc_html__( 'This topic has %1$s and %2$s.', 'bbpress' ), $voice_count, $reply_count );

		// Topic has no replies and no voices
	} elseif ( empty( $vc_int ) && empty( $reply_count ) ) {
		$retstr = esc_html__( 'This topic has no replies.', 'bbpress' );

		// Topic is pending
	} elseif ( bbp_get_topic_status( $topic_id ) === bbp_get_pending_status_id() ) {
		$retstr = esc_html__( 'This topic is pending moderation.', 'bbpress' );

		// Fallback
	} else {
		$retstr = esc_html__( 'This topic is empty.', 'bbpress' );
	}

	// Add the 'view all' filter back
	add_filter( 'bbp_get_topic_permalink', 'bbp_add_view_all' );

	// Combine the elements together
	$retstr = $r['before'] . $retstr . $r['after'];
	return $retstr;
}
add_filter( 'bbp_get_single_topic_description', 'um_bbp_get_single_topic_description', 10, 3 );


/**
 * Count not restricted posts
 *
 * @param $parent_id
 * @param string $type
 * @param string $post_type
 *
 * @return int
 */
function um_count_not_restricted_bbp_posts( $parent_id, $type = '_bbp_topic_id', $post_type = 'reply' ) {
	$count = 0;
	$args  = array(
		'post_type'      => $post_type,
		'posts_per_page' => -1,
		'meta_query'     => array(
			'relation' => 'AND',
			array(
				'key'     => $type,
				'value'   => $parent_id,
				'compare' => '=',
				'type'    => 'NUMERIC',
			),
		),
	);

	$query = new WP_Query( $args );
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$count++;
		}
		wp_reset_postdata();
	}

	return $count;
}


function um_bbp_get_topic_pagination_count( $retstr ) {
	$bbp      = bbpress();
	$topic_id = $bbp->current_topic_id;

	// Set pagination values
	if ( 0 === um_count_not_restricted_bbp_posts( $topic_id ) ) {
		$total_int = 1;
	} else {
		$total_int = absint( $bbp->reply_query->found_posts ) - um_count_not_restricted_bbp_posts( $topic_id );
	}
	$count_int = absint( $bbp->reply_query->post_count );
	$ppp_int   = absint( $bbp->reply_query->posts_per_page );
	$start_int = absint( ( $bbp->reply_query->paged - 1 ) * $ppp_int ) + 1;
	$to_int    = absint( ( $start_int + ( $ppp_int - 1 ) > $total_int ) ? $total_int : $start_int + ( $ppp_int - 1 ) );

	// Format numbers for display
	$count_num = bbp_number_format( $count_int );
	$total_num = bbp_number_format( $total_int );
	$from_num  = bbp_number_format( $start_int );
	$to_num    = bbp_number_format( $to_int );

	// We are threading replies
	if ( bbp_thread_replies() ) {
		$walker  = new BBP_Walker_Reply();
		$threads = absint( $walker->get_number_of_root_elements( $bbp->reply_query->posts ) - 1 );
		// translators: %s = number of threads
		$retstr = sprintf( _n( 'Viewing %1$s reply thread', 'Viewing %1$s reply threads', $threads, 'bbpress' ), bbp_number_format( $threads ) );

		// We are not including the lead topic
	} elseif ( bbp_show_lead_topic() ) {

		// Several replies in a topic with a single page
		if ( empty( $to_num ) ) {
			// translators: %s = number of replies
			$retstr = sprintf( _n( 'Viewing %1$s reply', 'Viewing %1$s replies', $total_int, 'bbpress' ), $total_num );

			// Several replies in a topic with several pages
		} else {
			// translators: 1: number of replies, 2: number of replies from, 3: number of replies to, 4: total number of replies
			$retstr = sprintf( _n( 'Viewing %2$s replies (of %4$s total)', 'Viewing %1$s replies - %2$s through %3$s (of %4$s total)', $count_int, 'bbpress' ), $count_num, $from_num, $to_num, $total_num );
		}

		// We are including the lead topic
	} else {

		// Several posts in a topic with a single page
		if ( empty( $to_num ) ) {
			// translators: %s = number of posts
			$retstr = sprintf( _n( 'Viewing %1$s post', 'Viewing %1$s posts', $total_int, 'bbpress' ), $total_num );

			// Several posts in a topic with several pages
		} else {
			// translators: 1: number of posts, 2: number of posts from, 3: number of posts to, 4: total number of posts
			$retstr = sprintf( _n( 'Viewing %2$s post (of %4$s total)', 'Viewing %1$s posts - %2$s through %3$s (of %4$s total)', $count_int, 'bbpress' ), $count_num, $from_num, $to_num, $total_num );
		}
	}

	return esc_html( $retstr );
}
add_filter( 'bbp_get_topic_pagination_count', 'um_bbp_get_topic_pagination_count', 10, 1 );


/**
 * Description for forum
 *
 * @param $retstr
 * @param $r
 * @param $args
 */
function um_bbp_get_single_forum_description( $retstr, $r, $args ) {
	// Parse arguments against default values
	$r = bbp_parse_args(
		$args,
		array(
			'forum_id' => 0,
			'before'   => '<div class="bbp-template-notice info"><ul><li class="bbp-forum-description">',
			'after'    => '</li></ul></div>',
			'size'     => 14,
			'feed'     => true,
		),
		'get_single_forum_description'
	);

	// Validate forum_id
	$forum_id = bbp_get_forum_id( $r['forum_id'] );

	// Get some forum data
	$tc_int      = um_count_not_restricted_bbp_posts( $forum_id, '_bbp_forum_id', 'topic' );
	$rc_int      = um_count_not_restricted_bbp_posts( $forum_id, '_bbp_forum_id' );
	$topic_count = um_count_not_restricted_bbp_posts( $forum_id, '_bbp_forum_id', 'topic' );
	$reply_count = um_count_not_restricted_bbp_posts( $forum_id, '_bbp_forum_id' );
	$last_active = bbp_get_forum_last_active_id( $forum_id );

	if ( UM()->access()->is_restricted( $last_active ) ) {
		$last_active = 0;
	} else {
		$last_active_topic = bbp_get_reply_topic_id( $last_active );
		if ( UM()->access()->is_restricted( $last_active_topic ) ) {
			$last_active = 0;
		}
	}

	// Has replies
	if ( ! empty( $reply_count ) ) {
		// translators: %s = number of replies
		$reply_text = sprintf( _n( '%s reply', '%s replies', $rc_int, 'bbpress' ), $reply_count );
	}

	// Forum has active data
	if ( ! empty( $last_active ) ) {
		$topic_text      = $topic_count . esc_html__( ' topics', 'um-bbpress' );
		$time_since      = bbp_get_forum_freshness_link( $forum_id );
		$last_updated_by = bbp_get_author_link(
			array(
				'post_id' => $last_active,
				'size'    => $r['size'],
			)
		);

		// Forum has no last active data
	} else {
		// translators: %s = number of topics
		$topic_text = sprintf( _n( '%s topic', '%s topics', $tc_int, 'bbpress' ), $topic_count );
	}

	// Forum has active data
	if ( ! empty( $last_active ) ) {

		// Has replies
		if ( ! empty( $reply_count ) ) {
			// translators: 1: topic count, 2: reply count, 3: last active time, 4: last active author link
			$retstr = bbp_is_forum_category( $forum_id ) ? sprintf( esc_html__( 'This category has %1$s, %2$s, and was last updated %3$s by %4$s.', 'bbpress' ), $topic_text, $reply_text, $time_since, $last_updated_by ) : sprintf( esc_html__( 'This forum has %1$s, %2$s, and was last updated %3$s by %4$s.', 'bbpress' ), $topic_text, $reply_text, $time_since, $last_updated_by );

			// Only has topics
		} else {
			// translators: 1: topic count, 2: last active time, 3: last active author link
			$retstr = bbp_is_forum_category( $forum_id ) ? sprintf( esc_html__( 'This category has %1$s, and was last updated %2$s by %3$s.', 'bbpress' ), $topic_text, $time_since, $last_updated_by ) : sprintf( esc_html__( 'This forum has %1$s, and was last updated %2$s by %3$s.', 'bbpress' ), $topic_text, $time_since, $last_updated_by );
		}

		// Forum has no last active data (but does have topics & replies)
	} elseif ( ! empty( $reply_count ) ) {
		// translators: 1: topic count, 2: reply count
		$retstr = bbp_is_forum_category( $forum_id ) ? sprintf( esc_html__( 'This category has %1$s and %2$s.', 'bbpress' ), $topic_text, $reply_text ) : sprintf( esc_html__( 'This forum has %1$s and %2$s.', 'bbpress' ), $topic_text, $reply_text );

		// Forum has no last active data or replies (but does have topics)
	} elseif ( ! empty( $topic_count ) ) {
		// translators: %s = number of topics
		$retstr = bbp_is_forum_category( $forum_id ) ? sprintf( esc_html__( 'This category has %1$s.', 'bbpress' ), $topic_text ) : sprintf( esc_html__( 'This forum has %1$s.', 'bbpress' ), $topic_text );

		// Forum is empty
	} else {
		$retstr = esc_html__( 'This forum is empty.', 'bbpress' );
	}

	// Combine the elements together
	$retstr = $r['before'] . $retstr . $r['after'];

	return $retstr;
}
add_filter( 'bbp_get_single_forum_description', 'um_bbp_get_single_forum_description', 10, 3 );
