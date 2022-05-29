<?php

namespace SoftCDKey\Utils;

/**
 * Encryption
 */
class Encryption
{
	/**
	 * register default hooks and actions for WordPress
	 * @return
	 */
	public function register()
	{
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'global_js' ) );
	}

	public static function encrypt()
    {

    }

    public static function decrypt()
    {
        
    }
}
