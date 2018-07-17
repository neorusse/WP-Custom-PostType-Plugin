<?php
/*
Plugin Name:       Rurho Custom Post Type
Description:       Plugin Developed to register Custom Post Type and Taxonomy.
Plugin URI:        https://profiles.wordpress.org/
Author:            Russell Nyorere
Version:           1.0
Text Domain:       rurho-posttype
Domain Path:       /languages
License:           GPL v2 or later
License URI:       https://www.gnu.org/licenses/gpl-2.0.txt

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version
2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
with this program. If not, visit: https://www.gnu.org/licenses/
*/

// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}


/*******************************************************************************************
rurho_create_post_type - registers the post types
*******************************************************************************************/
function rurho_create_post_type() {
	$labels = array(
		'name' => __( 'Projects', 'rurho' ),
		'singular_name' => __( 'Project', 'rurho' ),
		'add_new' => __( 'New Project', 'rurho' ),
		'add_new_item' => __( 'Add New Project', 'rurho' ),
		'edit_item' => __( 'Edit Project', 'rurho' ),
		'new_item' => __( 'New Project', 'rurho' ),
		'view_item' => __( 'View Project', 'rurho' ),
		'search_items' => __( 'Search Projects', 'rurho' ),
		'not_found' =>  __( 'No Projects Found', 'rurho' ),
		'not_found_in_trash' => __( 'No Projects found in Trash', 'rurho' ),
	);
	$args = array(
		'labels' => $labels,
		'has_archive' => true,
		'public' => true,
		'hierarchical' => false,
		'rewrite' => array( 'slug' => 'projects' ),
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'custom-fields',
			'thumbnail',
			'page-attributes'
		),
		'taxonomies' => array( 'post_tag', 'category'),
		'menu_icon'	=>	'dashicons-screenoptions',
	);
	register_post_type( 'project', $args );
}
add_action( 'init', 'rurho_create_post_type' );

/*******************************************************************************************
rurho_register_taxonomy - registers the taxonomies
*******************************************************************************************/
function rurho_register_taxonomy() {

  $labels = array(
		'name'              => __( 'Services', 'rurho' ),
		'singular_name'     => __( 'Service', 'rurho' ),
		'search_items'      => __( 'Search Services', 'rurho' ),
		'all_items'         => __( 'All Services', 'rurho' ),
		'edit_item'         => __( 'Edit Services', 'rurho' ),
		'update_item'       => __( 'Update Services', 'rurho' ),
		'add_new_item'      => __( 'Add New Services', 'rurho' ),
		'new_item_name'     => __( 'New Service Name', 'rurho' ),
		'menu_name'         => __( 'Services', 'rurho' ),
	);

	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'sort' => true,
		'args' => array( 'orderby' => 'term_order' ),
		'rewrite' => array( 'slug' => 'services' ),
		'show_admin_column' => true
	);

	register_taxonomy( 'service', array( 'post', 'project' ), $args);

}
add_action( 'init', 'rurho_register_taxonomy' );

/*******************************************************************************************
rurho_add_categories_to_pages - registers the category taxonmy to the page post type
*******************************************************************************************/
function rurho_add_categories_to_pages() {
	register_taxonomy_for_object_type( 'category', 'page' );
}
add_action( 'init', 'rurho_add_categories_to_pages' );
