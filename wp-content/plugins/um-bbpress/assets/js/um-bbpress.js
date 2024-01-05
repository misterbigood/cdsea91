jQuery(document).ready(function() {
	jQuery('.um-remove-favorite').on('click', function(e) {
		var obj = jQuery(this);
		var topic_id = jQuery(this).data('topic');
		var user_id = jQuery(this).data('user_id');
		var count = jQuery('.um-profile-favorites').html();
		var parent = jQuery(this).closest('.um-item');
		wp.ajax.send( 'um_bbpress_remove_topic_favorite', {
			data: {
				topic: topic_id,
				user_id: user_id,
				nonce: um_scripts.nonce
			},
			success: function( response ) {
				if( 'success' === response ) {
					obj.tipsy('hide');
					parent.remove();
					jQuery('.um-profile-favorites').html(count - 1);
				}
			},
			error: function( data ) {
				console.log( data );
			}
		});
	});

	jQuery('.um-remove-subscription').on('click', function(e) {
		var obj = jQuery(this);
		var argument = jQuery(this).data('argument');
		var user_id = jQuery(this).data('user_id');
		var count = jQuery('.um-profile-subscriptions').html();
		var parent = jQuery(this).closest('.um-item');
		var type = jQuery(this).data('bbpress-type');
		var all = jQuery('.bbp-subscription option:nth-child(1)').html();
		var topic = jQuery('.bbp-subscription option:nth-child(2)').html();
		var subscription = jQuery('.bbp-subscription option:nth-child(3)').html();

		var count_all = all.match(/\((\d+)\)/)[1];
		var count_topic = topic.match(/\((\d+)\)/)[1];
		var count_subscription = subscription.match(/\((\d+)\)/)[1];

		wp.ajax.send( 'um_bbpress_remove_subscription', {
			data: {
				argument: argument,
				user_id: user_id,
				nonce: um_scripts.nonce
			},
			success: function( response ) {
				if( 'success' === response ) {
					obj.tipsy('hide');
					parent.remove();
					jQuery('.um-profile-subscriptions').html(count - 1);
					var new_count_all = parseInt(count_all) - 1;

					jQuery('.bbp-subscription option:nth-child(1)').html( all.replace(/\(\d+\)/, '(' + new_count_all + ')' ) );
					if( 'topic'	=== type ) {
						var new_count_topic = parseInt(count_topic) - 1;
						jQuery('.bbp-subscription option:nth-child(2)').html( topic.replace(/\(\d+\)/, '(' + new_count_topic + ')' ) );
					} else {
						var new_count_subscription = parseInt(count_subscription) - 1;
						jQuery('.bbp-subscription option:nth-child(3)').html( subscription.replace(/\(\d+\)/, '(' + new_count_subscription + ')' ) );
					}
				}
			},
			error: function( data ) {
				console.log( data );
			}
		});
	});
});
