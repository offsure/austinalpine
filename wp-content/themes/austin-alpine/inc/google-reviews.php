<?php
/**
 * Google reviews integration for the homepage.
 */

if ( ! function_exists( 'alpine_register_review_post_type' ) ) {
	function alpine_register_review_post_type() {
		register_post_type(
			'alpine_review',
			array(
				'labels' => array(
					'name'          => __( 'Reviews', 'austin-alpine' ),
					'singular_name' => __( 'Review', 'austin-alpine' ),
					'add_new_item'  => __( 'Add New Review', 'austin-alpine' ),
					'edit_item'     => __( 'Edit Review', 'austin-alpine' ),
				),
				'public'             => false,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'menu_position'      => 25,
				'menu_icon'          => 'dashicons-star-filled',
				'supports'           => array( 'title', 'editor', 'page-attributes' ),
				'has_archive'        => false,
				'publicly_queryable' => false,
				'show_in_rest'       => false,
			)
		);
	}
}
add_action( 'init', 'alpine_register_review_post_type', 15 );

if ( ! function_exists( 'alpine_add_review_meta_boxes' ) ) {
	function alpine_add_review_meta_boxes() {
		add_meta_box(
			'alpine-review-details',
			__( 'Review Details', 'austin-alpine' ),
			'alpine_render_review_meta_box',
			'alpine_review',
			'normal',
			'high'
		);
	}
}
add_action( 'add_meta_boxes', 'alpine_add_review_meta_boxes' );

if ( ! function_exists( 'alpine_render_review_meta_box' ) ) {
	function alpine_render_review_meta_box( $post ) {
		wp_nonce_field( 'alpine_save_review_meta', 'alpine_review_meta_nonce' );

		$reviewer_name = get_post_meta( $post->ID, '_alpine_reviewer_name', true );
		$rating = get_post_meta( $post->ID, '_alpine_review_rating', true );
		$location = get_post_meta( $post->ID, '_alpine_review_location', true );
		$review_url = get_post_meta( $post->ID, '_alpine_review_url', true );
		?>
		<table class="form-table" role="presentation">
			<tbody>
				<tr>
					<th scope="row"><label for="alpine-reviewer-name"><?php esc_html_e( 'Reviewer name', 'austin-alpine' ); ?></label></th>
					<td><input type="text" class="regular-text" id="alpine-reviewer-name" name="alpine_reviewer_name" value="<?php echo esc_attr( $reviewer_name ); ?>" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="alpine-review-rating"><?php esc_html_e( 'Rating', 'austin-alpine' ); ?></label></th>
					<td>
						<select id="alpine-review-rating" name="alpine_review_rating">
							<?php for ( $i = 5; $i >= 1; $i-- ) : ?>
								<option value="<?php echo esc_attr( $i ); ?>" <?php selected( (string) $rating, (string) $i ); ?>><?php echo esc_html( $i . ' Star' . ( 1 === $i ? '' : 's' ) ); ?></option>
							<?php endfor; ?>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="alpine-review-location"><?php esc_html_e( 'Date / location text', 'austin-alpine' ); ?></label></th>
					<td>
						<input type="text" class="regular-text" id="alpine-review-location" name="alpine_review_location" value="<?php echo esc_attr( $location ); ?>" />
						<p class="description"><?php esc_html_e( 'Example: "2 months ago" or "Austin, TX".', 'austin-alpine' ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="alpine-review-url"><?php esc_html_e( 'Review URL', 'austin-alpine' ); ?></label></th>
					<td>
						<input type="url" class="regular-text code" id="alpine-review-url" name="alpine_review_url" value="<?php echo esc_attr( $review_url ); ?>" />
						<p class="description"><?php esc_html_e( 'Optional Google review link for the "View Review" button.', 'austin-alpine' ); ?></p>
					</td>
				</tr>
			</tbody>
		</table>
		<p class="description"><?php esc_html_e( 'Use the title or reviewer name field for quick identification. Put the full review text in the main content editor.', 'austin-alpine' ); ?></p>
		<?php
	}
}

if ( ! function_exists( 'alpine_save_review_meta' ) ) {
	function alpine_save_review_meta( $post_id ) {
		if ( ! isset( $_POST['alpine_review_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['alpine_review_meta_nonce'] ) ), 'alpine_save_review_meta' ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( 'alpine_review' !== get_post_type( $post_id ) || ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		update_post_meta( $post_id, '_alpine_reviewer_name', isset( $_POST['alpine_reviewer_name'] ) ? sanitize_text_field( wp_unslash( $_POST['alpine_reviewer_name'] ) ) : '' );
		update_post_meta( $post_id, '_alpine_review_rating', isset( $_POST['alpine_review_rating'] ) ? max( 1, min( 5, (int) $_POST['alpine_review_rating'] ) ) : 5 );
		update_post_meta( $post_id, '_alpine_review_location', isset( $_POST['alpine_review_location'] ) ? sanitize_text_field( wp_unslash( $_POST['alpine_review_location'] ) ) : '' );
		update_post_meta( $post_id, '_alpine_review_url', isset( $_POST['alpine_review_url'] ) ? esc_url_raw( wp_unslash( $_POST['alpine_review_url'] ) ) : '' );
	}
}
add_action( 'save_post', 'alpine_save_review_meta' );

if ( ! function_exists( 'alpine_get_local_reviews' ) ) {
	function alpine_get_local_reviews( $limit = 30 ) {
		$query = new WP_Query(
			array(
				'post_type'              => 'alpine_review',
				'post_status'            => 'publish',
				'posts_per_page'         => max( 1, (int) $limit ),
				'orderby'                => array(
					'menu_order' => 'ASC',
					'date'       => 'DESC',
				),
				'ignore_sticky_posts'    => true,
				'no_found_rows'          => true,
				'update_post_meta_cache' => true,
				'update_post_term_cache' => false,
			)
		);

		$reviews = array();

		foreach ( $query->posts as $post ) {
			$quote = trim( wp_strip_all_tags( $post->post_content ) );

			if ( '' === $quote ) {
				continue;
			}

			$reviews[] = array(
				'quote'      => alpine_trim_google_review_text( $quote, 220 ),
				'full_quote' => $quote,
				'name'       => (string) get_post_meta( $post->ID, '_alpine_reviewer_name', true ) ?: $post->post_title,
				'role'       => '',
				'location'   => (string) get_post_meta( $post->ID, '_alpine_review_location', true ),
				'rating'     => (int) get_post_meta( $post->ID, '_alpine_review_rating', true ) ?: 5,
				'url'        => (string) get_post_meta( $post->ID, '_alpine_review_url', true ),
				'author_url' => '',
			);
		}

		wp_reset_postdata();

		return $reviews;
	}
}

if ( ! function_exists( 'alpine_get_google_reviews_option' ) ) {
	function alpine_get_google_reviews_option( $key, $default = '' ) {
		$options = get_option( 'alpine_google_reviews', array() );

		if ( ! is_array( $options ) ) {
			$options = array();
		}

		return isset( $options[ $key ] ) ? $options[ $key ] : $default;
	}
}

if ( ! function_exists( 'alpine_clear_google_reviews_cache' ) ) {
	function alpine_clear_google_reviews_cache() {
		delete_transient( 'alpine_google_reviews_payload' );
		delete_transient( 'alpine_google_reviews_place_id' );
		delete_option( 'alpine_google_reviews_last_error' );
	}
}

if ( ! function_exists( 'alpine_set_google_reviews_last_error' ) ) {
	function alpine_set_google_reviews_last_error( $message ) {
		if ( '' === trim( (string) $message ) ) {
			delete_option( 'alpine_google_reviews_last_error' );
			return;
		}

		update_option( 'alpine_google_reviews_last_error', sanitize_text_field( $message ), false );
	}
}

if ( ! function_exists( 'alpine_get_google_reviews_last_error' ) ) {
	function alpine_get_google_reviews_last_error() {
		return (string) get_option( 'alpine_google_reviews_last_error', '' );
	}
}

if ( ! function_exists( 'alpine_sanitize_google_reviews_settings' ) ) {
	function alpine_sanitize_google_reviews_settings( $input ) {
		$output = array(
			'api_key'      => '',
			'place_id'     => '',
			'search_query' => '',
			'google_url'   => '',
		);

		if ( isset( $input['api_key'] ) ) {
			$output['api_key'] = sanitize_text_field( $input['api_key'] );
		}

		if ( isset( $input['place_id'] ) ) {
			$output['place_id'] = sanitize_text_field( $input['place_id'] );
		}

		if ( isset( $input['search_query'] ) ) {
			$output['search_query'] = sanitize_text_field( $input['search_query'] );
		}

		if ( isset( $input['google_url'] ) ) {
			$output['google_url'] = esc_url_raw( $input['google_url'] );
		}

		alpine_clear_google_reviews_cache();

		return $output;
	}
}

if ( is_admin() ) {
	add_action(
		'admin_post_alpine_refresh_google_reviews',
		function() {
			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( 'Unauthorized request.' );
			}

			check_admin_referer( 'alpine_refresh_google_reviews' );
			alpine_clear_google_reviews_cache();
			alpine_fetch_google_reviews_payload();

			wp_safe_redirect(
				add_query_arg(
					array(
						'page'    => 'alpine-google-reviews',
						'refresh' => '1',
					),
					admin_url( 'options-general.php' )
				)
			);
			exit;
		}
	);

	add_action(
		'admin_init',
		function() {
			register_setting(
				'alpine_google_reviews_group',
				'alpine_google_reviews',
				array(
					'type'              => 'array',
					'sanitize_callback' => 'alpine_sanitize_google_reviews_settings',
					'default'           => array(),
				)
			);
		}
	);

	add_action(
		'admin_menu',
		function() {
			add_options_page(
				'Google Reviews',
				'Google Reviews',
				'manage_options',
				'alpine-google-reviews',
				'alpine_render_google_reviews_settings_page'
			);
		}
	);
}

if ( ! function_exists( 'alpine_render_google_reviews_settings_page' ) ) {
	function alpine_render_google_reviews_settings_page() {
		$options = get_option( 'alpine_google_reviews', array() );
		$last_error = alpine_get_google_reviews_last_error();
		$cached_payload = get_transient( 'alpine_google_reviews_payload' );
		$has_live_reviews = is_array( $cached_payload ) && ! empty( $cached_payload['reviews'] );
		?>
		<div class="wrap">
			<h1>Google Reviews</h1>
			<p>Connect the homepage testimonial section to Google reviews using the Places API (New).</p>
			<?php if ( isset( $_GET['refresh'] ) ) : ?>
				<div class="notice notice-success is-dismissible"><p>Google reviews cache refreshed.</p></div>
			<?php endif; ?>
			<div class="notice <?php echo $has_live_reviews ? 'notice-success' : 'notice-warning'; ?> inline">
				<p>
					<strong>Status:</strong>
					<?php echo $has_live_reviews ? 'Live Google reviews are cached and ready.' : 'The homepage is currently using fallback reviews.'; ?>
				</p>
				<?php if ( '' !== $last_error ) : ?>
					<p><strong>Last API message:</strong> <?php echo esc_html( $last_error ); ?></p>
				<?php endif; ?>
			</div>
			<form method="post" action="options.php">
				<?php settings_fields( 'alpine_google_reviews_group' ); ?>
				<table class="form-table" role="presentation">
					<tbody>
						<tr>
							<th scope="row"><label for="alpine-google-reviews-api-key">API key</label></th>
							<td>
								<input id="alpine-google-reviews-api-key" name="alpine_google_reviews[api_key]" type="text" class="regular-text" value="<?php echo esc_attr( isset( $options['api_key'] ) ? $options['api_key'] : '' ); ?>" autocomplete="off" />
								<p class="description">Use a Google Maps Platform API key with Places API (New) enabled.</p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="alpine-google-reviews-place-id">Place ID</label></th>
							<td>
								<input id="alpine-google-reviews-place-id" name="alpine_google_reviews[place_id]" type="text" class="regular-text" value="<?php echo esc_attr( isset( $options['place_id'] ) ? $options['place_id'] : '' ); ?>" />
								<p class="description">Recommended. If you leave this blank, the theme will try to resolve the business using the search query below.</p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="alpine-google-reviews-search-query">Search query</label></th>
							<td>
								<input id="alpine-google-reviews-search-query" name="alpine_google_reviews[search_query]" type="text" class="regular-text" value="<?php echo esc_attr( isset( $options['search_query'] ) ? $options['search_query'] : 'Alpine Heating & Air Conditioning Austin TX' ); ?>" />
								<p class="description">Fallback text search used only when Place ID is not filled in.</p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="alpine-google-reviews-google-url">Google reviews URL</label></th>
							<td>
								<input id="alpine-google-reviews-google-url" name="alpine_google_reviews[google_url]" type="url" class="regular-text code" value="<?php echo esc_attr( isset( $options['google_url'] ) ? $options['google_url'] : '' ); ?>" />
								<p class="description">Used for the “Read Google Reviews” and “View Review” links on the homepage.</p>
							</td>
						</tr>
					</tbody>
				</table>
				<?php submit_button( 'Save Google Reviews Settings' ); ?>
			</form>
			<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="margin-top: 1rem;">
				<?php wp_nonce_field( 'alpine_refresh_google_reviews' ); ?>
				<input type="hidden" name="action" value="alpine_refresh_google_reviews" />
				<?php submit_button( 'Refresh Reviews Cache', 'secondary', 'submit', false ); ?>
			</form>
		</div>
		<?php
	}
}

if ( ! function_exists( 'alpine_fetch_google_reviews_place_id' ) ) {
	function alpine_fetch_google_reviews_place_id( $api_key, $search_query ) {
		$cached_place_id = get_transient( 'alpine_google_reviews_place_id' );

		if ( is_string( $cached_place_id ) && '' !== $cached_place_id ) {
			return $cached_place_id;
		}

		$response = wp_remote_post(
			'https://places.googleapis.com/v1/places:searchText',
			array(
				'timeout' => 15,
				'headers' => array(
					'Content-Type'     => 'application/json',
					'X-Goog-Api-Key'   => $api_key,
					'X-Goog-FieldMask' => 'places.id',
				),
				'body'    => wp_json_encode(
					array(
						'textQuery' => $search_query,
						'pageSize'  => 1,
					)
				),
			)
		);

		if ( is_wp_error( $response ) ) {
			alpine_set_google_reviews_last_error( $response->get_error_message() );
			return '';
		}

		if ( 200 !== (int) wp_remote_retrieve_response_code( $response ) ) {
			alpine_set_google_reviews_last_error( 'Text Search failed with HTTP ' . wp_remote_retrieve_response_code( $response ) . '.' );
			return '';
		}

		$body = json_decode( wp_remote_retrieve_body( $response ), true );
		$place_id = '';

		if ( ! empty( $body['places'][0]['id'] ) ) {
			$place_id = sanitize_text_field( $body['places'][0]['id'] );
			set_transient( 'alpine_google_reviews_place_id', $place_id, DAY_IN_SECONDS );
			alpine_set_google_reviews_last_error( '' );
		} else {
			alpine_set_google_reviews_last_error( 'Text Search returned no matching place.' );
		}

		return $place_id;
	}
}

if ( ! function_exists( 'alpine_fetch_google_reviews_payload' ) ) {
	function alpine_fetch_google_reviews_payload() {
		$cached_payload = get_transient( 'alpine_google_reviews_payload' );

		if ( is_array( $cached_payload ) && ! empty( $cached_payload ) ) {
			return $cached_payload;
		}

		$api_key = alpine_get_google_reviews_option( 'api_key' );

		if ( '' === $api_key ) {
			alpine_set_google_reviews_last_error( 'Google API key is missing.' );
			return array();
		}

		$place_id = alpine_get_google_reviews_option( 'place_id' );

		if ( '' === $place_id ) {
			$place_id = alpine_fetch_google_reviews_place_id( $api_key, alpine_get_google_reviews_option( 'search_query', 'Alpine Heating & Air Conditioning Austin TX' ) );
		}

		if ( '' === $place_id ) {
			alpine_set_google_reviews_last_error( 'Place ID could not be resolved.' );
			return array();
		}

		$response = wp_remote_get(
			'https://places.googleapis.com/v1/places/' . rawurlencode( $place_id ),
			array(
				'timeout' => 15,
				'headers' => array(
					'Content-Type'     => 'application/json',
					'X-Goog-Api-Key'   => $api_key,
					'X-Goog-FieldMask' => 'id,displayName,rating,userRatingCount,reviews.googleMapsUri,reviews.authorAttribution,reviews.rating,reviews.relativePublishTimeDescription,reviews.text,reviews.originalText',
				),
			)
		);

		if ( is_wp_error( $response ) ) {
			alpine_set_google_reviews_last_error( $response->get_error_message() );
			return array();
		}

		if ( 200 !== (int) wp_remote_retrieve_response_code( $response ) ) {
			alpine_set_google_reviews_last_error( 'Place Details failed with HTTP ' . wp_remote_retrieve_response_code( $response ) . '.' );
			return array();
		}

		$body = json_decode( wp_remote_retrieve_body( $response ), true );

		if ( ! is_array( $body ) || empty( $body['reviews'] ) ) {
			alpine_set_google_reviews_last_error( 'Google returned the place, but no public reviews were included in the response.' );
			return array();
		}

		set_transient( 'alpine_google_reviews_payload', $body, 12 * HOUR_IN_SECONDS );
		alpine_set_google_reviews_last_error( '' );

		return $body;
	}
}

if ( ! function_exists( 'alpine_format_google_review_text' ) ) {
	function alpine_format_google_review_text( $review ) {
		if ( ! empty( $review['originalText']['text'] ) ) {
			return wp_strip_all_tags( $review['originalText']['text'] );
		}

		if ( ! empty( $review['text']['text'] ) ) {
			return wp_strip_all_tags( $review['text']['text'] );
		}

		return '';
	}
}

if ( ! function_exists( 'alpine_trim_google_review_text' ) ) {
	function alpine_trim_google_review_text( $text, $length = 220 ) {
		$text = trim( wp_strip_all_tags( (string) $text ) );

		if ( '' === $text ) {
			return '';
		}

		if ( function_exists( 'mb_strlen' ) && function_exists( 'mb_substr' ) ) {
			if ( mb_strlen( $text ) <= $length ) {
				return $text;
			}

			return rtrim( mb_substr( $text, 0, $length - 1 ) ) . '…';
		}

		if ( strlen( $text ) <= $length ) {
			return $text;
		}

		return rtrim( substr( $text, 0, $length - 1 ) ) . '...';
	}
}

if ( ! function_exists( 'alpine_get_homepage_reviews_data' ) ) {
	function alpine_get_homepage_reviews_data( $fallback_reviews = array(), $limit = 30 ) {
		$local_reviews = alpine_get_local_reviews( $limit );
		$payload = alpine_fetch_google_reviews_payload();
		$google_url = alpine_get_google_reviews_option( 'google_url' );

		if ( '' === $google_url ) {
			$google_url = 'https://www.google.com/maps/place/Alpine+Heating+%26+Air+Conditioning/@30.3447804,-97.68545,638m/data=!3m1!1e3!4m8!3m7!1s0x8644cb9622becf43:0xdb75f99757ea2077!8m2!3d30.3447804!4d-97.68545!9m1!1b1!16s%2Fg%2F11bbrjc3d0?hl=en&entry=ttu&g_ep=EgoyMDI2MDMyOS4wIKXMDSoASAFQAw%3D%3D';
		}

		$data = array(
			'reviews'           => ! empty( $local_reviews ) ? $local_reviews : $fallback_reviews,
			'rating'            => '4.9',
			'user_rating_count' => '',
			'google_url'        => $google_url,
			'is_live'           => ! empty( $local_reviews ),
		);

		if ( ! empty( $payload['rating'] ) ) {
			$data['rating'] = number_format_i18n( (float) $payload['rating'], 1 );
		}

		if ( ! empty( $payload['userRatingCount'] ) ) {
			$data['user_rating_count'] = number_format_i18n( (int) $payload['userRatingCount'] );
		}

		if ( ! empty( $local_reviews ) ) {
			return $data;
		}

		if ( empty( $payload['reviews'] ) ) {
			return $data;
		}

		$reviews = array();

		foreach ( array_slice( $payload['reviews'], 0, min( 5, (int) $limit ) ) as $review ) {
			$quote = alpine_format_google_review_text( $review );

			if ( '' === $quote ) {
				continue;
			}

			$reviews[] = array(
				'quote'      => alpine_trim_google_review_text( $quote, 220 ),
				'full_quote' => $quote,
				'name'       => ! empty( $review['authorAttribution']['displayName'] ) ? $review['authorAttribution']['displayName'] : 'Google Reviewer',
				'role'       => '',
				'location'   => ! empty( $review['relativePublishTimeDescription'] ) ? $review['relativePublishTimeDescription'] : 'Google',
				'rating'     => ! empty( $review['rating'] ) ? (int) $review['rating'] : 5,
				'url'        => ! empty( $review['googleMapsUri'] ) ? esc_url_raw( $review['googleMapsUri'] ) : $google_url,
				'author_url' => ! empty( $review['authorAttribution']['uri'] ) ? esc_url_raw( $review['authorAttribution']['uri'] ) : '',
			);
		}

		if ( ! empty( $reviews ) ) {
			$data['reviews'] = $reviews;
			$data['is_live'] = true;
		}

		return $data;
	}
}
