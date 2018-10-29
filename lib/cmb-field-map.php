<?php

/**
 * Class CANDOR_CMB2_Field_Google_Maps
 */
class CANDOR_CMB2_Field_Google_Maps {

	/**
	 * Current version number
	 */
	const VERSION = '2.1.1';

	/**
	 * Initialize the plugin by hooking into CMB2
	 */
	public function __construct() {
		add_filter( 'cmb2_render_candor_map', array( $this, 'render_candor_map' ), 10, 5 );
		add_filter( 'cmb2_sanitize_candor_map', array( $this, 'sanitize_candor_map' ), 10, 4 );
	}

	/**
	 * Render field
	 */
	public function render_candor_map( $field, $field_escaped_value, $field_object_id, $field_object_type, $field_type_object ) {
		$this->setup_admin_scripts();

		echo '<input type="text" class="large-text candor-map-search" id="' . $field->args( 'id' ) . '" />';

		echo '<div class="candor-map"></div>';

		$field_type_object->_desc( true, true );

		echo $field_type_object->input( array(
			'type'       => 'hidden',
			'name'       => $field->args('_name') . '[latitude]',
			'value'      => isset( $field_escaped_value['latitude'] ) ? $field_escaped_value['latitude'] : '',
			'class'      => 'candor-map-latitude',
			'desc'       => '',
		) );
		echo $field_type_object->input( array(
			'type'       => 'hidden',
			'name'       => $field->args('_name') . '[longitude]',
			'value'      => isset( $field_escaped_value['longitude'] ) ? $field_escaped_value['longitude'] : '',
			'class'      => 'candor-map-longitude',
			'desc'       => '',
		) );
	}

	/**
	 * Optionally save the latitude/longitude values into two custom fields
	 */
	public function sanitize_candor_map( $override_value, $value, $object_id, $field_args ) {
		if ( isset( $field_args['split_values'] ) && $field_args['split_values'] ) {
			if ( ! empty( $value['latitude'] ) ) {
				update_post_meta( $object_id, $field_args['id'] . '_latitude', $value['latitude'] );
			}

			if ( ! empty( $value['longitude'] ) ) {
				update_post_meta( $object_id, $field_args['id'] . '_longitude', $value['longitude'] );
			}
		}

		return $value;
	}

	/**
	 * Enqueue scripts and styles
	 */
	public function setup_admin_scripts() {
		wp_register_script( 'candor-google-maps-api', '//maps.googleapis.com/maps/api/js?libraries=places', null, null );
		wp_enqueue_script( 'candor-google-maps', plugins_url( 'js/cmb-google.js', __FILE__ ), array( 'candor-google-maps-api' ), self::VERSION );
		//wp_enqueue_style( 'candor-google-maps', plugins_url( 'css/style.css', __FILE__ ), array(), self::VERSION );
	}
}
$CANDOR_CMB2_Field_Google_Maps = new CANDOR_CMB2_Field_Google_Maps();