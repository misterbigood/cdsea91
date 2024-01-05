<?php // phpcs:disable WordPress.WP.I18n.MissingTranslatorsComment

/**
 * Our Custom alerts
 *
 * @package Wsal
 */

$custom_alerts = array(
	__( 'bbPress Forums', 'wsal-bbpress' ) => array(
		__( 'Forums', 'wsal-bbpress' )                => array(
			array(
				8000,
				WSAL_INFORMATIONAL,
				__( 'User created new forum', 'wsal-bbpress' ),
				__( 'Created a new forum called %ForumName%.', 'wsal-bbpress' ),
				array(),
				array( __( 'View the forum in editor', 'wsal-bbpress' ) => '%EditorLinkForum%' ),
				'bbpress-forum',
				'created',
			),
			array(
				8001,
				WSAL_MEDIUM,
				__( 'User changed status of a forum', 'wsal-bbpress' ),
				__( 'Changed the status of the forum %ForumName% to %NewStatus%.', 'wsal-bbpress' ),
				array(
					__( 'Previous status', 'wsal-bbpress' ) => '%OldStatus%',
				),
				array(
					__( 'View the forum in editor', 'wsal-bbpress' ) => '%EditorLinkForum%',
				),
				'bbpress-forum',
				'modified',
			),
			array(
				8002,
				WSAL_MEDIUM,
				__( 'User changed visibility of a forum', 'wsal-bbpress' ),
				__( 'Changed the visibility of the forum %ForumName% to %NewVisibility%.', 'wsal-bbpress' ),
				array(
					__( 'Previous visibility', 'wsal-bbpress' ) => '%OldVisibility%',
				),
				array(
					__( 'View the forum in editor', 'wsal-bbpress' ) => '%EditorLinkForum%',
				),
				'bbpress-forum',
				'modified',
			),
			array(
				8003,
				WSAL_LOW,
				__( 'User changed the URL of a forum', 'wsal-bbpress' ),
				__( 'Changed the URL of the forum %ForumName%.', 'wsal-bbpress' ),
				array(
					__( 'Previous URL', 'wsal-bbpress' ) => '%OldUrl%',
					__( 'New URL', 'wsal-bbpress' )      => '%NewUrl%',
				),
				array(
					__( 'View the forum in editor', 'wsal-bbpress' ) => '%EditorLinkForum%',
				),
				'bbpress-forum',
				'modified',
			),
			array(
				8004,
				WSAL_INFORMATIONAL,
				__( 'User changed order of a forum', 'wsal-bbpress' ),
				__( 'Changed the sorting order of the forum %ForumName% to %NewOrder%.', 'wsal-bbpress' ),
				array(
					__( 'Previous sorting order', 'wsal-bbpress' ) => '%OldOrder%',
				),
				array(
					__( 'View the forum in editor', 'wsal-bbpress' ) => '%EditorLinkForum%',
				),
				'bbpress-forum',
				'modified',
			),
			array(
				8005,
				WSAL_HIGH,
				__( 'User moved forum to trash', 'wsal-bbpress' ),
				__( 'Moved the forum %ForumName% to trash.', 'wsal-bbpress' ),
				array(),
				array(),
				'bbpress-forum',
				'deleted',
			),
			array(
				8006,
				WSAL_HIGH,
				__( 'User permanently deleted forum', 'wsal-bbpress' ),
				__( 'Permanently deleted the forum %ForumName%.', 'wsal-bbpress' ),
				array(),
				array(),
				'bbpress-forum',
				'deleted',
			),
			array(
				8007,
				WSAL_HIGH,
				__( 'User restored forum from trash', 'wsal-bbpress' ),
				__( 'Restored the forum %ForumName% from trash.', 'wsal-bbpress' ),
				array(),
				array(),
				'bbpress-forum',
				'restored',
			),
			array(
				8008,
				WSAL_LOW,
				__( 'User changed the parent of a forum', 'wsal-bbpress' ),
				__( 'Changed the parent of the forum %ForumName% to %NewParent%.', 'wsal-bbpress' ),
				array(
					__( 'Previous parent', 'wsal-bbpress' ) => '%OldParent%',
				),
				array(
					__( 'View the forum in editor', 'wsal-bbpress' ) => '%EditorLinkForum%',
				),
				'bbpress-forum',
				'modified',
			),
			array(
				8011,
				WSAL_LOW,
				__( 'User changed type of a forum', 'wsal-bbpress' ),
				__( 'Changed the type of the forum %ForumName% to %NewType%.', 'wsal-bbpress' ),
				array(
					__( 'Previous type', 'wsal-bbpress' ) => '%OldType%',
				),
				array(
					__( 'View the forum in editor', 'wsal-bbpress' ) => '%EditorLinkForum%',
				),
				'bbpress-forum',
				'modified',
			),
		),

		__( 'bbPress Forum Topics', 'wsal-bbpress' )  => array(
			array(
				8014,
				WSAL_INFORMATIONAL,
				__( 'User created new topic', 'wsal-bbpress' ),
				__( 'Created a new topic called %TopicName%.', 'wsal-bbpress' ),
				array(),
				array(
					__( 'View the topic in editor', 'wsal-bbpress' ) => '%EditorLinkTopic%',
				),
				'bbpress-forum',
				'created',
			),
			array(
				8015,
				WSAL_INFORMATIONAL,
				__( 'User changed status of a topic', 'wsal-bbpress' ),
				__( 'Changed the status of the topic %TopicName% to %NewStatus%.', 'wsal-bbpress' ),
				array(
					__( 'Previous status', 'wsal-bbpress' ) => '%OldStatus%',
				),
				array(
					__( 'View the topic in editor', 'wsal-bbpress' ) => '%EditorLinkTopic%',
				),
				'bbpress-forum',
				'modified',
			),
			array(
				8016,
				WSAL_INFORMATIONAL,
				__( 'User changed type of a topic', 'wsal-bbpress' ),
				__( 'Changed the type of the topic %TopicName% to %NewType%.', 'wsal-bbpress' ),
				array(
					__( 'Previous type', 'wsal-bbpress' ) => '%OldType%',
				),
				array(
					__( 'View the topic in editor', 'wsal-bbpress' ) => '%EditorLinkTopic%',
				),
				'bbpress-forum',
				'modified',
			),
			array(
				8017,
				WSAL_INFORMATIONAL,
				__( 'User changed URL of a topic', 'wsal-bbpress' ),
				__( 'Changed the URL of the topic %TopicName%.', 'wsal-bbpress' ),
				array(
					__( 'Previous URL', 'wsal-bbpress' ) => '%OldUrl%',
					__( 'New URL', 'wsal-bbpress' )      => '%NewUrl%',
				),
				array(
					__( 'View the topic in editor', 'wsal-bbpress' ) => '%EditorLinkTopic%',
				),
				'bbpress-forum',
				'modified',
			),
			array(
				8018,
				WSAL_INFORMATIONAL,
				__( 'User changed the forum of a topic', 'wsal-bbpress' ),
				__( 'Changed the forum of the topic %TopicName% to %NewForum%.', 'wsal-bbpress' ),
				array(
					__( 'Previous forum', 'wsal-bbpress' ) => '%OldForum%',
				),
				array(
					__( 'View the topic in editor', 'wsal-bbpress' ) => '%EditorLinkTopic%',
				),
				'bbpress-forum',
				'modified',
			),
			array(
				8019,
				WSAL_MEDIUM,
				__( 'User moved topic to trash', 'wsal-bbpress' ),
				__( 'Moved the %TopicName% to trash.', 'wsal-bbpress' ),
				array(),
				array(),
				'bbpress-forum',
				'deleted',
			),
			array(
				8020,
				WSAL_MEDIUM,
				__( 'User permanently deleted topic', 'wsal-bbpress' ),
				__( 'Permanently deleted the topic %TopicName%.', 'wsal-bbpress' ),
				array(),
				array(),
				'bbpress-forum',
				'deleted',
			),
			array(
				8021,
				WSAL_INFORMATIONAL,
				__( 'User restored topic from trash', 'wsal-bbpress' ),
				__( 'Restored the topic %TopicName% from trash.', 'wsal-bbpress' ),
				array(),
				array(),
				'bbpress-forum',
				'restored',
			),
			array(
				8022,
				WSAL_LOW,
				__( 'User changed visibility of a topic', 'wsal-bbpress' ),
				__( 'Changed the visibility of the topic %TopicName% to %NewVisibility%.', 'wsal-bbpress' ),
				array(
					__( 'Previous visibility', 'wsal-bbpress' ) => '%OldVisibility%',
				),
				array(
					__( 'View the topic in editor', 'wsal-bbpress' ) => '%EditorLinkTopic%',
				),
				'bbpress-forum',
				'modified',
			),
			array(
				8024,
				WSAL_LOW,
				__( 'User created a topic tag', 'wsal-bbpress' ),
				__( 'Created the topic tag %TagName%.', 'wsal-bbpress' ),
				array(
					__( 'Slug', 'wsal-bbpress' ) => '%slug%',
				),
				array(
					__( 'View the tag in editor', 'wsal-bbpress' ) => '%EditorLinkTag%',
				),
				'bbpress-forum',
				'created',
			),
			array(
				8025,
				WSAL_LOW,
				__( 'User deleted a topic tag', 'wsal-bbpress' ),
				__( 'Deleted the topic tag %TagName%.', 'wsal-bbpress' ),
				array(
					__( 'Slug', 'wsal-bbpress' ) => '%slug%',
				),
				array(),
				'bbpress-forum',
				'deleted',
			),
			array(
				8026,
				WSAL_LOW,
				__( 'User renamed a topic tag', 'wsal-bbpress' ),
				__( 'Renamed the topic tag %OldName% to %NewName%.', 'wsal-bbpress' ),
				array(
					__( 'Slug', 'wsal-bbpress' ) => '%slug%',
				),
				array(
					__( 'View the tag in editor', 'wsal-bbpress' ) => '%EditorLinkTag%',
				),
				'bbpress-forum',
				'renamed',
			),
			array(
				8027,
				WSAL_LOW,
				__( 'User changed a topic tag slug', 'wsal-bbpress' ),
				__( 'Changed the slug of the topic tag %TagName% to %NewSlug%.', 'wsal-bbpress' ),
				array(
					__( 'Previous slug', 'wsal-bbpress' ) => '%slug%',
				),
				array(
					__( 'View the tag in editor', 'wsal-bbpress' ) => '%EditorLinkTag%',
				),
				'bbpress-forum',
				'renamed',
			),
		),

		__( 'bbPress Settings', 'wsal-bbpress' )      => array(
			array(
				8009,
				WSAL_HIGH,
				__( 'User changed forum\'s role', 'wsal-bbpress' ),
				__( 'Changed the bbPress setting <strong>Automatically give registered users a forum role</strong> to %NewRole%.', 'wsal-bbpress' ),
				array(
					__( 'Previous role', 'wsal-bbpress' ) => '%OldRole%',
				),
				array(),
				'bbpress',
				'modified',
			),
			array(
				8010,
				WSAL_CRITICAL,
				__( 'User changed option of a forum', 'wsal-bbpress' ),
				__( 'Changed the bbPress setting <strong>Anonymous</strong> (allow guest users to post on the forums).', 'wsal-bbpress' ),
				array(),
				array(),
				'bbpress',
				'enabled',
			),
			array(
				8012,
				WSAL_MEDIUM,
				__( 'User changed time to disallow post editing', 'wsal-bbpress' ),
				__( 'Changed the time of the bbPress setting <strong>Editing</strong> (to allow users to edit their content after posting) to %NewTime%,', 'wsal-bbpress' ),
				array(
					__( 'Previous time', 'wsal-bbpress' ) => '%OldTime%',
				),
				array(),
				'bbpress',
				'modified',
			),
			array(
				8013,
				WSAL_HIGH,
				__( 'User changed the forum setting posting throttle time', 'wsal-bbpress' ),
				__( 'Changed the time of the bbPress setting <strong>Flooding</strong> (throttling users setting) to %NewTime%.', 'wsal-bbpress' ),
				array(
					__( 'Previous time', 'wsal-bbpress' ) => '%OldTime%',
				),
				array(),
				'bbpress',
				'modified',
			),
		),

		__( 'bbPress User Profiles', 'wsal-bbpress' ) => array(
			array(
				8023,
				WSAL_LOW,
				__( 'The forum role of a user was changed by another WordPress user', 'wsal-bbpress' ),
				__( 'Changed the role of user %TargetUsername% to %NewRole%.', 'wsal-bbpress' ),
				array(
					__( 'Previous role', 'wsal-bbpress' ) => '%OldRole%',
					__( 'First name', 'wsal-bbpress' )    => '%FirstName%',
				),
				array(
					__( 'User profile page', 'wsal-bbpress' ) => '%EditUserLink%',
				),
				'user',
				'modified',
			),
		),
	),
);
