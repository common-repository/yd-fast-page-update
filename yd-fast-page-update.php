<?php
/**
 * @package YD_FAST_page-update
 * @author Yann Dubois
 * @version 0.2.0
 */

/*
 Plugin Name: YD *FAST* Page Update
 Plugin URI: http://www.yann.com/en/wp-plugins/yd-fast-page-update
 Description: Speed-up page updates in CMS-oriented Wordpress blogs reaching a few hundred hierarchical pages. Adds manual rewrite rules flush control. | Funded by <a href="http://www.nogent-citoyen.com">Nogent Citoyen</a>
 Author: Yann Dubois
 Version: 0.2.0
 Author URI: http://www.yann.com/
 */

/**
 * @copyright 2010  Yann Dubois  ( email : yann _at_ abc.fr )
 *
 *  Original development of this plugin was kindly funded by http://www.nogent-citoyen.com
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program; if not, write to the Free Software
 *  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
/**
 Revision 0.1.0:
 - Original beta release
 Revision 0.2.0:
 - Added manual flush control radio box on page admin
 */

add_action('admin_menu', 'yd_register_rewrite_bypass');

function yd_register_rewrite_bypass() {
	remove_action( 'save_post', '_save_post_hook', 5, 2 );
	add_action( 'save_post', 'yd_save_post_hook', 5, 2 );
	add_action( 'pre_post_update', 'yd_get_prev_post_data', 5, 1 );
}

function yd_get_prev_post_data( $post_ID ) {
	// need to store the previous post name and parent
	// to decide if reconstructing rewriterules is necessary
	// I store this in globals for now: I know it's ugly but hey, it's quick and efficient.
	global $yd_prev_post_name;
	global $yd_prev_post_parent;
	$yd_prev_post_name = get_post_field( 'post_name', $post_ID );
	$yd_prev_post_parent = get_post_field( 'post_parent', $post_ID );
}

function yd_save_post_hook($post_id, $post) {
	if ( $post->post_type == 'page' ) {
		clean_page_cache($post_id);
		
		//YD: Avoid flushing rules if previous post name and parent are the same
		//TODO: Also avoid flushing as long as we're draft/unpublished
		global $yd_prev_post_name;
		global $yd_prev_post_parent;
		$yd_fpu_status = get_option( 'yd_fpu_status' );
		if( 
			$yd_fpu_status == 'Forceflush' || (
			$yd_fpu_status != 'Noflush' && (
			$post->post_name != $yd_prev_post_name ||
			$post->post_parent != $yd_prev_post_parent ) )
		) {
			// Avoid flushing rules for every post during import.
			if ( !defined('WP_IMPORTING') ) {
				global $wp_rewrite;
				$wp_rewrite->flush_rules(false);
				//TODO: maybe invent some selective flush method
			}
		}
	} else {
		clean_post_cache($post_id);
	}
}

function yd_fpu_register_custom_box() {
	if( function_exists( 'add_meta_box' ) ) {
		add_meta_box( 
			'yd_fpu_box', 
			__( 'Fast page update' ), 
            'yd_fpu_box', 
            'page', 
            'side',
			'high' 
		);
	}
}
add_action('admin_menu', 'yd_fpu_register_custom_box');

function yd_fpu_box() {
	$yd_fpu_status = get_option( 'yd_fpu_status' );
	echo '<input type="radio" id="yd_fpu_status" name="yd_fpu_status" value="Default" ';
	if( $yd_fpu_status == 'Default' || !$yd_fpu_status ) echo ' checked="checked" ';
	echo ' >Default';
	echo '<input type="radio" id="yd_fpu_status" name="yd_fpu_status" value="Noflush" ';
	if( $yd_fpu_status == 'Noflush' ) echo ' checked="checked" ';
	echo ' >No flush';
	echo '<input type="radio" id="yd_fpu_status" name="yd_fpu_status" value="Forceflush" ';
	if( $yd_fpu_status == 'Forceflush' ) echo ' checked="checked" ';
	echo ' >Force flush';
}

function yd_save_fpu_data( $post_id ) {
	if( isset( $_POST['yd_fpu_status'] ) && $_POST['yd_fpu_status'] !='' ) {
		update_option( 'yd_fpu_status', $_POST['yd_fpu_status'] );
	}
}
add_action( 'save_post', 'yd_save_fpu_data', 0 );

?>