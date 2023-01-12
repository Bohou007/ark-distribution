<?php
/**
 * Class for the Customizer
 *
 * @package thebase
 */

namespace TheBase;

use function TheBase\thebase;

/**
 * Mobile Navigation
 */
function mobile_secondary_navigation() {
	?>
	<nav id="mobile-secondary-site-navigation" class="mobile-navigation mobile-secondary-navigation drawer-navigation drawer-navigation-parent-toggle-<?php echo esc_attr( thebase()->option( 'mobile_secondary_navigation_parent_toggle' ) ? 'true' : 'false' ); ?>"  aria-label="<?php esc_attr_e( 'Secondary Mobile Navigation', 'gadgeto' ); ?>">
		<?php thebase()->customizer_quick_link(); ?>
		<div class="mobile-menu-container drawer-menu-container">
			<?php
			if ( has_nav_menu( 'mobile-secondary' ) ) {
				$args = array(
					'container'      => 'ul',
					'theme_location' => 'mobile-secondary',
					'menu_id'        => 'mobile-secondary-menu',
					'menu_class'     => ( thebase()->option( 'mobile_secondary_navigation_collapse' ) ? 'menu has-collapse-sub-nav' : 'menu' ),
					'sub_arrows'     => false,
					'show_toggles'   => ( thebase()->option( 'mobile_secondary_navigation_collapse' ) ? true : false ),
					'addon_support'  => true,
					'mega_support'   => false,
				);
				wp_nav_menu( $args );
			}
			?>
		</div>
	</nav><!-- #site-navigation -->
	<?php
}
add_action( 'thebase_mobile_secondary_navigation', 'TheBase\mobile_secondary_navigation' );

/**
 * Desktop Navigation
 */
function tertiary_navigation() {
	?>
	<nav id="tertiary-navigation" class="tertiary-navigation header-navigation nav--toggle-sub header-navigation-style-<?php echo esc_attr( thebase()->option( 'tertiary_navigation_style' ) ); ?> header-navigation-dropdown-animation-<?php echo esc_attr( thebase()->option( 'dropdown_navigation_reveal' ) ); ?>" aria-label="<?php esc_attr_e( 'Menu', 'gadgeto' ); ?>">
		<?php if ( is_customize_preview() ) { ?>
			<div class="customize-partial-edit-shortcut base-custom-partial-edit-shortcut">
				<button aria-label="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" title="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" class="customize-partial-edit-shortcut-button item-customizer-focus"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13.89 3.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58s7.6-7.63 7.99-8.03c.39-.39 1.22-.39 1.68.07zm-2.73 2.79l-5.59 5.61 1.11 1.11 5.54-5.65zm-2.97 8.23l5.58-5.6-1.07-1.08-5.59 5.6z"></path></svg></button>
			</div>
		<?php } ?>
		<div class="tertiary-menu-container header-menu-container">
			<?php
			if ( has_nav_menu( 'tertiary' ) ) {
				$args = array(
					'container'      => 'ul',
					'theme_location' => 'tertiary',
					'menu_id'        => 'tertiary-menu',
					'sub_arrows'     => true,
					'mega_support'   => true,
					'addon_support'  => true,
				);
				wp_nav_menu( $args );
			} else {
				thebase()->display_fallback_menu();
			}
			?>
		</div>
	</nav><!-- #tertiary-navigation -->
	<?php
}
add_action( 'thebase_tertiary_navigation', 'TheBase\tertiary_navigation', 10 );

/**
 * Desktop Navigation
 */
function quaternary_navigation() {
	?>
	<nav id="quaternary-navigation" class="quaternary-navigation header-navigation nav--toggle-sub header-navigation-style-<?php echo esc_attr( thebase()->option( 'quaternary_navigation_style' ) ); ?> header-navigation-dropdown-animation-<?php echo esc_attr( thebase()->option( 'dropdown_navigation_reveal' ) ); ?>" aria-label="<?php esc_attr_e( 'Menu', 'gadgeto' ); ?>">
		<?php if ( is_customize_preview() ) { ?>
			<div class="customize-partial-edit-shortcut base-custom-partial-edit-shortcut">
				<button aria-label="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" title="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" class="customize-partial-edit-shortcut-button item-customizer-focus"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13.89 3.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58s7.6-7.63 7.99-8.03c.39-.39 1.22-.39 1.68.07zm-2.73 2.79l-5.59 5.61 1.11 1.11 5.54-5.65zm-2.97 8.23l5.58-5.6-1.07-1.08-5.59 5.6z"></path></svg></button>
			</div>
		<?php } ?>
		<div class="quaternary-menu-container header-menu-container">
			<?php
			if ( has_nav_menu( 'quaternary' ) ) {
				$args = array(
					'container' => 'ul',
					'theme_location' => 'quaternary',
					'menu_id' => 'quaternary-menu',
					'sub_arrows'     => true,
					'mega_support'   => true,
					'addon_support'  => true,
				);
				wp_nav_menu( $args );
			} else {
				thebase()->display_fallback_menu();
			}
			?>
		</div>
	</nav><!-- #quaternary-navigation -->
	<?php
}
add_action( 'thebase_quaternary_navigation', 'TheBase\quaternary_navigation', 10 );

/**
 * Desktop HTML2
 */
function header_html2() {
	$content = thebase()->option( 'header_html2_content' );
	if ( $content || is_customize_preview() ) {
		$link_style = thebase()->option( 'header_html2_link_style' );
		$wpautop    = thebase()->option( 'header_html2_wpautop' );
		echo '<div class="header-html2 inner-link-style-' . esc_attr( $link_style ) . '">';
		if ( is_customize_preview() ) {
			?>
			<div class="customize-partial-edit-shortcut base-custom-partial-edit-shortcut">
				<button aria-label="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" title="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" class="customize-partial-edit-shortcut-button item-customizer-focus"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13.89 3.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58s7.6-7.63 7.99-8.03c.39-.39 1.22-.39 1.68.07zm-2.73 2.79l-5.59 5.61 1.11 1.11 5.54-5.65zm-2.97 8.23l5.58-5.6-1.07-1.08-5.59 5.6z"></path></svg></button>
			</div>
			<?php
		}
		echo '<div class="header-html-inner">';
		if ( $wpautop ) {
			echo do_shortcode( wpautop( $content ) );
		} else {
			echo do_shortcode( $content );
		}
		echo '</div>';
		echo '</div>';
	}
}
add_action( 'thebase_header_html2', 'TheBase\header_html2', 10 );

/**
 * Header Search Bar
 */
function header_search_bar() {
	echo '<div class="header-search-bar header-item-search-bar">';
	if ( is_customize_preview() ) {
		?>
		<div class="customize-partial-edit-shortcut base-custom-partial-edit-shortcut">
			<button aria-label="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" title="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" class="customize-partial-edit-shortcut-button item-customizer-focus"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13.89 3.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58s7.6-7.63 7.99-8.03c.39-.39 1.22-.39 1.68.07zm-2.73 2.79l-5.59 5.61 1.11 1.11 5.54-5.65zm-2.97 8.23l5.58-5.6-1.07-1.08-5.59 5.6z"></path></svg></button>
		</div>
		<?php
	}
	if ( class_exists( 'woocommerce' ) && thebase()->option( 'header_search_bar_woo' ) ) {
		get_product_search_form();
	} else {
		get_search_form();
	}
	echo '</div>';
}
add_action( 'thebase_header_search_bar', 'TheBase\header_search_bar', 10 );

/**
 * Header Mobile Search Bar
 */
function header_mobile_search_bar() {
	echo '<div class="header-mobile-search-bar header-item-search-bar">';
	if ( is_customize_preview() ) {
		?>
		<div class="customize-partial-edit-shortcut base-custom-partial-edit-shortcut">
			<button aria-label="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" title="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" class="customize-partial-edit-shortcut-button item-customizer-focus"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13.89 3.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58s7.6-7.63 7.99-8.03c.39-.39 1.22-.39 1.68.07zm-2.73 2.79l-5.59 5.61 1.11 1.11 5.54-5.65zm-2.97 8.23l5.58-5.6-1.07-1.08-5.59 5.6z"></path></svg></button>
		</div>
		<?php
	}
	if ( class_exists( 'woocommerce' ) && thebase()->option( 'header_mobile_search_bar_woo' ) ) {
		get_product_search_form();
	} else {
		get_search_form();
	}
	echo '</div>';
}
add_action( 'thebase_header_mobile_search_bar', 'TheBase\header_mobile_search_bar', 10 );

/**
 * Header Divider
 */
function header_divider() {
	echo '<div class="header-divider">';
	if ( is_customize_preview() ) {
		?>
		<div class="customize-partial-edit-shortcut base-custom-partial-edit-shortcut">
			<button aria-label="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" title="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" class="customize-partial-edit-shortcut-button item-customizer-focus"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13.89 3.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58s7.6-7.63 7.99-8.03c.39-.39 1.22-.39 1.68.07zm-2.73 2.79l-5.59 5.61 1.11 1.11 5.54-5.65zm-2.97 8.23l5.58-5.6-1.07-1.08-5.59 5.6z"></path></svg></button>
		</div>
		<?php
	}
	echo '</div>';
}
add_action( 'thebase_header_divider', 'TheBase\header_divider', 10 );

/**
 * Header Divider2
 */
function header_divider2() {
	echo '<div class="header-divider2">';
	if ( is_customize_preview() ) {
		?>
		<div class="customize-partial-edit-shortcut base-custom-partial-edit-shortcut">
			<button aria-label="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" title="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" class="customize-partial-edit-shortcut-button item-customizer-focus"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13.89 3.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58s7.6-7.63 7.99-8.03c.39-.39 1.22-.39 1.68.07zm-2.73 2.79l-5.59 5.61 1.11 1.11 5.54-5.65zm-2.97 8.23l5.58-5.6-1.07-1.08-5.59 5.6z"></path></svg></button>
		</div>
		<?php
	}
	echo '</div>';
}
add_action( 'thebase_header_divider2', 'TheBase\header_divider2', 10 );

/**
 * Header Divider3
 */
function header_divider3() {
	echo '<div class="header-divider3">';
	if ( is_customize_preview() ) {
		?>
		<div class="customize-partial-edit-shortcut base-custom-partial-edit-shortcut">
			<button aria-label="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" title="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" class="customize-partial-edit-shortcut-button item-customizer-focus"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13.89 3.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58s7.6-7.63 7.99-8.03c.39-.39 1.22-.39 1.68.07zm-2.73 2.79l-5.59 5.61 1.11 1.11 5.54-5.65zm-2.97 8.23l5.58-5.6-1.07-1.08-5.59 5.6z"></path></svg></button>
		</div>
		<?php
	}
	echo '</div>';
}
add_action( 'thebase_header_divider3', 'TheBase\header_divider3', 10 );

/**
 * Mobile Header Divider
 */
function header_mobile_divider() {
	echo '<div class="header-mobile-divider">';
	if ( is_customize_preview() ) {
		?>
		<div class="customize-partial-edit-shortcut base-custom-partial-edit-shortcut">
			<button aria-label="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" title="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" class="customize-partial-edit-shortcut-button item-customizer-focus"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13.89 3.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58s7.6-7.63 7.99-8.03c.39-.39 1.22-.39 1.68.07zm-2.73 2.79l-5.59 5.61 1.11 1.11 5.54-5.65zm-2.97 8.23l5.58-5.6-1.07-1.08-5.59 5.6z"></path></svg></button>
		</div>
		<?php
	}
	echo '</div>';
}
add_action( 'thebase_header_mobile_divider', 'TheBase\header_mobile_divider', 10 );

/**
 * Mobile Header Divider 2
 */
function header_mobile_divider2() {
	echo '<div class="header-mobile-divider2">';
	if ( is_customize_preview() ) {
		?>
		<div class="customize-partial-edit-shortcut base-custom-partial-edit-shortcut">
			<button aria-label="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" title="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" class="customize-partial-edit-shortcut-button item-customizer-focus"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13.89 3.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58s7.6-7.63 7.99-8.03c.39-.39 1.22-.39 1.68.07zm-2.73 2.79l-5.59 5.61 1.11 1.11 5.54-5.65zm-2.97 8.23l5.58-5.6-1.07-1.08-5.59 5.6z"></path></svg></button>
		</div>
		<?php
	}
	echo '</div>';
}
add_action( 'thebase_header_mobile_divider2', 'TheBase\header_mobile_divider2', 10 );

/**
 * Mobile HTML2
 */
function header_mobile_html2() {
	$content = thebase()->option( 'header_mobile_html2_content' );
	if ( $content || is_customize_preview() ) {
		$link_style = thebase()->option( 'header_mobile_html2_link_style' );
		$wpautop    = thebase()->option( 'header_mobile_html2_wpautop' );
		echo '<div class="mobile-html2 inner-link-style-' . esc_attr( $link_style ) . '">';
		if ( is_customize_preview() ) {
			?>
			<div class="customize-partial-edit-shortcut base-custom-partial-edit-shortcut">
				<button aria-label="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" title="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" class="customize-partial-edit-shortcut-button item-customizer-focus"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13.89 3.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58s7.6-7.63 7.99-8.03c.39-.39 1.22-.39 1.68.07zm-2.73 2.79l-5.59 5.61 1.11 1.11 5.54-5.65zm-2.97 8.23l5.58-5.6-1.07-1.08-5.59 5.6z"></path></svg></button>
			</div>
			<?php
		}
		echo '<div class="header-html-inner">';
		if ( $wpautop ) {
			echo do_shortcode( wpautop( $content ) );
		} else {
			echo do_shortcode( $content );
		}
		echo '</div>';
		echo '</div>';
	}
}
add_action( 'thebase_header_mobile_html2', 'TheBase\header_mobile_html2', 10 );

/**
 * Desktop Account
 */
function header_account() {
	if ( ! is_user_logged_in() || ( is_customize_preview() && 'out' === thebase()->option( 'header_account_preview' ) ) ) {
		$label  = thebase()->option( 'header_account_label' );		
		$action = thebase()->option( 'header_account_action' );
		$style  = thebase()->option( 'header_account_style' );
		$icon   = thebase()->option( 'header_account_icon', 'account' );
		echo '<div class="header-account-wrap header-account-control-wrap header-account-action-' . esc_attr( $action ) . ' header-account-style-' . esc_attr( $style ) . '">';
		if ( is_customize_preview() ) {
			?>
			<div class="customize-partial-edit-shortcut base-custom-partial-edit-shortcut">
				<button aria-label="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" title="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" class="customize-partial-edit-shortcut-button item-customizer-focus"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13.89 3.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58s7.6-7.63 7.99-8.03c.39-.39 1.22-.39 1.68.07zm-2.73 2.79l-5.59 5.61 1.11 1.11 5.54-5.65zm-2.97 8.23l5.58-5.6-1.07-1.08-5.59 5.6z"></path></svg></button>
			</div>
			<?php
		}
		if ( 'link' === $action ) {
			echo '<a href="' . ( thebase()->option( 'header_account_link' ) ? esc_url( thebase()->option( 'header_account_link' ) ) : '#' ) . '"' . ( ! empty( $label ) ? '' : ' aria-label="' . esc_attr__( 'Account', 'gadgeto' ) . '"' ) . ' class="header-account-button">';
			switch ( $style ) {
				case 'icon':
					thebase()->print_icon( $icon, '', false );
					break;
				case 'label':
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					break;
				case 'icon_label':
					thebase()->print_icon( $icon, '', false );
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					break;
				case 'label_icon':
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					thebase()->print_icon( $icon, '', false );
					break;
			}
			echo '</a>';
		} elseif ( 'dropdown' === $action ) {
			echo '<nav id="account-navigation" class="account-navigation header-navigation nav--toggle-sub header-navigation-style-standard header-navigation-dropdown-animation-' . esc_attr( thebase()->option( 'dropdown_navigation_reveal' ) ) . ' header-navigation-dropdown-direction-' . esc_attr( thebase()->option( 'header_account_dropdown_direction' ) ) . '" aria-label="Account Menu">';
			echo '<div class="account-menu-container header-menu-container">';
			echo '<ul id="account-menu" class="menu">';
			echo '<li class="menu-item menu-account-item menu-item-has-children">';
			echo '<a href="' . ( thebase()->option( 'header_account_link' ) ? esc_url( thebase()->option( 'header_account_link' ) ) : '#' ) . '"' . ( ! empty( $label ) ? '' : ' aria-label="' . esc_attr__( 'Account', 'gadgeto' ) . '"' ) . ' class="header-account-button">';
			echo '<span class="nav-drop-title-wrap">';
			switch ( $style ) {
				case 'icon':
					thebase()->print_icon( $icon, '', false );
					break;
				case 'label':
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					break;
				case 'icon_label':
					thebase()->print_icon( $icon, '', false );
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					break;
				case 'label_icon':
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					thebase()->print_icon( $icon, '', false );
					break;
			}
			echo '<span class="dropdown-nav-toggle" role="button" aria-pressed="false" aria-label="' . esc_attr__( 'Expand child menu', 'gadgeto' ) . '">' . thebase()->get_icon( 'arrow-down' ) . '</span></span>';
			echo '</span>';
			echo '</a>';
			if ( has_nav_menu( 'account' ) ) {
				$args = array(
					'menu_class'     => 'sub-menu',
					'container'      => 'ul',
					'theme_location' => 'account',
					'sub_arrows'     => true,
					'addon_support'  => true,
				);
				wp_nav_menu( $args );
			}
			echo '</li>';
			echo '</ul>';
			echo '</div>';
			echo '</nav>';
		} elseif ( 'modal' === $action ) {
			add_action( 'wp_footer', 'TheBase\account_popup', 5 );
			echo '<button data-toggle-target="#login-drawer"' . ( ! empty( $label ) ? '' : ' aria-label="' . esc_attr__( 'Login', 'gadgeto' ) . '"' ) . ' class="drawer-toggle header-account-button" data-toggle-body-class="showing-popup-drawer" aria-expanded="false" data-set-focus=".login-toggle-close">';
			switch ( $style ) {
				case 'icon':
					thebase()->print_icon( $icon, '', false );
					break;
				case 'label':
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					break;
				case 'icon_label':
					thebase()->print_icon( $icon, '', false );
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					break;
				case 'label_icon':
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					thebase()->print_icon( $icon, '', false );
					break;
			}
			echo '</button>';
		}
		echo '</div>';
	} else if ( ! is_customize_preview() || ( is_customize_preview() && 'in' === thebase()->option( 'header_account_preview' ) ) ) {
		$label  = thebase()->option( 'header_account_in_label' );
		$action = thebase()->option( 'header_account_in_action' );
		$style  = thebase()->option( 'header_account_in_style' );
		$icon   = thebase()->option( 'header_account_in_icon', 'account' );
		echo '<div class="header-account-in-wrap header-account-control-wrap header-account-action-' . esc_attr( $action ) . ' header-account-style-' . esc_attr( $style ) . '">';
		if ( is_customize_preview() ) {
			?>
			<div class="customize-partial-edit-shortcut base-custom-partial-edit-shortcut">
				<button aria-label="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" title="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" class="customize-partial-edit-shortcut-button item-customizer-focus"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13.89 3.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58s7.6-7.63 7.99-8.03c.39-.39 1.22-.39 1.68.07zm-2.73 2.79l-5.59 5.61 1.11 1.11 5.54-5.65zm-2.97 8.23l5.58-5.6-1.07-1.08-5.59 5.6z"></path></svg></button>
			</div>
			<?php
		}
		if ( 'link' === $action ) {
			echo '<a href="' . ( thebase()->option( 'header_account_in_link' ) ? esc_url( thebase()->option( 'header_account_in_link' ) ) : '#' ) . '"' . ( ! empty( $label ) ? '' : ' aria-label="' . esc_attr__( 'Account', 'gadgeto' ) . '"' ) . ' class="header-account-button">';
			switch ( $style ) {
				case 'icon':
					thebase()->print_icon( $icon, '', false );
					break;
				case 'label':
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					break;
				case 'icon_label':
					thebase()->print_icon( $icon, '', false );
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					break;
				case 'label_icon':
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					thebase()->print_icon( $icon, '', false );
					break;
				case 'user_label':
					$size         = thebase()->option( 'header_account_in_icon_size' );
					if ( 'px' !== $size['unit'] ) {
						$image_size = floor( 17 * $size['size'] );
					} else {
						$image_size = $size['size'];
					}
					$current_user = wp_get_current_user();
					?>
						<span class="header-account-avatar"><?php echo get_avatar( $current_user->ID, $image_size ); ?></span>
					<?php
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					break;
				case 'label_user':
					$size         = thebase()->option( 'header_account_in_icon_size' );
					if ( 'px' !== $size['unit'] ) {
						$image_size = floor( 17 * $size['size'] );
					} else {
						$image_size = $size['size'];
					}
					$current_user = wp_get_current_user();
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					?>
						<span class="header-account-avatar"><?php echo get_avatar( $current_user->ID, $image_size ); ?></span>
					<?php
					break;
				case 'user_name':
					$size         = thebase()->option( 'header_account_in_icon_size' );
					if ( 'px' !== $size['unit'] ) {
						$image_size = floor( 17 * $size['size'] );
					} else {
						$image_size = $size['size'];
					}
					$current_user = wp_get_current_user();
					?>
					<span class="header-account-avatar"><?php echo get_avatar( $current_user->ID, $image_size ); ?></span>
					<span class="header-account-username"><?php echo esc_html( $current_user->display_name ); ?>
					<?php
					break;
				case 'name_user':
					$size         = thebase()->option( 'header_account_in_icon_size' );
					if ( 'px' !== $size['unit'] ) {
						$image_size = floor( 17 * $size['size'] );
					} else {
						$image_size = $size['size'];
					}
					$current_user = wp_get_current_user();
					?>
					<span class="header-account-username"><?php echo esc_html( $current_user->display_name ); ?>
					<span class="header-account-avatar"><?php echo get_avatar( $current_user->ID, $image_size ); ?></span>
					<?php
					break;
				case 'icon_name':
					$current_user = wp_get_current_user();
					thebase()->print_icon( $icon, '', false );
					?>
					<span class="header-account-username"><?php echo esc_html( $current_user->display_name ); ?>
					<?php
					break;
				case 'name_icon':
					$current_user = wp_get_current_user();
					?>
					<span class="header-account-username"><?php echo esc_html( $current_user->display_name ); ?>
					<?php
					thebase()->print_icon( $icon, '', false );
					break;
			}
			echo '</a>';
		} elseif ( 'dropdown' === $action ) {
			$dropdown = thebase()->option( 'header_account_in_dropdown_source' );
			echo '<nav id="account-navigation" class="account-navigation header-navigation nav--toggle-sub header-navigation-style-standard header-navigation-dropdown-animation-' . esc_attr( thebase()->option( 'dropdown_navigation_reveal' ) ) . ' header-navigation-dropdown-direction-' . esc_attr( thebase()->option( 'header_account_in_dropdown_direction' ) ) . '" aria-label="Account Menu">';
			echo '<div class="account-menu-container header-menu-container">';
			echo '<ul id="account-menu" class="menu">';
			echo '<li class="menu-item menu-account-item menu-item-has-children">';
			echo '<a href="' . ( thebase()->option( 'header_account_in_link' ) ? esc_url( thebase()->option( 'header_account_in_link' ) ) : '#' ) . '"' . ( ! empty( $label ) ? '' : ' aria-label="' . esc_attr__( 'Account', 'gadgeto' ) . '"' ) . ' class="header-account-button">';
			echo '<span class="nav-drop-title-wrap">';
			switch ( $style ) {
				case 'icon':
					thebase()->print_icon( $icon, '', false );
					break;
				case 'label':
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					break;
				case 'icon_label':
					thebase()->print_icon( $icon, '', false );
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					break;
				case 'label_icon':
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					thebase()->print_icon( $icon, '', false );
					break;
				case 'user_label':
					$size         = thebase()->option( 'header_account_in_icon_size' );
					if ( 'px' !== $size['unit'] ) {
						$image_size = floor( 17 * $size['size'] );
					} else {
						$image_size = $size['size'];
					}
					$current_user = wp_get_current_user();
					?>
						<span class="header-account-avatar"><?php echo get_avatar( $current_user->ID, $image_size ); ?></span>
					<?php
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					break;
				case 'label_user':
					$size         = thebase()->option( 'header_account_in_icon_size' );
					if ( 'px' !== $size['unit'] ) {
						$image_size = floor( 17 * $size['size'] );
					} else {
						$image_size = $size['size'];
					}
					$current_user = wp_get_current_user();
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					?>
						<span class="header-account-avatar"><?php echo get_avatar( $current_user->ID, $image_size ); ?></span>
					<?php
					break;
				case 'user_name':
					$size = thebase()->option( 'header_account_in_icon_size' );
					if ( 'px' !== $size['unit'] ) {
						$image_size = floor( 17 * $size['size'] );
					} else {
						$image_size = $size['size'];
					}
					$current_user = wp_get_current_user();
					?>
					<span class="header-account-avatar"><?php echo get_avatar( $current_user->ID, $image_size ); ?></span>
					<span class="header-account-username"><?php echo esc_html( $current_user->display_name ); ?></span>
					<?php
					break;
				case 'name_user':
					$size = thebase()->option( 'header_account_in_icon_size' );
					if ( 'px' !== $size['unit'] ) {
						$image_size = floor( 17 * $size['size'] );
					} else {
						$image_size = $size['size'];
					}
					$current_user = wp_get_current_user();
					?>
					<span class="header-account-username"><?php echo esc_html( $current_user->display_name ); ?></span>
					<span class="header-account-avatar"><?php echo get_avatar( $current_user->ID, $image_size ); ?></span>
					<?php
					break;
				case 'icon_name':
					$current_user = wp_get_current_user();
					thebase()->print_icon( $icon, '', false );
					?>
					<span class="header-account-username"><?php echo esc_html( $current_user->display_name ); ?></span>
					<?php
					break;
				case 'name_icon':
					$current_user = wp_get_current_user();
					?>
					<span class="header-account-username"><?php echo esc_html( $current_user->display_name ); ?></span>
					<?php
					thebase()->print_icon( $icon, '', false );
					break;
			}
			echo '<span class="dropdown-nav-toggle" role="button" aria-pressed="false" aria-label="' . esc_attr__( 'Expand child menu', 'gadgeto' ) . '">' . thebase()->get_icon( 'arrow-down' ) . '</span></span>';
			echo '</span>';
			echo '</a>';
			switch ( $dropdown ) {
				case 'woocommerce':
					if ( class_exists( 'woocommerce' ) ) {
						?>
							<ul class="woocommerce-MyAccount-navigation submenu">
								<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
									<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
										<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php
					}
					break;
				case 'navigation':
					if ( has_nav_menu( 'inaccount' ) ) {
						$args = array(
							'menu_class'     => 'sub-menu',
							'container'      => 'ul',
							'theme_location' => 'inaccount',
							'sub_arrows'     => true,
							'addon_support'  => true,
						);
						wp_nav_menu( $args );
					}
					break;
			}
			echo '</li>';
			echo '</ul>';
			echo '</div>';
			echo '</nav>';
		}
		echo '</div>';
	}
}
add_action( 'thebase_header_account', 'TheBase\header_account', 10 );

/**
 * Mobile Account
 */
function header_mobile_account() {
	if ( ! is_user_logged_in() || ( is_customize_preview() && 'out' === thebase()->option( 'header_mobile_account_preview' ) ) ) {
		$label  = thebase()->option( 'header_mobile_account_label' );
		$action = thebase()->option( 'header_mobile_account_action' );
		$style  = thebase()->option( 'header_mobile_account_style' );
		$icon   = thebase()->option( 'header_mobile_account_icon', 'account' );
		echo '<div class="header-mobile-account-wrap header-account-control-wrap header-account-action-' . esc_attr( $action ) . ' header-account-style-' . esc_attr( $style ) . '">';
		if ( is_customize_preview() ) {
			?>
			<div class="customize-partial-edit-shortcut base-custom-partial-edit-shortcut">
				<button aria-label="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" title="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" class="customize-partial-edit-shortcut-button item-customizer-focus"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13.89 3.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58s7.6-7.63 7.99-8.03c.39-.39 1.22-.39 1.68.07zm-2.73 2.79l-5.59 5.61 1.11 1.11 5.54-5.65zm-2.97 8.23l5.58-5.6-1.07-1.08-5.59 5.6z"></path></svg></button>
			</div>
			<?php
		}
		if ( 'link' === $action ) {
			echo '<a href="' . ( thebase()->option( 'header_mobile_account_link' ) ? esc_url( thebase()->option( 'header_mobile_account_link' ) ) : '#' ) . '"' . ( ! empty( $label ) ? '' : ' aria-label="' . esc_attr__( 'Account', 'gadgeto' ) . '"' ) . ' class="header-account-button">';
			switch ( $style ) {
				case 'icon':
					thebase()->print_icon( $icon, '', false );
					break;
				case 'label':
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					break;
				case 'icon_label':
					thebase()->print_icon( $icon, '', false );
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					break;
				case 'label_icon':
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					thebase()->print_icon( $icon, '', false );
					break;
			}
			echo '</a>';
		} elseif ( 'modal' === $action ) {
			add_action( 'wp_footer', 'TheBase\account_popup', 5 );
			echo '<button data-toggle-target="#login-drawer"' . ( ! empty( $label ) ? '' : ' aria-label="' . esc_attr__( 'Login', 'gadgeto' ) . '"' ) . ' class="drawer-toggle header-account-button" data-toggle-body-class="showing-popup-drawer" aria-expanded="false" data-set-focus=".login-toggle-close">';
			switch ( $style ) {
				case 'icon':
					thebase()->print_icon( $icon, '', false );
					break;
				case 'label':
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					break;
				case 'icon_label':
					thebase()->print_icon( $icon, '', false );
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					break;
				case 'label_icon':
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					thebase()->print_icon( $icon, '', false );
					break;
			}
			echo '</button>';
		}
		echo '</div>';
	} else if ( ! is_customize_preview() || ( is_customize_preview() && 'in' === thebase()->option( 'header_mobile_account_preview' ) ) ) {
		$label  = thebase()->option( 'header_mobile_account_in_label' );
		$action = thebase()->option( 'header_mobile_account_in_action' );
		$style  = thebase()->option( 'header_mobile_account_in_style' );
		$icon   = thebase()->option( 'header_mobile_account_in_icon', 'account' );
		echo '<div class="header-mobile-account-in-wrap header-account-control-wrap header-account-action-' . esc_attr( $action ) . ' header-account-style-' . esc_attr( $style ) . '">';
		if ( is_customize_preview() ) {
			?>
			<div class="customize-partial-edit-shortcut base-custom-partial-edit-shortcut">
				<button aria-label="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" title="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" class="customize-partial-edit-shortcut-button item-customizer-focus"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13.89 3.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58s7.6-7.63 7.99-8.03c.39-.39 1.22-.39 1.68.07zm-2.73 2.79l-5.59 5.61 1.11 1.11 5.54-5.65zm-2.97 8.23l5.58-5.6-1.07-1.08-5.59 5.6z"></path></svg></button>
			</div>
			<?php
		}
		if ( 'link' === $action ) {
			echo '<a href="' . ( thebase()->option( 'header_mobile_account_in_link' ) ? esc_url( thebase()->option( 'header_mobile_account_in_link' ) ) : '#' ) . '"' . ( ! empty( $label ) ? '' : ' aria-label="' . esc_attr__( 'Account', 'gadgeto' ) . '"' ) . ' class="header-account-button">';
			switch ( $style ) {
				case 'icon':
					thebase()->print_icon( $icon, '', false );
					break;
				case 'label':
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					break;
				case 'icon_label':
					thebase()->print_icon( $icon, '', false );
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					break;
				case 'label_icon':
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					thebase()->print_icon( $icon, '', false );
					break;
				case 'user_label':
					$size         = thebase()->option( 'header_mobile_account_in_icon_size' );
					if ( 'px' !== $size['unit'] ) {
						$image_size = floor( 17 * $size['size'] );
					} else {
						$image_size = $size['size'];
					}
					$current_user = wp_get_current_user();
					?>
						<span class="header-account-avatar"><?php echo get_avatar( $current_user->ID, $image_size ); ?></span>
					<?php
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					break;
				case 'label_user':
					$size         = thebase()->option( 'header_mobile_account_in_icon_size' );
					if ( 'px' !== $size['unit'] ) {
						$image_size = floor( 17 * $size['size'] );
					} else {
						$image_size = $size['size'];
					}
					$current_user = wp_get_current_user();
					if ( ! empty( $label ) || is_customize_preview() ) {
						?>
						<span class="header-account-label"><?php echo esc_html( $label ); ?></span>
						<?php
					}
					?>
						<span class="header-account-avatar"><?php echo get_avatar( $current_user->ID, $image_size ); ?></span>
					<?php
					break;
				case 'user_name':
					$size         = thebase()->option( 'header_mobile_account_in_icon_size' );
					if ( 'px' !== $size['unit'] ) {
						$image_size = floor( 17 * $size['size'] );
					} else {
						$image_size = $size['size'];
					}
					$current_user = wp_get_current_user();
					?>
					<span class="header-account-avatar"><?php echo get_avatar( $current_user->ID, $image_size ); ?></span>
					<span class="header-account-username"><?php echo esc_html( $current_user->display_name ); ?>
					<?php
					break;
				case 'name_user':
					$size         = thebase()->option( 'header_mobile_account_in_icon_size' );
					if ( 'px' !== $size['unit'] ) {
						$image_size = floor( 17 * $size['size'] );
					} else {
						$image_size = $size['size'];
					}
					$current_user = wp_get_current_user();
					?>
					<span class="header-account-username"><?php echo esc_html( $current_user->display_name ); ?>
					<span class="header-account-avatar"><?php echo get_avatar( $current_user->ID, $image_size ); ?></span>
					<?php
					break;
			}
			echo '</a>';
		}
		echo '</div>';
	}
}
add_action( 'thebase_header_mobile_account', 'TheBase\header_mobile_account', 10 );

/**
 * Cart Popup Toggle
 */
function account_popup() {
	?>
	<div id="login-drawer" class="popup-drawer popup-drawer-layout-fullwidth" data-drawer-target-string="#login-drawer">
		<div class="drawer-overlay" data-drawer-target-string="#login-drawer"></div>
		<div class="drawer-inner">
			<div class="drawer-header">
				<button class="login-toggle-close drawer-toggle" aria-label="<?php esc_attr_e( 'Close Login', 'gadgeto' ); ?>"  data-toggle-target="#login-drawer" data-toggle-body-class="showing-popup-drawer" aria-expanded="false" data-set-focus=".header-account-button">
					<?php thebase()->print_icon( 'close', '', false ); ?>
				</button>
			</div>
			<div class="drawer-content widget_login_form">
				<?php do_action( 'thebase_before_account_login_popup' ); ?>
				<div class="drawer-content_inner widget_login_form_inner">
					<?php do_action( 'thebase_before_account_login_inner_popup' ); ?>
					<?php do_action( 'thebase_account_login_form' ); ?>
					<?php do_action( 'thebase_after_account_login_inner_popup' ); ?>
				</div>
				<?php do_action( 'thebase_after_account_login_popup' ); ?>
			</div>
		</div>
	</div>
	<?php
}
/**
 * Login Form
 */
function account_login_form() {
	wp_login_form();
	?>
	<p class="lost_password">
		<small><a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'gadgeto' ); ?></a></small>
	</p>
	<?php if ( thebase()->option( 'header_account_modal_registration' ) ) { ?>
		<?php
		//$register_link = thebase()->option( 'header_mobile_account_modal_registration_link' );
		$register_link = thebase()->option( 'header_account_modal_registration_link' );
		?>
		<hr class="register-divider">
		<p class="register-field"><?php esc_html_e( "Don't have an account yet?", 'gadgeto' ); ?> <a class="register-link" href="<?php echo ( ! empty( $register_link ) ? esc_url( $register_link ) : esc_url( wp_registration_url() ) ); ?>"><?php esc_html_e( 'Sign up', 'gadgeto' ); ?></a></p>
		<?php
	}
}
add_action( 'thebase_account_login_form', 'TheBase\account_login_form' );
/**
 * Desktop contact
 */
function header_contact() {
	$items = thebase()->sub_option( 'header_contact_items', 'items' );
	echo '<div class="header-contact-wrap">';
	if ( is_customize_preview() ) {
		?>
		<div class="customize-partial-edit-shortcut base-custom-partial-edit-shortcut">
			<button aria-label="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" title="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" class="customize-partial-edit-shortcut-button item-customizer-focus"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13.89 3.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58s7.6-7.63 7.99-8.03c.39-.39 1.22-.39 1.68.07zm-2.73 2.79l-5.59 5.61 1.11 1.11 5.54-5.65zm-2.97 8.23l5.58-5.6-1.07-1.08-5.59 5.6z"></path></svg></button>
		</div>
		<?php
	}
	$link_style = thebase()->option( 'header_contact_link_style' );
	echo '<div class="header-contact-inner-wrap element-contact-inner-wrap inner-link-style-' . esc_attr( $link_style ) . '">';
	if ( is_array( $items ) && ! empty( $items ) ) {
		foreach ( $items as $item ) {
			if ( $item['enabled'] ) {
				$link = $item['link'];
				if ( $link && 'phone' === $item['id'] ) {
					$link = 'tel:' . str_replace( 'tel:', '', $link );
				} elseif ( $link && 'email' === $item['id'] ) {
					$link = 'mailto:' . str_replace( 'mailto:', '', $link );
				}
				if ( $link ) {
					echo '<a href="' . esc_attr( $link ) . '" class="contact-button header-contact-item' . esc_attr( 'image' === $item['source'] ? ' has-custom-image' : '' ) . '">';
						if ( 'image' === $item['source'] ) {
							if ( $item['imageid'] && wp_get_attachment_image( $item['imageid'], 'full', true ) ) {
								echo wp_get_attachment_image( $item['imageid'], 'full', true, array( 'class' => 'contact-icon-image', 'style' => 'max-width:' . esc_attr( $item['width'] ) . 'px' ) );
							} elseif ( ! empty( $item['url'] ) ) {
								echo '<img src="' . esc_attr( $item['url'] ) . '" alt="' . esc_attr( $item['label'] ) . '" class="contact-icon-image" style="max-width:' . esc_attr( $item['width'] ) . 'px"/>';
							}
						} else {
							thebase()->print_icon( $item['icon'], '', false );
						}
						echo '<span class="contact-label">' . esc_html( $item['label'] ) . '</span>';
					echo '</a>';
				} else {
					echo '<span class="contact-button header-contact-item' . esc_attr( 'image' === $item['source'] ? ' has-custom-image' : '' ) . '">';
						if ( 'image' === $item['source'] ) {
							if ( $item['imageid'] && wp_get_attachment_image( $item['imageid'], 'full', true ) ) {
								echo wp_get_attachment_image( $item['imageid'], 'full', true, array( 'class' => 'contact-icon-image', 'style' => 'max-width:' . esc_attr( $item['width'] ) . 'px' ) );
							} elseif ( ! empty( $item['url'] ) ) {
								echo '<img src="' . esc_attr( $item['url'] ) . '" alt="' . esc_attr( $item['label'] ) . '" class="contact-icon-image" style="max-width:' . esc_attr( $item['width'] ) . 'px"/>';
							}
						} else {
							thebase()->print_icon( $item['icon'], '', false );
						}
						echo '<span class="contact-label">' . esc_html( $item['label'] ) . '</span>';
					echo '</span>';
				}
			}
		}
	}
	echo '</div>';
	echo '</div>';
}
add_action( 'thebase_header_contact', 'TheBase\header_contact', 10 );

/**
 * Desktop contact
 */
function header_mobile_contact() {
	$items = thebase()->sub_option( 'header_mobile_contact_items', 'items' );
	echo '<div class="header-mobile-contact-wrap">';
	if ( is_customize_preview() ) {
		?>
		<div class="customize-partial-edit-shortcut base-custom-partial-edit-shortcut">
			<button aria-label="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" title="<?php esc_attr_e( 'Click to edit this element.', 'gadgeto' ); ?>" class="customize-partial-edit-shortcut-button item-customizer-focus"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13.89 3.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58s7.6-7.63 7.99-8.03c.39-.39 1.22-.39 1.68.07zm-2.73 2.79l-5.59 5.61 1.11 1.11 5.54-5.65zm-2.97 8.23l5.58-5.6-1.07-1.08-5.59 5.6z"></path></svg></button>
		</div>
		<?php
	}
	$link_style = thebase()->option( 'header_mobile_contact_link_style' );
	echo '<div class="header-contact-inner-wrap element-contact-inner-wrap inner-link-style-' . esc_attr( $link_style ) . '">';
	if ( is_array( $items ) && ! empty( $items ) ) {
		foreach ( $items as $item ) {
			if ( $item['enabled'] ) {
				$link = $item['link'];
				if ( $link && 'phone' === $item['id'] ) {
					$link = 'tel:' . str_replace( 'tel:', '', $link );
				} elseif ( $link && 'email' === $item['id'] ) {
					$link = 'mailto:' . str_replace( 'mailto:', '', $link );
				}
				if ( $link ) {
					echo '<a href="' . esc_attr( $link ) . '" class="contact-button header-contact-item' . esc_attr( 'image' === $item['source'] ? ' has-custom-image' : '' ) . '">';
						if ( 'image' === $item['source'] ) {
							if ( $item['imageid'] && wp_get_attachment_image( $item['imageid'], 'full', true ) ) {
								echo wp_get_attachment_image( $item['imageid'], 'full', true, array( 'class' => 'contact-icon-image', 'style' => 'max-width:' . esc_attr( $item['width'] ) . 'px' ) );
							} elseif ( ! empty( $item['url'] ) ) {
								echo '<img src="' . esc_attr( $item['url'] ) . '" alt="' . esc_attr( $item['label'] ) . '" class="contact-icon-image" style="max-width:' . esc_attr( $item['width'] ) . 'px"/>';
							}
						} else {
							thebase()->print_icon( $item['icon'], '', false );
						}
						echo '<span class="contact-label">' . esc_html( $item['label'] ) . '</span>';
					echo '</a>';
				} else {
					echo '<span class="contact-button header-contact-item' . esc_attr( 'image' === $item['source'] ? ' has-custom-image' : '' ) . '">';
						if ( 'image' === $item['source'] ) {
							if ( $item['imageid'] && wp_get_attachment_image( $item['imageid'], 'full', true ) ) {
								echo wp_get_attachment_image( $item['imageid'], 'full', true, array( 'class' => 'contact-icon-image', 'style' => 'max-width:' . esc_attr( $item['width'] ) . 'px' ) );
							} elseif ( ! empty( $item['url'] ) ) {
								echo '<img src="' . esc_attr( $item['url'] ) . '" alt="' . esc_attr( $item['label'] ) . '" class="contact-icon-image" style="max-width:' . esc_attr( $item['width'] ) . 'px"/>';
							}
						} else {
							thebase()->print_icon( $item['icon'], '', false );
						}
						echo '<span class="contact-label">' . esc_html( $item['label'] ) . '</span>';
					echo '</span>';
				}
			}
		}
	}
	echo '</div>';
	echo '</div>';
}
add_action( 'thebase_header_mobile_contact', 'TheBase\header_mobile_contact', 10 );


/**
 * Desktop Button2
 */
function header_button2() {
	$label = thebase()->option( 'header_button2_label' );
	if ( 'loggedin' === thebase()->option( 'header_button2_visibility' ) && ! is_user_logged_in() ) {
		return;
	}
	if ( 'loggedout' === thebase()->option( 'header_button2_visibility' ) && is_user_logged_in() ) {
		return;
	}
	if ( $label || is_customize_preview() ) {
		$wrap_classes   = array();
		$wrap_classes[] = 'header-button2-wrap';
		if ( 'loggedin' === thebase()->option( 'header_button2_visibility' ) ) {
			$wrap_classes[] = 'vs-logged-out-false';
		}
		if ( 'loggedout' === thebase()->option( 'header_button2_visibility' ) ) {
			$wrap_classes[] = 'vs-logged-in-false';
		}
		echo '<div class="' . esc_attr( implode( ' ', $wrap_classes ) ) . '">';
		thebase()->customizer_quick_link();
		echo '<div class="header-button-inner-wrap">';
		$rel = array();
		if ( thebase()->option( 'header_button2_target' ) ) {
			$rel[] = 'noopener';
			$rel[] = 'noreferrer';
		}
		if ( thebase()->option( 'header_button2_nofollow' ) ) {
			$rel[] = 'nofollow';
		}
		if ( thebase()->option( 'header_button2_sponsored' ) ) {
			$rel[] = 'sponsored';
		}
		echo '<a href="' . esc_attr( thebase()->option( 'header_button2_link' ) ) . '" target="' . esc_attr( thebase()->option( 'header_button2_target' ) ? '_blank' : '_self' ) . '"' . ( ! empty( $rel ) ? ' rel="' . esc_attr( implode( ' ', $rel ) ) . '"' : '' ) . ( ! empty( thebase()->option( 'header_button2_download' ) ) ? ' download' : '' ) . ' class="button header-button2 button-size-' . esc_attr( thebase()->option( 'header_button2_size' ) ) . ' button-style-' . esc_attr( thebase()->option( 'header_button2_style' ) ) . '">';
		echo esc_html( $label );
		echo '</a>';
		echo '</div>';
		echo '</div>';
	}
}
add_action( 'thebase_header_button2', 'TheBase\header_button2', 10 );


/**
 * Mobile Button2
 */
function mobile_button2() {
	$label = thebase()->option( 'mobile_button2_label' );
	if ( 'loggedin' === thebase()->option( 'mobile_button2_visibility' ) && ! is_user_logged_in() ) {
		return;
	}
	if ( 'loggedout' === thebase()->option( 'mobile_button2_visibility' ) && is_user_logged_in() ) {
		return;
	}
	if ( $label || is_customize_preview() ) {
		$wrap_classes   = array();
		$wrap_classes[] = 'mobile-header-button2-wrap';
		if ( 'loggedin' === thebase()->option( 'mobile_button2_visibility' ) ) {
			$wrap_classes[] = 'vs-logged-out-false';
		}
		if ( 'loggedout' === thebase()->option( 'mobile_button2_visibility' ) ) {
			$wrap_classes[] = 'vs-logged-in-false';
		}
		echo '<div class="' . esc_attr( implode( ' ', $wrap_classes ) ) . '">';
		thebase()->customizer_quick_link();
		$rel = array();
		if ( thebase()->option( 'mobile_button2_target' ) ) {
			$rel[] = 'noopener';
			$rel[] = 'noreferrer';
		}
		if ( thebase()->option( 'mobile_button2_nofollow' ) ) {
			$rel[] = 'nofollow';
		}
		if ( thebase()->option( 'mobile_button2_sponsored' ) ) {
			$rel[] = 'sponsored';
		}
		$classes   = array();
		$classes[] = 'button';
		$classes[] = 'mobile-header-button2';
		$classes[] = 'button-size-' . esc_attr( thebase()->option( 'mobile_button2_size' ) );
		$classes[] = 'button-style-' . esc_attr( thebase()->option( 'mobile_button2_style' ) );
		echo '<div class="mobile-header-button-inner-wrap">';
		echo '<a href="' . esc_attr( thebase()->option( 'mobile_button2_link' ) ) . '" target="' . esc_attr( thebase()->option( 'mobile_button2_target' ) ? '_blank' : '_self' ) . '"' . ( ! empty( $rel ) ? ' rel="' . esc_attr( implode( ' ', $rel ) ) . '"' : '' ) . ' class="' . esc_attr( implode( ' ', $classes ) ) . '">';
		echo esc_html( $label );
		echo '</a>';
		echo '</div>';
		echo '</div>';
	}
}
add_action( 'thebase_mobile_button2', 'TheBase\mobile_button2', 10 );

/**
 * Header Toggle Widget
 */
function header_toggle_widget() {
	add_action( 'wp_footer', 'TheBase\widget_popup' );
	?>
	<div class="widget-toggle-open-container">
		<?php thebase()->customizer_quick_link(); ?>
		<?php
		if ( thebase()->is_amp() ) {
			?>
			<amp-state id="siteNavigationWidget">
				<script type="application/json">
					{
						"expanded": false
					}
				</script>
			</amp-state>
			<?php
		}
		?>
		<button id="widget-toggle" class="widget-toggle-open drawer-toggle widget-toggle-style-<?php echo esc_attr( thebase()->option( 'header_toggle_widget_style' ) ); ?>" aria-label="<?php esc_attr_e( 'Open panel', 'gadgeto' ); ?>" data-toggle-target="#widget-drawer" data-toggle-body-class="showing-widget-drawer" aria-expanded="false" data-set-focus=".widget-toggle-close"
			<?php
			if ( thebase()->is_amp() ) {
				?>
				[class]=" siteNavigationWidget.expanded ? 'widget-toggle-open drawer-toggle widget-toggle-style-<?php echo esc_attr( thebase()->option( 'header_toggle_widget_style' ) ); ?> active' : 'widget-toggle-open drawer-toggle widget-toggle-style-<?php echo esc_attr( thebase()->option( 'header_toggle_widget_style' ) ); ?>' "
				on="tap:AMP.setState( { siteNavigationWidget: { expanded: ! siteNavigationWidget.expanded } } )"
				[aria-expanded]="siteNavigationWidget.expanded ? 'true' : 'false'"
				<?php
			}
			?>
		>
			<?php
			$label = thebase()->option( 'header_toggle_widget_label' );
			if ( ! empty( $label ) || is_customize_preview() ) {
				?>
				<span class="widget-toggle-icon"><?php widget_toggle_icon(); ?></span>
				<span class="widget-toggle-label"><?php echo esc_html( $label ); ?></span>
				<?php
			}
			?>			
		</button>
	</div>
	<?php
}
add_action( 'thebase_header_toggle_widget', 'TheBase\header_toggle_widget', 10 );

/**
 * Header Dropdown Widget
 */
function header_dropdown_widget() {
	add_action( 'wp_footer', 'TheBase\widget_popup' );
	?>
	<div class="widget-toggle-open-container">
		<?php thebase()->customizer_quick_link(); ?>
		<?php
		if ( thebase()->is_amp() ) {
			?>
			<amp-state id="siteNavigationWidget">
				<script type="application/json">
					{
						"expanded": false
					}
				</script>
			</amp-state>
			<?php
		}
		?>
		<button id="widget-toggle" class="widget-toggle-open drawer-toggle widget-toggle-style-<?php echo esc_attr( thebase()->option( 'header_dropdown_widget_style' ) ); ?>" aria-label="<?php esc_attr_e( 'Open panel', 'gadgeto' ); ?>" data-toggle-target="#widget-drawer" data-toggle-body-class="showing-widget-drawer" aria-expanded="false" data-set-focus=".widget-toggle-close"
			<?php
			if ( thebase()->is_amp() ) {
				?>
				[class]=" siteNavigationWidget.expanded ? 'widget-toggle-open drawer-toggle widget-toggle-style-<?php echo esc_attr( thebase()->option( 'header_dropdown_widget_style' ) ); ?> active' : 'widget-toggle-open drawer-toggle widget-toggle-style-<?php echo esc_attr( thebase()->option( 'header_toggle_widget_style' ) ); ?>' "
				on="tap:AMP.setState( { siteNavigationWidget: { expanded: ! siteNavigationWidget.expanded } } )"
				[aria-expanded]="siteNavigationWidget.expanded ? 'true' : 'false'"
				<?php
			}
			?>
		>
			<?php
			$label = thebase()->option( 'header_dropdown_widget_label' );
			if ( ! empty( $label ) || is_customize_preview() ) {
				?>
				<span class="widget-toggle-label"><?php echo esc_html( $label ); ?></span>
				<?php
			}
			?>
			<span class="widget-toggle-icon"><?php widget_dropdown_icon(); ?></span>
		</button>
	</div>
	<?php
}
add_action( 'thebase_header_dropdown_widget', 'TheBase\header_dropdown_widget', 10 );

/**
 * Widget Popup Toggle
 */
function widget_toggle_icon() {
	$icon = thebase()->option( 'header_toggle_widget_icon' );
	thebase()->print_icon( $icon, '', false );
}
/**
 * Widget Popup Dropdown
 */
function widget_dropdown_icon() {
	$icon = thebase()->option( 'header_dropdown_widget_icon' );
	thebase()->print_icon( $icon, '', false );
}
/**
 * Check to see if we should load widget areas in the customizer in case the user may need them.
 */
function check_for_widget_areas() {
	if ( is_customize_preview() ) {
		if ( did_action( 'thebase_header_toggle_widget' ) !== 1 ) {
			add_action( 'wp_footer', 'TheBase\widget_popup' );
		}
		if ( did_action( 'thebase_header_dropdown_widget' ) !== 1 ) {
			add_action( 'wp_footer', 'TheBase\widget_dropdown_popup' );
		}
	}
}
add_action( 'wp_footer', 'TheBase\check_for_widget_areas', 5 );
/**
 * Widget Popup Drawer
 */
function widget_popup() {
	?>
	<div id="widget-drawer" class="popup-drawer popup-drawer-layout-<?php echo esc_attr( thebase()->option( 'header_toggle_widget_layout' ) ); ?> popup-drawer-side-<?php echo esc_attr( thebase()->option( 'header_toggle_widget_side' ) ); ?>" data-drawer-target-string="#widget-drawer"
		<?php
		if ( thebase()->is_amp() ) {
			?>
			[class]=" siteNavigationWidget.expanded ? 'popup-drawer popup-drawer-layout-<?php echo esc_attr( thebase()->option( 'header_toggle_widget_layout' ) ); ?> popup-drawer-side-<?php echo esc_attr( thebase()->option( 'header_toggle_widget_side' ) ); ?> show-drawer active' : 'popup-drawer popup-drawer-layout-<?php echo esc_attr( thebase()->option( 'header_toggle_widget_layout' ) ); ?> popup-drawer-side-<?php echo esc_attr( thebase()->option( 'header_toggle_widget_side' ) ); ?>' "
			<?php
		}
		?>
	>
		<div class="drawer-overlay" data-drawer-target-string="#widget-drawer"></div>
		<div class="drawer-inner">
			<div class="drawer-header">
				<button class="widget-toggle-close drawer-toggle" aria-label="<?php esc_attr_e( 'Close panel', 'gadgeto' ); ?>"  data-toggle-target="#widget-drawer" data-toggle-body-class="showing-widget-drawer" aria-expanded="false" data-set-focus=".widget-toggle-open"
				<?php
					if ( thebase()->is_amp() ) {
						?>
						on="tap:AMP.setState( { siteNavigationWidget: { expanded: ! siteNavigationWidget.expanded } } )"
						[aria-expanded]="siteNavigationWidget.expanded ? 'true' : 'false'"
						<?php
					}
				?>
			>
					<?php thebase()->print_icon( 'close', '', false ); ?>
				</button>
			</div>
			<div class="drawer-content">
				<div class="widget-area header-widget2 header-widget-2style-<?php echo esc_attr( ( thebase()->option( 'header_widget2_link_style' ) ? thebase()->option( 'header_widget2_link_style' ) : 'normal' ) ); ?>">
					<?php dynamic_sidebar( 'header2' ); ?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
/**
 * Widget Popup dropdown Drawer
 */
function widget_dropdown_popup() {
	?>
	<div id="widget-drawer" class="popup-drawer popup-drawer-layout-<?php echo esc_attr( thebase()->option( 'header_dropdown_widget_layout' ) ); ?> popup-drawer-side-<?php echo esc_attr( thebase()->option( 'header_dropdown_widget_side' ) ); ?>" data-drawer-target-string="#widget-drawer"
		<?php
		if ( thebase()->is_amp() ) {
			?>
			[class]=" siteNavigationWidget.expanded ? 'popup-drawer popup-drawer-layout-<?php echo esc_attr( thebase()->option( 'header_dropdown_widget_layout' ) ); ?> popup-drawer-side-<?php echo esc_attr( thebase()->option( 'header_dropdown_widget_side' ) ); ?> show-drawer active' : 'popup-drawer popup-drawer-layout-<?php echo esc_attr( thebase()->option( 'header_dropdown_widget_layout' ) ); ?> popup-drawer-side-<?php echo esc_attr( thebase()->option( 'header_dropdown_widget_side' ) ); ?>' "
			<?php
		}
		?>
	>
		<div class="drawer-overlay" data-drawer-target-string="#widget-drawer"></div>
		<div class="drawer-inner">
			<div class="drawer-header">
				<button class="widget-toggle-close drawer-toggle" aria-label="<?php esc_attr_e( 'Close panel', 'gadgeto' ); ?>"  data-toggle-target="#widget-drawer" data-toggle-body-class="showing-widget-drawer" aria-expanded="false" data-set-focus=".widget-toggle-open"
				<?php
					if ( thebase()->is_amp() ) {
						?>
						on="tap:AMP.setState( { siteNavigationWidget: { expanded: ! siteNavigationWidget.expanded } } )"
						[aria-expanded]="siteNavigationWidget.expanded ? 'true' : 'false'"
						<?php
					}
				?>
			>
					<?php thebase()->print_icon( 'close', '', false ); ?>
				</button>
			</div>
			<div class="drawer-content">
				<div class="widget-area header-widget2 header-widget-2style-<?php echo esc_attr( ( thebase()->option( 'header_widget2_link_style' ) ? thebase()->option( 'header_widget2_link_style' ) : 'normal' ) ); ?>">
					<?php dynamic_sidebar( 'header2' ); ?>
				</div>
			</div>
		</div>
	</div>
	<?php
}