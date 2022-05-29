<?php

namespace SoftCDKey\Setup;

use WP_Error;
use WP_REST_Request;
use WP_REST_Response;
use WP_REST_Server;

/**
 * REST API
 */
class RestAPI
{
    const BASE = 'softcdkey';

    const NAMESPACES = [
        'woocommerce' => 'wc/v3'
    ];

	/**
	 * Register REST routes for WordPress
	 * @return
	 */
	public function register()
	{
        add_action('rest_api_init', [$this, 'registerRoutes']);
	}

    public function registerRoutes()
    {
        register_rest_route(self::NAMESPACES['woocommerce'] . '/' . self::BASE, 'cart', [
            'methods' => WP_REST_Server::READABLE,
            'callback' => [$this, 'getCartContents']
        ]);

        register_rest_route( self::NAMESPACES['woocommerce'] . '/' . self::BASE, 'products/(?P<id>\d+)/like', [
            'methods' => WP_REST_Server::EDITABLE,
            'callback' => [$this, 'likeProduct'],
            'permission_callback' => 'is_user_logged_in',
            'args' => [
                'id' => [
                  'validate_callback' => function($param, $request, $key) {
                    if (!get_post_status( $param )) {
                        return false;
                    }

                    if ('product' !== get_post_type($param)) {
                        return false;
                    }

                    return true;
                  },
                  'sanitize_callback' => 'intval'
                ],
                'like' => [
                    'validate_callback' => 'is_bool'
                ]
            ],
        ]);

        // login
        register_rest_route(
            self::BASE, '/login/',
            array(
                'methods'  => 'POST',
                'callback' => [$this, 'login'],
                // 'permission_callback' => fn() => false === is_user_logged_in(),
                'args' => [
                    'email' => [
                        'required' => true,
                        'validate_callback' => function ($value, $request, $key) {
                            if (empty($value) || !is_email($value)) {
                                return new WP_Error(
                                    'rest_forbidden',
                                    __( 'The value of email field is invalid.' ),
                                    array( 'status' => 400 )
                                );
                            }
                            
                            if (false === email_exists($value)) {
                                return new WP_Error(
                                    'user_doesn\'t exists',
                                    __( 'The user with this email isn\'t registered.' ),
                                    array( 'status' => 400)
                                );
                            }

                            return true;
                        },
                        'sanitize_callback' => 'sanitize_email'
                    ],
                    'password' => [
                        'required' => true,
                        'validate_callback' => function ($value, $request, $key) {
                            return !empty($value) && is_string($value);
                        },
                        'sanitize_callback' => 'sanitize_text_field'
                    ],
                    'remember' => [
                        'validate_callback' => function ($value, $request, $key) {
                            return filter_var($value, FILTER_VALIDATE_BOOLEAN);
                        },
                        'sanitize_callback' => function ($value, $request, $key) {
                            return boolval($value);
                        },
                    ]
                ],
            )
        );
    
        // register
        register_rest_route(
            self::BASE, '/register/',
            array(
                'methods'  => 'POST',
                'callback' => [$this, 'registration'],
                'permission_callback' => fn() => false === is_user_logged_in(),
                'args' => [
                    'email' => [
                        'required' => true,
                        'validate_callback' => function ($value, $request, $key) {
                            if (empty($value) || !is_email($value)) {
                                return new WP_Error(
                                    'rest_forbidden',
                                    __( 'The value of email field is invalid.' ),
                                    array( 'status' => 400 )
                                );
                            }

                            if (email_exists($value)) {
                                return new WP_Error(
                                    'user_exists',
                                    __( 'The user with this email already exists.' ),
                                    array( 'status' => 400)
                                );
                            }

                            return true;
                        },
                        'sanitize_callback' => 'sanitize_email'
                    ],
                    'password' => [
                        'required' => true,
                        'validate_callback' => function ($value, $request, $key) {
                            if (!empty($value) && is_string($value)) {
                                return new WP_Error(
                                    'rest_forbidden',
                                    __( 'The value of password field is invalid.' ),
                                    array( 'status' => 400 )
                                );
                            }

                            if ($value !== $request->get_param('password_confirmation')) {
                                return new WP_Error(
                                    'password_confirm_failed',
                                    __( 'The value of password and password confirmation don\'t correspond.' ),
                                    array( 'status' => 400 )
                                );
                            }

                            return true;
                        },
                        'sanitize_callback' => 'sanitize_text_field'
                    ],
                    'password_confirmation' => [
                        'required' => true,
                        'validate_callback' => function ($value, $request, $key) {
                            if (!empty($value) && is_string($value)) {
                                return new WP_Error(
                                    'rest_forbidden',
                                    __( 'The value of password_confirmation field is invalid.' ),
                                    array( 'status' => 400 )
                                );
                            }

                            return true;
                        },
                        'sanitize_callback' => 'sanitize_text_field'
                    ]
                ],
            )
        );
    }

    public function getCartContents(){
        $wc_cart = \WC()->cart;

        if ($wc_cart->is_empty()) {
            return new WP_Error('cart_is_empty', 'Cart is empty', [
                'template' => file_get_contents(locate_template("woocommerce/cart/dropdown/empty-cart.php"))
            ]);
        }

        ob_start();

        foreach ($wc_cart->get_cart() as $item) :
            get_template_part('woocommerce/cart/dropdown/cart-item', null, ['item' => $item]);
        endforeach;

        $items = ob_get_clean();

        $response = [
            'items' => $items,
            'count' => $wc_cart->get_cart_contents_count(),
            'total_price' => $wc_cart->get_cart_total()
        ];

        return new WP_REST_Response($response);
    }

    public function likeProduct($data)
    {  
    }

    public function login(WP_REST_Request $request)
    {
        $data = [
            'user_login' => $request->get_param('email'),
            'user_password' => $request->get_param('password'),
            'remember' => $request->get_param('remember')
        ];

        $user_signon = wp_signon($data, false);

        if (!is_wp_error($user_signon)) {
            wp_set_current_user($user_signon->ID);
            wp_set_auth_cookie($user_signon->ID);

            return new WP_REST_Response([
                'message' => __('Login successful, redirecting...')
            ]);
        } else {
            return new WP_Error('login-failed', __('Invalid email or password. Try again.'), ['status' => 401]);
        }
    }

    public function registration(WP_REST_Request $request)
    {
        $data = [
            'email' => $request->get_param('email'),
            'password' => $request->get_param('password')
        ];

        $user_id = wp_create_user( $data['email'], $data['password'], $data['email'] );
        if (is_wp_error($user_id)) {
            return new WP_Error('register-failed', __('Registration failed. Try again or request the admin.'), ['status' => 401]);
        }

        update_user_meta( $user_id, 'billing_email', $data['email'] );

        return new WP_REST_Response([
            'message' => __('User was successfuly created')
        ]);
    }
}
