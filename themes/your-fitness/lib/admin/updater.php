<?php
/**
 * Handles torbara updates.
 *
 * @package torbara
 * @since 1.0.0
 */

//add_filter( 'site_transient_update_themes', 'yourfitness_updater' );

/**
 * Retrieve product data from torbara REST API.
 *
 * Data are cached in a 24 hours transients and will be returned if found to avoid long loading time.
 *
 * @ignore
 */
function yourfitness_updater( $value ) {

	// Stop here if the current user is not a super admin user.
	if ( !is_super_admin() )
		return;

	$data = get_site_transient( 'yourfitness_updater' );
	$theme = wp_get_theme( 'your-fitness' );

	if ( !$theme->exists() )
		return $value;

	$current_version = $theme->get( 'Version' );

	// Query torbara REST API if the transient is expired.
	if ( empty( $data ) ) {

		$response = wp_remote_get( 'http://www.gettorbara.io/rest-api/', array( 'sslverify' => false ) );

		// Retrieve data from the body and decode json format.
		$data = json_decode( wp_remote_retrieve_body( $response ), true );

		// Stop here if the is an error.
		if ( is_wp_error( $response ) || isset( $data['error'] ) ) {

			// Set temporary transient.
			set_site_transient( 'yourfitness_updater', array( 'version' => $current_version ), 30 * MINUTE_IN_SECONDS );

			return $value;

		}

		set_site_transient( 'yourfitness_updater', $data, 24 * HOUR_IN_SECONDS );

	}

	// Return data if torbara is not up to date.
	if ( version_compare( $current_version, yourfitness_get( 'version', $data ), '<' ) ) {

		$value->response[$data['path']] = array(
			'slug' => $data['slug'],
			'name' => $data['name'],
			'url' => $data['changelog_url'],
			'package' => $data['download_url'],
			'new_version' => $data['version'],
			'tested' => $data['tested'],
			'requires' => $data['requires']
		);

		return $value;

	}

	return $value;

}


add_action( 'load-update-core.php', 'yourfitness_updater_clear_transient' );

/**
 * Clear updater transient.
 *
 * @ignore
 */
function yourfitness_updater_clear_transient() {

	delete_site_transient( 'yourfitness_updater' );

}