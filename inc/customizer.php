<?php

/**
 * Remove "useless" customizers
 */
function remove_customizers( $wp_customize ) {
	$wp_customize->remove_control( 'custom_logo' );
	$wp_customize->remove_control( 'header_textcolor' );
	$wp_customize->remove_control( 'header_image' );
	$wp_customize->remove_control( 'custom_css' );
	$wp_customize->remove_control( 'custom_icon' );
	$wp_customize->remove_control( 'site_icon' );
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'background_image' );
	$wp_customize->remove_section( 'static_front_page' );
}
add_action( 'customize_register', 'remove_customizers' );
