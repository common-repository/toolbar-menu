<?php

/*
Plugin Name: Toolbar Menu
Plugin URI: http://wordpress.org/extend/plugins/toolbar-menu/
Description: Configure your Toolbar, don't remove it.
Version: 1.0.1
Author: Straightforward
Author URI: http://codecanyon.net/user/straightforward
*/

register_activation_hook  ( __FILE__, 'tlbrm_activation' );
register_deactivation_hook( __FILE__, 'tlbrm_deactivation' );
register_nav_menu( 'tlbrm_toolbar', 'Toolbar navigation menu' );

function tlbrm_activation() {
	add_option( 'tlbrm_show_guest_menu',           '1', '', 'yes' );
	add_option( 'tlbrm_show_guest_login_menu',     '1', '', 'yes' );

	add_option( 'tlbrm_show_wp_menu',              '0', '', 'yes' );
	add_option( 'tlbrm_show_my_sites_menu',        '1', '', 'yes' );
	add_option( 'tlbrm_show_site_menu',            '1', '', 'yes' );
	add_option( 'tlbrm_show_updates_menu',         '1', '', 'yes' );
	add_option( 'tlbrm_show_comments_menu',        '1', '', 'yes' );
	add_option( 'tlbrm_show_new_content_menu',     '1', '', 'yes' );
	add_option( 'tlbrm_show_edit_menu',            '1', '', 'yes' );
	add_option( 'tlbrm_show_add_secondary_groups', '1', '', 'yes' );
}

function tlbrm_deactivation() {
	delete_option( 'tlbrm_show_guest_menu' );
	delete_option( 'tlbrm_show_guest_login_menu' );

	delete_option( 'tlbrm_show_wp_menu' );
	delete_option( 'tlbrm_show_my_sites_menu' );
	delete_option( 'tlbrm_show_site_menu' );
	delete_option( 'tlbrm_show_updates_menu' );
	delete_option( 'tlbrm_show_comments_menu' );
	delete_option( 'tlbrm_show_new_content_menu' );
	delete_option( 'tlbrm_show_edit_menu' );
	delete_option( 'tlbrm_show_add_secondary_groups' );
}

function tlbrm_admin_init() {
	add_settings_section( 'tlbrm_settings', 'Toolbar Menu', 'tlbrm_render_general_description', 'general' );

	add_settings_field( 'tlbrm_show_guest_menu', 'Guest Menu', 'tlbrm_guest_menu_options', 'general', 'tlbrm_settings' );
	register_setting( 'general', 'tlbrm_show_guest_menu',       'intval' );
	register_setting( 'general', 'tlbrm_show_guest_login_menu', 'intval' );

	add_settings_field( 'tlbrm_show_wp_menu', 'Show WordPress Menu', 'tlbrm_wp_menu_options', 'general', 'tlbrm_settings' );
	register_setting( 'general', 'tlbrm_show_wp_menu',              'intval' );
	register_setting( 'general', 'tlbrm_show_site_menu',            'intval' );
	register_setting( 'general', 'tlbrm_show_updates_menu',         'intval' );
	register_setting( 'general', 'tlbrm_show_comments_menu',        'intval' );
	register_setting( 'general', 'tlbrm_show_new_content_menu',     'intval' );
	register_setting( 'general', 'tlbrm_show_edit_menu',            'intval' );
	register_setting( 'general', 'tlbrm_show_add_secondary_groups', 'intval' );
	if ( is_multisite() ) {
		register_setting( 'general', 'tlbrm_show_my_sites_menu', 'intval' );
	}
}

function tlbrm_render_general_description() {
	echo '<p>The <a name="toolbar-menu">Toolbar Menu</a> plugin allows you to deactivate default WordPress menu. To do it uncheck options which you don\'t need.</p>';
}

function tlbrm_guest_menu_options() {
	printf(
		'<input type="checkbox" id="%1$s" name="%1$s" value="1" %2$s/> <label for="%1$s">%3$s</label><br/>',
		'tlbrm_show_guest_menu',
		checked( 1, get_option( 'tlbrm_show_guest_menu' ), false ),
		'Enabled'
	);

	printf(
		'<input type="checkbox" id="%1$s" name="%1$s" value="1" %2$s/> <label for="%1$s">%3$s</label><br/>',
		'tlbrm_show_guest_login_menu',
		checked( 1, get_option( 'tlbrm_show_guest_login_menu' ), false ),
		'Show login form'
	);
}

function tlbrm_wp_menu_options() {
    printf(
		'<input type="checkbox" id="%1$s" name="%1$s" value="1" %2$s/> <label for="%1$s">%3$s</label><br/>',
		'tlbrm_show_wp_menu',
		checked( 1, get_option( 'tlbrm_show_wp_menu' ), false ),
		'The "WordPress logo" menu'
	);

	if ( is_multisite() ) {
		printf(
			'<input type="checkbox" id="%1$s" name="%1$s" value="1" %2$s/> <label for="%1$s">%3$s</label><br/>',
			'tlbrm_show_my_sites_menu',
			checked( 1, get_option( 'tlbrm_show_my_sites_menu' ), false ),
			'The "My Sites/[Site Name]" menu and all submenus'
		);
	}

    printf(
		'<input type="checkbox" id="%1$s" name="%1$s" value="1" %2$s/> <label for="%1$s">%3$s</label><br/>',
		'tlbrm_show_site_menu',
		checked( 1, get_option( 'tlbrm_show_site_menu' ), false ),
		'The "Site Name" menu'
	);

    printf(
		'<input type="checkbox" id="%1$s" name="%1$s" value="1" %2$s/> <label for="%1$s">%3$s</label><br/>',
		'tlbrm_show_updates_menu',
		checked( 1, get_option( 'tlbrm_show_updates_menu' ), false ),
		'The "Updates" menu'
	);

    printf(
		'<input type="checkbox" id="%1$s" name="%1$s" value="1" %2$s/> <label for="%1$s">%3$s</label><br/>',
		'tlbrm_show_comments_menu',
		checked( 1, get_option( 'tlbrm_show_comments_menu' ), false ),
		'The "Comments" menu'
	);

    printf(
		'<input type="checkbox" id="%1$s" name="%1$s" value="1" %2$s/> <label for="%1$s">%3$s</label><br/>',
		'tlbrm_show_new_content_menu',
		checked( 1, get_option( 'tlbrm_show_new_content_menu' ), false ),
		'The "New Content" menu'
	);

    printf(
		'<input type="checkbox" id="%1$s" name="%1$s" value="1" %2$s/> <label for="%1$s">%3$s</label><br/>',
		'tlbrm_show_edit_menu',
		checked( 1, get_option( 'tlbrm_show_edit_menu' ), false ),
		'The "Edit" menu'
	);

	printf(
		'<input type="checkbox" id="%1$s" name="%1$s" value="1" %2$s/> <label for="%1$s">%3$s</label><br/>',
		'tlbrm_show_add_secondary_groups',
		checked( 1, get_option( 'tlbrm_show_add_secondary_groups' ), false ),
		'The "Secondary" menu (user account)'
	);
}

function tlbrm_admin_bar() {
	global $wp_admin_bar;

	if ( !( $locations = get_nav_menu_locations() ) || !isset( $locations['tlbrm_toolbar'] ) ) {
		return;
	}

	$menu = wp_get_nav_menu_object( $locations['tlbrm_toolbar'] );
	if ( !$menu ) {
		return;
	}

	$menu_items = array();
	foreach ( (array) wp_get_nav_menu_items( $menu->term_id ) as $menu_item ) {
		$menu_items[$menu_item->menu_order] = $menu_item;
	}

	ksort( $menu_items, SORT_NUMERIC );
	$added_menu_items = array();
	do {
		$added = false;
		foreach( $menu_items as $order => $menu_item ) {
			if ( $menu_item->menu_item_parent == 0 ) {
				$wp_admin_bar->add_menu( array(
					'id'     => 'tlbrm-' . $menu_item->ID,
					'title'  => $menu_item->title,
					'href'   => $menu_item->url,
					'meta'   => array(
						'target' => $menu_item->target,
						'title'  => $menu_item->attr_title,
						'class'  => implode( ' ', $menu_item->classes ),
					),
				) );
				$added_menu_items[] = $menu_item->ID;
				$added = true;
				unset( $menu_items[$order] );
			} else if ( in_array( $menu_item->menu_item_parent, $added_menu_items ) ) {
				$wp_admin_bar->add_menu( array(
					'id'     => 'tlbrm-' . $menu_item->ID,
					'parent' => 'tlbrm-' . $menu_item->menu_item_parent,
					'title'  => $menu_item->title,
					'href'   => $menu_item->url,
					'meta'   => array(
						'target' => $menu_item->target,
						'title'  => $menu_item->attr_title,
						'class'  => implode( ' ', $menu_item->classes ),
					),
				) );
				$added_menu_items[] = $menu_item->ID;
				$added = true;
				unset( $menu_items[$order] );
			}
		}
	} while( count( $menu_items ) > 0 && $added );

	if ( !is_user_logged_in() && get_option( 'tlbrm_show_guest_login_menu' ) ) {
		$wp_admin_bar->add_group( array(
			'id'     => 'tlbrm_login_group',
			'meta'   => array(
				'class' => 'ab-top-secondary',
			),
		) );

		$wp_admin_bar->add_menu( array(
			'id'     => 'tlbrm_login_form_wrapper',
			'parent' => 'tlbrm_login_group',
			'title'  => 'Log In',
		) );

		$form  = '<form action="' . esc_url( home_url( '/wp-login.php' ) ) . '" method="post" style="padding:0 30px;">';
		$form .= '<input id="log" name="log" type="text" tabindex="70" size="30" style="text-shadow:none;color:black;"/><br/>';

		$wp_admin_bar->add_menu( array(
			'parent' => 'tlbrm_login_form_wrapper',
			'id'     => 'tlbrm_login_form_username',
			'title'  => '<label for="log" style="text-shadow:none;color: #777;font-weight:bold;padding:0 18px;">Username</label>',
			'meta'   => array(
				'tabindex' => -1,
				'html' => $form,
			),
		) );

		$wp_admin_bar->add_menu( array(
			'parent' => 'tlbrm_login_form_wrapper',
			'id'     => 'tlbrm_login_form_password',
			'title'  => '<label for="pwd" style="text-shadow:none;color: #777;font-weight:bold;padding:0 18px;">Password</label>',
			'meta'   => array(
				'tabindex' => -1,
				'html' => '<input id="pwd" name="pwd" type="password" tabindex="80" size="30" style="text-shadow:none;color:black;margin:0 30px;"/>',
			),
		) );

		$wp_admin_bar->add_menu( array(
			'parent' => 'tlbrm_login_form_wrapper',
			'id'     => 'tlbrm_login_form_remember',
			'title' =>
					'<div style="padding:5px 18px;"><label for="rememberme" style="text-shadow:none;color:black;"><input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="90"> Remember Me</label>' .
					'<input type="submit" class="button-primary" name="wp-submit" value="' . __( 'Log In' ) . '" tabindex="100" style="text-shadow:none;color:black;float:right;padding:3px;"/></div>',
			'meta'   => array(
				'tabindex' => -1,
				'html' => '<div style="clear:both"></div></form>',
			),
		) );
	}
}

function tlbrm_disable_wp_menu() {
	if ( !get_option( 'tlbrm_show_wp_menu' ) ) {
		remove_action( 'admin_bar_menu', 'wp_admin_bar_wp_menu' );
	}

	if ( !get_option( 'tlbrm_show_my_sites_menu' ) ) {
		remove_action( 'admin_bar_menu', 'wp_admin_bar_my_sites_menu', 20 );
	}

	if ( !get_option( 'tlbrm_show_site_menu' ) ) {
		remove_action( 'admin_bar_menu', 'wp_admin_bar_site_menu', 30 );
	}

	if ( !get_option( 'tlbrm_show_updates_menu' ) ) {
		remove_action( 'admin_bar_menu', 'wp_admin_bar_updates_menu', 40 );
	}

	if ( !get_option( 'tlbrm_show_comments_menu' ) ) {
		remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
	}

	if ( !get_option( 'tlbrm_show_new_content_menu' ) ) {
		remove_action( 'admin_bar_menu', 'wp_admin_bar_new_content_menu', 70 );
	}

	if ( !get_option( 'tlbrm_show_edit_menu' ) ) {
		remove_action( 'admin_bar_menu', 'wp_admin_bar_edit_menu', 80 );
	}

	if ( !get_option( 'tlbrm_show_add_secondary_groups' ) ) {
		remove_action( 'admin_bar_menu', 'wp_admin_bar_add_secondary_groups', 200 );
	}
}

function tlbrm_show_guest_admin_bar( $show_admin_bar ) {
	if ( !is_user_logged_in() && get_option( 'tlbrm_show_guest_menu' ) ) {
		return true;
	}
	return $show_admin_bar;
}

function tlbrm_action_links( $links, $file ) {
	if ( $file == plugin_basename( __FILE__ ) ) {
		array_unshift(
			$links,
			sprintf( '<a href="%s#toolbar-menu">%s</a>', admin_url( '/options-general.php' ),  __( "Settings" ) )
		);
	}
	return $links;
}

add_action( 'admin_init',     'tlbrm_admin_init' );
add_action( 'admin_bar_menu', 'tlbrm_admin_bar', 999 );
add_action( 'init',   'tlbrm_disable_wp_menu', 999 );

add_filter( 'show_admin_bar',      'tlbrm_show_guest_admin_bar' );
add_filter( 'plugin_action_links', 'tlbrm_action_links', 10, 2 );