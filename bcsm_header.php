<?php 
# Loads the BCSM Environment and Template

if (!isset($bcsm_header_good)){

    $bcsm_header_good = true;
    
    #### Load BCSM Library ####
    require_once(dirname(__FILE__).'\bcsm_load.php');
    
    #### Setup the BCSM query ####
    bcsm();
    
    #### Load the theme template ####
    require_once(ABSPATH.bcsminc.'\load_template.php');
}

?>