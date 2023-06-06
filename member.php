<?php
/**
 * Plugin Name:       BFL Membership Block
 * Description:       A block to build member levels in a Makerspace website.
 * Requires at least: 6.0
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Greg Miller
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       member
 *
 * @package           acf
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function acf_member_block_init() {
	register_block_type( __DIR__ . '/build/block.json' );
}
add_action( 'init', 'acf_member_block_init', 5 );

/**
 * Registers the ACF fields using PHP APIs.
 */
function acf_member_register_php_fields() {

    $path                     = __DIR__ . '/acf-fields.json';
    $field_json               = json_decode( file_get_contents( $path ), true );
    $field_json['location']   = array(
        array(
            array(
                'param'    => 'block',
                'operator' => '==',
                'value'    => 'acf/member', // block.json name.
            ),
        ),
    );
    $field_json['local']      = 'json';
    $field_json['local_file'] = $path;

    acf_add_local_field_group( $field_json );
}
add_action( 'acf/include_fields', 'acf_member_register_php_fields' );

/**
 * Register a custom block category for our blocks.
 *
 * @link https://developer.wordpress.org/reference/hooks/block_categories_all/
 *
 * @param array $block_categories Existing block categories
 * @return array Block categories
 */
function acf_member_block_categories( $block_categories ) {

	$block_categories = array_merge(
		[
			[
				'slug'  => 'member',
				'title' => __( 'ACF Blocks', 'bfl_member_block' ),
				'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="black" d="M13 11a1 1 0 0 1 1 1a1 1 0 0 1-1 1a1 1 0 0 1-1-1a1 1 0 0 1 1-1M7.86 6.25A6.997 6.997 0 0 1 13 4c3.5 0 6.44 2.61 6.93 6H22v2h-6a3 3 0 0 0-3-3a3 3 0 0 0-3 3H2v-2h.05c.2-2.27 1.09-4.34 2.45-6l3.36 2.25M6.73 7.89L5.06 6.77c-.53.98-.88 2.07-1 3.23h2.01c.11-.75.33-1.46.66-2.11m.67 7.51L6 14h5.79c.24.42.71.7 1.21.7s.97-.28 1.21-.7H20v1.4c-1.61-.98-1.54.35-1.54.35v1.96l-1.96 1.96c-.5-1.75-1.4-.77-1.4-.77l-1.4 1.4h-2.8c.98-1.61-.35-1.54-.35-1.54H8.59L6.63 16.8c1.75-.49.77-1.4.77-1.4Z"/></svg>'
            ]
		],
		$block_categories,
	);

	return $block_categories;
}
add_filter( 'block_categories_all', 'acf_member_block_categories' );