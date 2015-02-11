<?php
/**
 * Plugin Name: Code-Architect Custom post type
 * Description: This plugin is mainly for food, travel and movie websites. This have reviews, moods, testimonials, Price Range and Products/Services taxonomies.
 * Version: 1.0
 * Author: Code-Architect
 * Licence: GPL2
 */
 /*  Copyright 2015  Code-Architect  (email : odearchitectdeveloper@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
  * Localizing strings using poedit
  */
  function widget_textdomain(){
    load_plugin_textdomain( 'architect', false, plugin_dir_path(__FILE__).'/lang/' );
  }


/**
 * Creating custom post type
 */
function ca_custom_posttypes(){
	
	// Testimonial post type
	$labels = array(
        'name'               => __('Testimonials', 'architect'),
        'singular_name'      => __('Testimonial', 'architect'),
        'menu_name'          => __('Testimonials', 'architect'),
        'name_admin_bar'     => __('Testimonial', 'architect'),
        'add_new'            => __('Add New', 'architect'),
        'add_new_item'       => __('Add New Testimonial', 'architect'),
        'new_item'           => __('New Testimonial', 'architect'),
        'edit_item'          => __('Edit Testimonial', 'architect'),
        'view_item'          => __('View Testimonial', 'architect'),
        'all_items'          => __('All Testimonials', 'architect'),
        'search_items'       => __('Search Testimonials', 'architect'),
        'parent_item_colon'  => __('Parent Testimonials:', 'architect'),
        'not_found'          => __('No testimonials found.', 'architect'),
        'not_found_in_trash' => __('No testimonials found in Trash.', 'architect'),
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-testimonial',
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'testimonials' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies' 		 => array( 'category', 'post_tag' )
    );	
	register_post_type(
		'testimonials',				// This is the name we are going to use whenever we are going to call this custom post type
		$args						// Other arguments		
	); // Testimonial post type ends
	
	// Reviews post type
	$labels = array(
        'name'               => __('Reviews', 'architect'),
        'singular_name'      => __('Review', 'architect'),
        'menu_name'          => __('Reviews', 'architect'),
        'name_admin_bar'     => __('Review', 'architect'),
        'add_new'            => __('Add New', 'architect'),
        'add_new_item'       => __('Add New Review', 'architect'),
        'new_item'           => __('New Review', 'architect'),
        'edit_item'          => __('Edit Review', 'architect'),
        'view_item'          => __('View Review', 'architect'),
        'all_items'          => __('All Reviews', 'architect'),
        'search_items'       => __('Search Reviews', 'architect'),
        'parent_item_colon'  => __('Parent Reviews:', 'architect'),
        'not_found'          => __('No reviews found.', 'architect'),
        'not_found_in_trash' => __('No reviews found in Trash.', 'architect'),
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-star-half',
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'reviews' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'thumbnail','author', 'excerpt',
									   'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats' ),
		'taxonomies' 		 => array( 'category', 'post_tag' )
    );	
	register_post_type(
		'reviews',				// This is the name we are going to use whenever we are going to call this custom post type
		$args						// Other arguments		
	); //Reviews post type ends
}

add_action('init', 'ca_custom_posttypes');

function my_rewrite_flush() {
    
    ca_custom_posttypes();
   
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'my_rewrite_flush' );

//************************************************************************************************************************

/**
 * Creating custom Taxonomies
 */
 
 
 function ca_custom_taxonomies(){
	/* Type of product/service */
	$labels = array(
        'name'              => __('Type of Products/Services', 'architect'),
        'singular_name'     => __('Type of Product/Service', 'architect'),
        'search_items'      => __('Search Types of Products/Services', 'architect'),
        'all_items'         => __('All Types of Products/Services', 'architect'),
        'parent_item'       => __('Parent Type of Product/Service', 'architect'),
        'parent_item_colon' => __('Parent Type of Product/Service:', 'architect'),
        'edit_item'         => __('Edit Type of Product/Service', 'architect'),
        'update_item'       => __('Update Type of Product/Service', 'architect'),
        'add_new_item'      => __('Add New Type of Product/Service', 'architect'),
        'new_item_name'     => __('New Type of Product/Service Name', 'architect'),
        'menu_name'         => __('Type of Product/Service', 'architect')
    );
	
	$args = array(
        'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
        'rewrite'           => array( 'slug' => 'product-types' )
    );
	
	register_taxonomy(
		'product-type',		// Machine readable name
		'reviews', 			// Which post type this taxonomy applies to
		$args				// Arguments
	 );
	 
	 /* ******** Mood ************ */	 	
	$labels = array(
        'name'                       => __('Moods', 'architect'),
        'singular_name'              => __('Mood', 'architect'),
        'search_items'               => __('Search Moods', 'architect'),
        'popular_items'              => __('Popular Moods', 'architect'),
        'all_items'                  => __('All Moods', 'architect'),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __('Edit Mood', 'architect'),
        'update_item'                => __('Update Mood', 'architect'),
        'add_new_item'               => __('Add New Mood', 'architect'),
        'new_item_name'              => __('New Mood Name', 'architect'),
        'separate_items_with_commas' => __('Separate moods with commas', 'architect'),
        'add_or_remove_items'        => __('Add or remove moods', 'architect'),
        'choose_from_most_used'      => __('Choose from the most used moods', 'architect'),
        'not_found'                  => __('No moods found.', 'architect'),
        'menu_name'                  => __('Moods', 'architect')
    );	
		
	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'moods' ),
		'update_count_callback' => '_update_post_term_count'
	);
		
	register_taxonomy(
		'mood',							// Machine readable name
		array( 'reviews', 'post' ), 	// Which post type this taxonomy applies to
		$args	 						// Arguments
	);	
	
	/** ********* Price Range ***** */
	$labels = array(
        'name'              => __('Price Range', 'architect'),
        'singular_name'     => __('Price Range', 'architect'),
        'search_items'      => __('Search Price Ranges', 'architect'),
        'all_items'         => __('All Price Ranges', 'architect'),
        'parent_item'       => __('ParentPrice Range', 'architect'),
        'parent_item_colon' => __('Parent Price Range:', 'architect'),
        'edit_item'         => __('Edit Price Range', 'architect'),
        'update_item'       => __('Update Price Range', 'architect'),
        'add_new_item'      => __('Add New Price Range', 'architect'),
        'new_item_name'     => __('New Price Range', 'architect'),
        'menu_name'         => __('Price Ranges', 'architect')
    );
	
	$args = array(
        'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
        'rewrite'           => array( 'slug' => 'prices' )
    );
	
	register_taxonomy(
		'price',		// Machine readable name
		'reviews', 			// Which post type this taxonomy applies to
		$args				// Arguments
	 );
	
 }
 
 add_action('init', 'ca_custom_taxonomies');
 