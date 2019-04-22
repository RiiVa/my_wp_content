<?php
/**
 * @package API\Fields\Types
 */

yourfitness_add_smart_action( 'yourfitness_field_enqueue_scripts_image', 'yourfitness_field_image_assets' );

/**
 * Enqueued assets required by the torbara image field.
 *
 * @since 1.0.0
 */
function yourfitness_field_image_assets() {

	wp_enqueue_media();
	wp_enqueue_script( 'jquery-ui-sortable' );
	wp_enqueue_script( 'torbara-field-media', yourfitness_API_URL . 'fields/assets/js/media' . yourfitness_MIN_CSS . '.js', array( 'jquery' ), yourfitness_VERSION );

}


yourfitness_add_smart_action( 'yourfitness_field_image', 'yourfitness_field_image' );

/**
 * Echo image field type.
 *
 * @since 1.0.0
 *
 * @param array $field {
 *      For best practices, pass the array of data obtained using {@see yourfitness_get_fields()}.
 *
 *      @type mixed  $value      The field value.
 *      @type string $name       The field name value.
 *      @type array  $attributes An array of attributes to add to the field. The array key defines the
 *            					 attribute name and the array value defines the attribute value. Default array.
 *      @type mixed  $default    The default value. Default false.
 *      @type string $multiple   Set to true to enable mutliple images (gallery). Default false.
 * }
 */
function yourfitness_field_image( $field ) {

	// Set the images variable and add placeholder to the array.
	$images = array_merge( (array) $field['value'], array( 'placeholder' ) );

	// Is multiple set.
	$multiple = yourfitness_get( 'multiple', $field );

	// Hide torbara if it is a single image and an image already exists
	$hide = !$multiple && is_numeric( $field['value'] ) ? 'style  =  "display: none"' : '';

	?>
	<a href="#" class="bs-add-image button button-small" <?php echo esc_attr($hide); ?>><?php echo esc_html(_n( 'Add Image', 'Add Images', ( $multiple ? 2 : 1 ), 'your-fitness' )); ?></a>
	<input type="hidden" name="<?php echo esc_attr( $field['name'] ); ?>" value="">
	<div class="bs-images-wrap" data-multiple="<?php echo esc_attr( $multiple ); ?>">
		<?php foreach ( $images as $id ) :

			// Stop here if the id is false.
			if ( !$id )
				continue;

			$class = '';
			$img = wp_get_attachment_image_src( $id, 'thumbnail' );

			$attributes = array_merge( array(
				'class' => 'image-id',
				'type' => 'hidden',
				'name' => $multiple ? $field['name'] . '[]' : $field['name'], // Return single value if not multiple.
				'value' => $id
			), $field['attributes'] );

			// Set placeholder.
			if ( $id == 'placeholder' ) {

				$class = 'bs-image-template';
				$attributes = array_merge( $attributes, array( 'disabled' => 'disabled', 'value' => false ) );

			}

			?>
			<div class="bs-image-wrap <?php echo esc_attr( $class ); ?>">
				<input <?php echo yourfitness_esc_attributes( $attributes ); ?>/>
				<img src="<?php echo esc_url( yourfitness_get( 0, $img ) ); ?>">
				<div class="bs-toolbar">
					<?php if ( $multiple ) : ?>
						<a href="#" class="dashicons dashicons-menu"></a>
					<?php endif; ?>
					<a href="#" class="dashicons dashicons-edit"></a>
					<a href="#" class="dashicons dashicons-post-trash"></a>
				</div>
			</div>

		<?php endforeach; ?>
	</div>
	<?php

}