<?php
/**
 * Echo comments fragments.
 *
 * @package Fragments\Comments
 */

yourfitness_add_smart_action( 'yourfitness_comments_list_before_markup', 'yourfitness_comments_title' );

/**
 * Echo the comments title.
 *
 * @since 1.0.0
 */
function yourfitness_comments_title() {

	echo yourfitness_open_markup( 'yourfitness_comments_title', 'h2' );

		echo yourfitness_output( 'yourfitness_comments_title_text', sprintf(
			esc_html(_n( '%s Comment', '%s Comments', get_comments_number(), 'your-fitness' )),
			number_format_i18n( get_comments_number() )
		) );

	echo yourfitness_close_markup( 'yourfitness_comments_title', 'h2' );

}


yourfitness_add_smart_action( 'yourfitness_comment_header', 'yourfitness_comment_avatar', 5 );

/**
 * Echo the comment avatar.
 *
 * @since 1.0.0
 */
function yourfitness_comment_avatar() {

	global $comment;

	// Stop here if no avatar.
	if ( !$avatar = get_avatar( $comment, $comment->args['avatar_size'] ) )
		return;

	echo yourfitness_open_markup( 'yourfitness_comment_avatar', 'div', array( 'class' => 'uk-comment-avatar' ) );

		echo  $avatar;

	echo yourfitness_close_markup( 'yourfitness_comment_avatar', 'div' );

}


yourfitness_add_smart_action( 'yourfitness_comment_header', 'yourfitness_comment_author' );

/**
 * Echo the comment author title.
 *
 * @since 1.0.0
 */
function yourfitness_comment_author() {

	echo yourfitness_open_markup( 'yourfitness_comment_title', 'div', array(
		'class' => 'uk-comment-title'
	) );

		echo get_comment_author_link();

	echo yourfitness_close_markup( 'yourfitness_comment_title', 'div' );

}


yourfitness_add_smart_action( 'yourfitness_comment_title_append_markup', 'yourfitness_comment_badges' );

/**
 * Echo the comment badges.
 *
 * @since 1.0.0
 */
function yourfitness_comment_badges() {

	global $comment;

	// Trackback badge.
	if ( $comment->comment_type == 'trackback' ) {

		echo yourfitness_open_markup( 'yourfitness_trackback_badge', 'span', array( 'class' => 'uk-badge uk-margin-small-left' ) );

			echo yourfitness_output( 'yourfitness_trackback_text', esc_html__( 'Trackback', 'your-fitness' ) );

		echo yourfitness_close_markup( 'yourfitness_trackback_badge', 'span' );

	}

	// Pindback badge.
	if ( $comment->comment_type == 'pingback' ) {

		echo yourfitness_open_markup( 'yourfitness_pingback_badge', 'span', array( 'class' => 'uk-badge uk-margin-small-left' ) );

			echo yourfitness_output( 'yourfitness_pingback_text', esc_html__( 'Pingback', 'your-fitness' ) );

		echo yourfitness_close_markup( 'yourfitness_pingback_badge', 'span' );


	}

	// Moderation badge.
	if ( '0' == $comment->comment_approved ) {

		echo yourfitness_open_markup( 'yourfitness_moderation_badge', 'span', array( 'class' => 'uk-badge uk-margin-small-left uk-badge-warning' ) );

			echo yourfitness_output( 'yourfitness_moderation_text', esc_html__( 'Awaiting Moderation', 'your-fitness' ) );

		echo yourfitness_close_markup( 'yourfitness_moderation_badge', 'span' );


	}

	// Moderator badge.
	if ( user_can( $comment->user_id, 'moderate_comments' ) ) {

		echo yourfitness_open_markup( 'yourfitness_moderator_badge', 'span', array( 'class' => 'uk-badge uk-margin-small-left' ) );

			echo yourfitness_output( 'yourfitness_moderator_text', esc_html__( 'Moderator', 'your-fitness' ) );

		echo yourfitness_close_markup( 'yourfitness_moderator_badge', 'span' );


	}

}


yourfitness_add_smart_action( 'yourfitness_comment_header', 'yourfitness_comment_metadata', 15 );

/**
 * Echo the comment metadata.
 *
 * @since 1.0.0
 */
function yourfitness_comment_metadata() {

	echo yourfitness_open_markup( 'yourfitness_comment_meta', 'div', array( 'class' => 'uk-comment-meta' ) );

		echo yourfitness_open_markup( 'yourfitness_comment_time', 'time', array(
			'datetime' => get_comment_time( 'c' )
		) );

			echo yourfitness_output( 'yourfitness_comment_time_text', sprintf(
				esc_attr_x( '%1$s at %2$s', '1: date, 2: time', 'your-fitness' ),
				get_comment_date(),
				get_comment_time()
			) );

		echo yourfitness_close_markup( 'yourfitness_comment_time', 'time' );

	echo yourfitness_close_markup( 'yourfitness_comment_meta', 'div' );

}


yourfitness_add_smart_action( 'yourfitness_comment_content', 'yourfitness_comment_content' );

/**
 * Echo the comment content.
 *
 * @since 1.0.0
 */
function yourfitness_comment_content() {

	echo yourfitness_output( 'yourfitness_comment_content', yourfitness_render_function( comment_text() ) );

}


yourfitness_add_smart_action( 'yourfitness_comment_content', 'yourfitness_comment_links', 15 );

/**
 * Echo the comment links.
 *
 * @since 1.0.0
 */
function yourfitness_comment_links() {

	global $comment;

	echo yourfitness_open_markup( 'yourfitness_comment_links', 'ul', array( 'class' => 'tm-comment-links uk-subnav uk-subnav-line' ) );

		// Reply.
		echo get_comment_reply_link( array_merge( $comment->args, array(
			'add_below' => 'comment-content',
			'depth' => $comment->depth,
			'max_depth' => $comment->args['max_depth'],
			'before' => yourfitness_open_markup( 'yourfitness_comment_item[_reply]', 'li' ),
			'after' => yourfitness_close_markup( 'yourfitness_comment_item[_reply]', 'li' )
		) ) );

		// Edit.
		if ( current_user_can( 'moderate_comments' ) ) :

			echo yourfitness_open_markup( 'yourfitness_comment_item[_edit]', 'li' );

				echo yourfitness_open_markup( 'yourfitness_comment_item_link[_edit]', 'a', array(
					'href' => get_edit_comment_link( $comment->comment_ID ) // Automatically escaped.
				) );

					echo yourfitness_output( 'yourfitness_comment_edit_text', esc_html__( 'Edit', 'your-fitness' ) );

				echo yourfitness_close_markup( 'yourfitness_comment_item_link[_edit]', 'a' );

			echo yourfitness_close_markup( 'yourfitness_comment_item[_edit]', 'li' );

		endif;

		// Link.
		echo yourfitness_open_markup( 'yourfitness_comment_item[_link]', 'li' );

			echo yourfitness_open_markup( 'yourfitness_comment_item_link[_link]', 'a', array(
				'href' => get_comment_link( $comment->comment_ID ) // Automatically escaped.
			) );

				echo yourfitness_output( 'yourfitness_comment_link_text', esc_html__( 'Link', 'your-fitness' ) );

			echo yourfitness_close_markup( 'yourfitness_comment_item_link[_link]', 'a' );

		echo yourfitness_close_markup( 'yourfitness_comment_item[_link]', 'li' );

	echo yourfitness_close_markup( 'yourfitness_comment_links', 'ul' );

}


yourfitness_add_smart_action( 'yourfitness_no_comment', 'yourfitness_no_comment' );

/**
 * Echo no comment content.
 *
 * @since 1.0.0
 */
function yourfitness_no_comment() {

	echo yourfitness_open_markup( 'yourfitness_no_comment', 'p', 'class=uk-text-muted' );

		echo yourfitness_output( 'yourfitness_no_comment_text', esc_html__( 'No comment yet, add your voice below!', 'your-fitness' ) );

	echo yourfitness_close_markup( 'yourfitness_no_comment', 'p' );

}


yourfitness_add_smart_action( 'yourfitness_comments_closed', 'yourfitness_comments_closed' );

/**
 * Echo closed comments content.
 *
 * @since 1.0.0
 */
function yourfitness_comments_closed() {

	echo yourfitness_open_markup( 'yourfitness_comments_closed', 'p', array( 'class' => 'uk-alert uk-alert-warning uk-margin-bottom-remove' ) );

		echo yourfitness_output( 'yourfitness_comments_closed_text', esc_html__( 'Comments are closed for this article!', 'your-fitness' ) );

	echo yourfitness_close_markup( 'yourfitness_comments_closed', 'p' );

}


yourfitness_add_smart_action( 'yourfitness_comments_list_after_markup', 'yourfitness_comments_navigation' );

/**
 * Echo comments navigation.
 *
 * @since 1.0.0
 */
function yourfitness_comments_navigation() {

	if ( get_comment_pages_count() <= 1 && !get_option( 'page_comments' ) )
		return;

	echo yourfitness_open_markup( 'yourfitness_comments_navigation', 'ul', array(
		'class' => 'uk-pagination'
	) );

		// Previous.
		if ( get_previous_comments_link() ) {

			echo yourfitness_open_markup( 'yourfitness_comments_navigation_item[_previous]', 'li', array( 'class' => 'uk-pagination-previous' ) );

				$previous_icon = yourfitness_open_markup( 'yourfitness_previous_icon[_comments_navigation]', 'i', array(
					'class' => 'uk-icon-angle-double-left uk-margin-small-right'
				) );
				$previous_icon .= yourfitness_close_markup( 'yourfitness_previous_icon[_comments_navigation]', 'i' );

				echo get_previous_comments_link(
					$previous_icon . yourfitness_output( 'yourfitness_previous_text[_comments_navigation]', esc_html__( 'Previous', 'your-fitness' ) )
				);

			echo yourfitness_close_markup( 'yourfitness_comments_navigation_item[_previous]', 'li' );

		}

		// Next.
		if ( get_next_comments_link() ) {

			echo yourfitness_open_markup( 'yourfitness_comments_navigation_item[_next]', 'li', array( 'class' => 'uk-pagination-next' ) );

				$next_icon = yourfitness_open_markup( 'yourfitness_next_icon[_comments_navigation]', 'i', array(
					'class' => 'uk-icon-angle-double-right uk-margin-small-right'
				) );
				$next_icon .= yourfitness_close_markup( 'yourfitness_previous_icon[_comments_navigation]', 'i' );

				echo get_next_comments_link(
					yourfitness_output( 'yourfitness_next_text[_comments_navigation]', esc_html__( 'Next', 'your-fitness' ) ) . $next_icon
				);

			echo yourfitness_close_markup( 'yourfitness_comments_navigation_item_[_next]', 'li' );

		}

	echo yourfitness_close_markup( 'yourfitness_comments_navigation', 'ul' );

}


yourfitness_add_smart_action( 'yourfitness_after_open_comments', 'yourfitness_comment_form_divider' );

/**
 * Echo comment divider.
 *
 * @since 1.0.0
 */
function yourfitness_comment_form_divider() {

	echo yourfitness_selfclose_markup( 'yourfitness_comment_form_divider', 'hr', array( 'class' => 'uk-article-divider' ) );

}


yourfitness_add_smart_action( 'yourfitness_after_open_comments', 'yourfitness_comment_form' );

/**
 * Echo comment navigation.
 *
 * @since 1.0.0
 */
function yourfitness_comment_form() {

	$output = yourfitness_open_markup( 'yourfitness_comment_form_wrap', 'div', array( 'class' => 'uk-form tm-comment-form-wrap' ) );

		$output .= yourfitness_render_function( 'comment_form', array(
			'title_reply' => yourfitness_output( 'yourfitness_comment_form_title_text', esc_html__( 'Add a Comment', 'your-fitness' ) )
		) );

	$output .= yourfitness_close_markup( 'yourfitness_comment_form_wrap', 'div' );

	$submit = yourfitness_open_markup( 'yourfitness_comment_form_submit', 'button', array( 'class' => 'uk-button uk-button-primary', 'type' => 'submit' ) );

		$submit .= yourfitness_output( 'yourfitness_comment_form_submit_text', esc_html__( 'Post Comment', 'your-fitness' ) );

	$submit .= yourfitness_close_markup( 'yourfitness_comment_form_submit', 'button' );

	// WordPress, please make it easier for us.
	echo preg_replace( '#<input[^>]+type="submit"[^>]+>#', $submit, $output );

}


// Filter.
yourfitness_add_smart_action( 'cancel_comment_reply_link', 'yourfitness_comment_cancel_reply_link', 10 , 3 );

/**
 * Echo comment cancel reply link.
 *
 * This function replaces the default WordPress comment cancel reply link.
 *
 * @since 1.0.0
 */
function yourfitness_comment_cancel_reply_link( $html, $link, $text ) {

	echo yourfitness_open_markup( 'yourfitness_comment_cancel_reply_link', 'a', array(
		'rel' => 'nofollow',
		'id' => 'cancel-comment-reply-link',
		'class' => 'uk-button uk-button-small uk-button-danger uk-margin-small-right',
		'style' => isset( $_GET['replytocom'] ) ? '' : 'display:none;',
		'href' => $link // Automatically escaped.
	) );

		echo yourfitness_output( 'yourfitness_comment_cancel_reply_link_text', $text );

	echo yourfitness_close_markup( 'yourfitness_comment_cancel_reply_link', 'a' );

}


// Filter.
yourfitness_add_smart_action( 'comment_form_field_comment', 'yourfitness_comment_form_comment' );

/**
 * Echo comment textarea field.
 *
 * This function replaces the default WordPress comment textarea field.
 *
 * @since 1.0.0
 */
function yourfitness_comment_form_comment() {

	$output = yourfitness_open_markup( 'yourfitness_comment_form[_comment]', 'p', array( 'class' => 'uk-margin-top' ) );

		/**
		 * Filter whether the comment form textarea legend should load or not.
		 *
		 * @since 1.0.0
		 */
		if ( yourfitness_apply_filters( 'yourfitness_comment_form_legend[_comment]', true ) ) {

			$output .= yourfitness_open_markup( 'yourfitness_comment_form_legend[_comment]', 'legend' );

				$output .= yourfitness_output( 'yourfitness_comment_form_legend_text[_comment]', esc_html__( 'Comment *', 'your-fitness' ) );

			$output .= yourfitness_close_markup( 'yourfitness_comment_form_legend[_comment]', 'legend' );

		}

		$output .= yourfitness_open_markup( 'yourfitness_comment_form_field[_comment]', 'textarea', array(
			'id' => 'comment',
			'class' => 'uk-width-1-1',
			'name' => 'comment',
			'required' => '',
			'rows' => 8,
		) );

		$output .= yourfitness_close_markup( 'yourfitness_comment_form_field[_comment]', 'textarea' );

	$output .= yourfitness_close_markup( 'yourfitness_comment_form[_comment]', 'p' );

	return $output;

}


yourfitness_add_smart_action( 'comment_form_before_fields', 'yourfitness_comment_before_fields', 9999 );

/**
 * Echo comment fields opening wraps.
 *
 * This function must be attached to the WordPress 'comment_form_before_fields' action which is only called if
 * the user is not logged in.
 *
 * @since 1.0.0
 */
function yourfitness_comment_before_fields() {

	echo yourfitness_open_markup( 'yourfitness_comment_fields_wrap', 'div', array( 'class' => 'uk-width-medium-1-1' ) );

		echo yourfitness_open_markup( 'yourfitness_comment_fields_inner_wrap', 'div', array(
			'class' => 'uk-grid uk-grid-small',
			'data-uk-grid-margin' => ''
		) );

}


// Filter.
yourfitness_add_smart_action( 'comment_form_default_fields', 'yourfitness_comment_form_fields' );

/**
 * Modify comment form fields.
 *
 * This function replaces the default WordPress comment fields.
 *
 * @since 1.0.0
 *
 * @param array $fields The WordPress default fields.
 *
 * @return array The modified fields.
 */
function yourfitness_comment_form_fields( $fields ) {

	$commenter = wp_get_current_commenter();
	$grid = count( (array) $fields );

	// Author.
	if ( isset( $fields['author'] ) ) {

		$author = yourfitness_open_markup( 'yourfitness_comment_form[_name]', 'div', array( 'class' => "uk-width-medium-1-$grid" ) );

			/**
			 * Filter whether the comment form name legend should load or not.
			 *
			 * @since 1.0.0
			 */
			if ( yourfitness_apply_filters( 'yourfitness_comment_form_legend[_name]', true ) ) {

				$author .= yourfitness_open_markup( 'yourfitness_comment_form_legend[_name]', 'legend' );

					$author .= yourfitness_output( 'yourfitness_comment_form_legend_text[_name]', esc_html__( 'Name', 'your-fitness' ) );

				$author .= yourfitness_close_markup( 'yourfitness_comment_form_legend[_name]', 'legend' );

			}

			$author .= yourfitness_selfclose_markup( 'yourfitness_comment_form_field[_name]', 'input', array(
				'id' => 'author',
				'class' => 'uk-width-1-1',
				'type' => 'text',
				'value' => $commenter['comment_author'], // Automatically escaped.
				'name' => 'author'
			) );

		$author .= yourfitness_close_markup( 'yourfitness_comment_form[_name]', 'div' );

		$fields['author'] = $author;

	}

	// Email.
	if ( isset( $fields['email'] ) ) {

		$email = yourfitness_open_markup( 'yourfitness_comment_form[_email]', 'div', array( 'class' => "uk-width-medium-1-$grid" ) );

			/**
			 * Filter whether the comment form email legend should load or not.
			 *
			 * @since 1.0.0
			 */
			if ( yourfitness_apply_filters( 'yourfitness_comment_form_legend[_email]', true ) ) {

				$email .= yourfitness_open_markup( 'yourfitness_comment_form_legend[_email]', 'legend' );

					$email .= yourfitness_output( 'yourfitness_comment_form_legend_text[_email]', sprintf( esc_html__( 'Email %s', 'your-fitness' ), ( get_option( 'require_name_email' ) ? ' *' : '' ) ) );

				$email .= yourfitness_close_markup( 'yourfitness_comment_form_legend[_email]', 'legend' );

			}

			$email .= yourfitness_selfclose_markup( 'yourfitness_comment_form_field[_email]', 'input', array(
				'id' => 'email',
				'class' => 'uk-width-1-1',
				'type' => 'text',
				'value' => $commenter['comment_author_email'], // Automatically escaped.
				'name' => 'email',
				'required' => get_option( 'require_name_email' ) ? '' : null
			) );

		$email .= yourfitness_close_markup( 'yourfitness_comment_form[_email]', 'div' );

		$fields['email'] = $email;

	}

	// Url.
	if ( isset( $fields['url'] ) ) {

		$url = yourfitness_open_markup( 'yourfitness_comment_form[_website]', 'div', array( 'class' => "uk-width-medium-1-$grid" ) );

			/**
			 * Filter whether the comment form url legend should load or not.
			 *
			 * @since 1.0.0
			 */
			if ( yourfitness_apply_filters( 'yourfitness_comment_form_legend[_url]', true ) ) {

				$url .= yourfitness_open_markup( 'yourfitness_comment_form_legend', 'legend' );

					$url .= yourfitness_output( 'yourfitness_comment_form_legend_text[_url]', esc_html__( 'Website', 'your-fitness' ) );

				$url .= yourfitness_close_markup( 'yourfitness_comment_form_legend[_url]', 'legend' );

			}

			$url .= yourfitness_selfclose_markup( 'yourfitness_comment_form_field[_url]', 'input', array(
				'id' => 'url',
				'class' => 'uk-width-1-1',
				'type' => 'text',
				'value' => $commenter['comment_author_url'], // Automatically escaped.
				'name' => 'url'
			) );

		$url .= yourfitness_close_markup( 'yourfitness_comment_form[_website]', 'div' );

		$fields['url'] = $url;

	}

	return $fields;
}


yourfitness_add_smart_action( 'comment_form_after_fields', 'yourfitness_comment_form_after_fields', 3 );

/**
 * Echo comment fields closing wraps.
 *
 * This function must be attached to the WordPress 'comment_form_after_fields' action which is only called if
 * the user is not logged in.
 *
 * @since 1.0.0
 */
function yourfitness_comment_form_after_fields() {

		echo yourfitness_close_markup( 'yourfitness_comment_fields_inner_wrap', 'div' );

	echo yourfitness_close_markup( 'yourfitness_comment_fields_wrap', 'div' );

}