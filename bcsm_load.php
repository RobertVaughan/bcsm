<?php
########################     BLOCKCHAIN BASED SOCIAL MEDIA PLATFORM     ########################
#                                                                                              #
#   Boostrap file for setting the Absolute Path and loading the core configuration file. The   #
#   configuration file will then load the settings file which sets up the core environment.    #
#                                                                                              #
################################################################################################

#### Define ABSPATH as this file's directory ####

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR );

################################################################################################
#   If the bscm_config.php file exists in the BCSM Root folder, or if the bcsm_settings.php    #
#   doesn't exist, load bcsm_config.php. The second check for bcsm_settings.php has the added  #
#   Benefit of avoiding cases where the current directory is nested. If neither condition is   #
#   true, initiate the setup process                                                           #
################################################################################################

if ( file_exists(ABSPATH.'bcsm_config.php')){
    
    #### The config file resides in ABSPATH ####
    require_once(ABSPATH.'bcsm_config.php');
    
} elseif ( @file_exists(dirname(ABSPATH).'\bcsm_config.php') && ! @file_exists(dirname(ABSPATH).'\bcsm_config.php')){
    
    #### The config file resides one level above the ABSPATH but is not part of another install ####
    require_once(dirname(ABSPATH).'\bcsm_config.php');
    
} else {
    
    #### A config file ldoesn't exist ####
    define('bcsminc', 'bcsm_includes');
    require_once(ABSPATH.bcsminc.'\load.php');
    
    #### Standardize $_SERVER variables across setups ####
    bcsm_fix_serverVARS();
    
    require_once(ABSPATH.bcsminc.'\functions.php');
    
    $path = bcsm_guessURL().'\bcsm_admin\setup_config.php';
    
    #### Redirect to setup_config.php ####
    if (false===strpos($_SERVER['REQUEST_URI'], 'setup_config.php')){
        header('Location:'.$path);
        exit;
    }
    
    define('bcsm_contentDIR', ABSPATH.'bcsm_content');
    require_once(ABSPATH.bcsminc.'\version.php');
    
    bcsm_check_versions();
    bcsm_load_localizations();
    
    #### Die with an error message ####
    
    $die  = sprintf(
		/* translators: %s: bcsm_config.php */
		__( "The %s file was not found. This file is required in order to function." ),
		'<code>bcsm_config.php</code>'
	) . '</p>';
	$die .= '<p>' . sprintf(
		/* translators: %s: Wiki URL */
		__( "Are you having trouble? <a href='%s'>We're here to help</a>." ),
		__( 'https://wiki.bcsm.org/editing_bcsm_config.php' )
	) . '</p>';
	$die .= '<p>' . sprintf(
		/* translators: %s: bcsm_config.php */
		__( "You can create a %s file through a web interface, but this doesn't work for all server setups. The safest way is to manually create the file." ),
		'<code>bcsm_config.php</code>'
	) . '</p>';
	$die .= '<p><a href="' . $path . '" class="button button-large">' . __( "Create a Configuration File" ) . '</a>';

	bcsm_die( $die, __( 'Blockchain Social Media Platform &rsaquo; Error' ) );
    
}
?>