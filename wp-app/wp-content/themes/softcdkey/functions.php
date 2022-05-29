<?php
/**
 *
 * This theme uses PSR-4 and OOP logic instead of procedural coding
 * Every function, hook and action is properly divided and organized inside related folders and files
 * Use the file `inc/Custom/Custom.php` to write your custom functions
 *
 * @package awps
 */

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) :
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
endif;

// require libraries
require_once __DIR__ . '/libraries/init.php';

if ( class_exists( 'SoftCDKey\\Init' ) ) :
	SoftCDKey\Init::register_services();
endif;
