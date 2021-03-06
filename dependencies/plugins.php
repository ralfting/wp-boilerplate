<?php
/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/dependencies/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'rosa_register_required_plugins' );
function rosa_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = get_all_plugins_and_install();

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
  $config = array(
        'id'               => 'rosa',          // Text domain - likely want to be the same as your theme.
        'default_path'         => '',                          // Default absolute path to pre-packaged plugins
        'menu'                 => 'install-required-plugins',  // Menu slug
        'has_notices'          => true,                        // Show admin notices or not
        'is_automatic'         => false,                       // Automatically activate plugins after installation or not
        'message'              => '',                          // Message to output right before the plugins table
        'strings'              => array(
            'page_title'                               => __( 'Install Required Plugins', 'rosa' ),
            'menu_title'                               => __( 'Install Plugins', 'rosa' ),
            'installing'                               => __( 'Installing Plugin: %s', 'rosa' ), // %1$s = plugin name
            'oops'                                     => __( 'Something went wrong with the plugin API.', 'rosa' ),
            'notice_can_install_required'              => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'           => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_install'                    => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
            'notice_can_activate_required'             => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'          => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_activate'                   => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
            'notice_ask_to_update'                     => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_update'                     => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
            'install_link'                             => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                            => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return'                                   => __( 'Return to Required Plugins Installer', 'rosa' ),
            'plugin_activated'                         => __( 'Plugin activated successfully.', 'rosa' ),
            'complete'                                 => __( 'All plugins installed and activated successfully. %s', 'rosa' ), // %1$s = dashboard link
            'nag_type'                                 => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
            )
        );

tgmpa( $plugins, $config );
}
