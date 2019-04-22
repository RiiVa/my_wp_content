<?php
/**
 * The torbara Image component contains a set of functions to edit images on the fly.
 *
 * Edited images are duplicates of the orinigals. All modified images are stored in a shared folder,
 * which makes it easy to delete them without impacting the originals.
 *
 * @package API\Image
 */


/**
 * Edit image size and/or quality.
 *
 * Edited images are duplicates of the originals. All modified images are stored in a shared folder,
 * which makes it easy to delete them without impacting the originals.
 *
 * @since 1.0.0
 *
 * @param string $src The image source.
 * @param array  $args {
 *      Associative array of arguments used by the image editor.
 *
 * 		@type array $resize 	 Numeric array matching the {@link http://codex.WordPress.org/Class_Reference/WP_Image_Editor WP_Image_Editor} resize
 * 		      					 function arguments.
 * 		@type array $crop  	     Numeric array matching the {@link http://codex.WordPress.org/Class_Reference/WP_Image_Editor WP_Image_Editor} crop
 * 		      					 function arguments.
 * 		@type array $rotate      Numeric array matching the {@link http://codex.WordPress.org/Class_Reference/WP_Image_Editor WP_Image_Editor} rotate
 * 		      				     function arguments.
 * 		@type array $flip        Numeric array matching the {@link http://codex.WordPress.org/Class_Reference/WP_Image_Editor WP_Image_Editor} flip
 * 		      				     function arguments.
 * 		@type array $set_quality Numeric array matching the {@link http://codex.WordPress.org/Class_Reference/WP_Image_Editor WP_Image_Editor} set_quality
 * 		      					 function arguments.
 * }
 * @param string $output Optional. Returned format. Accepts STRING, OBJECT, ARRAY_A, or ARRAY_N.
 *                            Default STRING.
 *
 * @return string|array Image source if output set the STRING, image data otherwise.
 */
function yourfitness_edit_image( $src, array $args, $output = 'STRING' ) {

        load_template( yourfitness_API_PATH . 'image/class-images.php', true );

	$instance = new yourfitness_tt_Image_Editor( $src, $args, $output );

	return $instance->init();

}


/**
 * Get attachment data.
 *
 * This function regroups all necessary data about a post attachment into an object.
 *
 * @since 1.0.0
 *
 * @param string $post_id The post id.
 * @param string $size    Optional. The desired attachment size. Accepts 'thumbnail', 'medium', 'large'
 *                        or 'full'.
 *
 * @return object Post attachment data.
 */
function yourfitness_get_post_attachment( $post_id, $size = 'full' ) {

	$id = get_post_thumbnail_id( $post_id );
	$post = get_post( $id );
	$src = wp_get_attachment_image_src( $id, $size );

	$obj = new stdClass();
	$obj->id = $id;
	$obj->src = $src[0];
	$obj->width = $src[1];
	$obj->height = $src[2];
	$obj->alt = trim( strip_tags( get_post_meta( $id, '_wp_attachment_image_alt', true ) ) );
	if(isset($post->post_title)) { $obj->title = $post->post_title; } else { $obj->title = ""; }
        if(isset($post->post_excerpt)) { $obj->caption = $post->post_excerpt; } else { $obj->post_excerpt = ""; }
        if(isset($post->post_content)) { $obj->description = $post->post_content; } else { $obj->post_content = ""; }

	return $obj;

}


/**
 * Edit post attachment.
 *
 * This function is shortuct of {@see yourfitness_edit_image()}. It should be used to edit a post attachment.
 *
 * @since 1.0.0
 *
 * @param string $post_id The post id.
 * @param array  $args {
 *      Array of arguments used by the image editor.
 *
 * 		@type array $resize 	 Numeric array matching the {@link http://codex.WordPress.org/Class_Reference/WP_Image_Editor WP_Image_Editor} resize
 * 		      					 function arguments.
 * 		@type array $crop  	     Numeric array matching the {@link http://codex.WordPress.org/Class_Reference/WP_Image_Editor WP_Image_Editor} crop
 * 		      					 function arguments.
 * 		@type array $rotate      Numeric array matching the {@link http://codex.WordPress.org/Class_Reference/WP_Image_Editor WP_Image_Editor} rotate
 * 		      				     function arguments.
 * 		@type array $flip        Numeric array matching the {@link http://codex.WordPress.org/Class_Reference/WP_Image_Editor WP_Image_Editor} flip
 * 		      				     function arguments.
 * 		@type array $set_quality Numeric array matching the {@link http://codex.WordPress.org/Class_Reference/WP_Image_Editor WP_Image_Editor} set_quality
 * 		      					 function arguments. Default 100.
 * }
 *
 * @return object Edited post attachment data.
 */
function yourfitness_edit_post_attachment( $post_id, $args = array() ) {

	if ( !has_post_thumbnail( $post_id ) )
		return false;

	// Get full size image.
	$attachement = yourfitness_get_post_attachment( $post_id, 'full' );

	if ( !$edited = yourfitness_edit_image( $attachement->src, $args, 'ARRAY_A' ) )
		return $attachement;

	return (object) array_merge( (array) $attachement, $edited );

}


/**
 * Get edited images directory.
 *
 * @since 1.0.0
 *
 * @return string Edited images directory.
 */
function yourfitness_get_images_dir() {

	$wp_upload_dir = wp_upload_dir();

	/**
	 * Filter the edited images directory.
	 *
	 * @since 1.0.0
	 */
	$dir = apply_filters( 'yourfitness_images_dir', trailingslashit( $wp_upload_dir['basedir'] ) . 'torbara/images/' );

	return wp_normalize_path( trailingslashit( $dir ) );

}